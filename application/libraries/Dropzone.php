<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

final Class Dropzone {

    function process()
    {
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $db_mbr = $CI->load->database('db_mbr', TRUE);

        sleep(1);//to simulate some delay for local host
 
        //is this an ajax request or sent via iframe(IE9 and below)?
        $ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';

        //our operation result including `status` and `message` which will be sent to browser 
        $result = array();
        $file = $_FILES['avatar'];
        
        
        if( is_string($file['name']) ) {
            //single file upload, file['name'], $file['type'] will be a string
            $result[] = $this->validateAndSave($file);
        }
        else if( is_array($file['name']) ) {
            //multiple files uploaded
            $file_count = count($file['name']);

            //in PHP if you upload multiple files with `avatar[]` name, $file['name'], $file['type'], etc will be an array
            for($i = 0; $i < $file_count; $i++) {
                $file_info = array(
                        'name' => $file['name'][$i],
                        'type' => $file['type'][$i],
                        'size' => $file['size'][$i],
                        'tmp_name' => $file['tmp_name'][$i],
                        'error' => $file['error'][$i]
                );
                $result[] = $this->validateAndSave($file_info);
            }
        }

        $result = json_encode($result);
        if($ajax) {
            //if request was ajax(modern browser), just echo it back
            echo $result;
        }
        else {
            //if request was from an older browser not supporting ajax upload
            //then we have used an iframe instead and the response is sent back to the iframe as a script
            echo '<script language="javascript" type="text/javascript">';
            echo 'window.top.window.jQuery("#'.$_POST['temporary-iframe-id'].'").data("deferrer").resolve('.$result.');';
            echo '</script>';
        }

    } 

    function validateAndSave($file) {
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $db_mbr = $CI->load->database('db_mbr', TRUE);
        
        $result = array();
         if(!preg_match('/^image\//' , $file['type'])
           //if file type is not an image
           || !preg_match('/\.(jpe?g|gif|png)$/' , $file['name'])
               //or extension is not valid
               || getimagesize($file['tmp_name']) === FALSE
                   //or file info such as its size can't be determined, so probably an invalid image file
           )
        {
           //then there is an error
           $result['status'] = 'ERR';
           $result['message'] = 'Invalid file format!';
        }
        else if($file['size'] > 110000) {
           //if size is larger than what we expect
           $result['status'] = 'ERR';
           $result['message'] = 'Please choose a smaller file!';
        }
        else if($file['error'] != 0 || !is_uploaded_file($file['tmp_name'])) {
           //if there is an unknown error or temporary uploaded file is not what we thought it was
           $result['status'] = 'ERR';
           $result['message'] = 'Unspecified error!';
        }
        else {
           //save file inside current directory using a safer version of its name
           $directory = PATH_MBR.'gallery/';
           $save_path = preg_replace('/[^\w\.\- ]/','', $file['name']);
           //thumbnail name is like filename-thumb.jpg
           $thumb_path = preg_replace('/\.(.+)$/' ,'', $save_path).'-thumb.jpg';
   
           if(
               //if we were not able to move the uploaded file from its temporary location to our desired path
               !move_uploaded_file($file['tmp_name'] , $directory . $save_path)
               OR
               //or unable to resize image to our desired size
               !$this->resize($directory.$save_path, $directory.$thumb_path, 150) 
             )
           {
               $result['status'] = 'ERR';
               $result['message'] = 'Unable to save file!';
           }
   
           else {
               //everything seems OK
               // insert to gallery
               $img = array(
                   'principal_id' => $_POST['principal_id'],
                   'url_link' => $directory.$save_path,
                   'thumnail_link' => $directory.$thumb_path,
                   'gallery_type' => 2,
               );
               $db_mbr->insert('t_gallery', $img);

               $result['status'] = 'OK';
               $result['message'] = 'File uploaded successfully!';
               //include new thumbnails `url` in our result and send to browser
               $result['url'] = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/'.$thumb_path;
           }
        }
        
        return $result;
    }
   
   function resize($in_file, $out_file, $new_width, $new_height=FALSE)
   {
       $image = null;
       $extension = strtolower(preg_replace('/^.*\./', '', $in_file));
       switch($extension)
       {
           case 'jpg':
           case 'jpeg':
               $image = imagecreatefromjpeg($in_file);
           break;
           case 'png':
               $image = imagecreatefrompng($in_file);
           break;
           case 'gif':
               $image = imagecreatefromgif($in_file);
           break;
       }
       if(!$image || !is_resource($image)) return false;
   
   
       $width = imagesx($image);
       $height = imagesy($image);
       if($new_height === FALSE)
       {
           $new_height = (int)(($height * $new_width) / $width);
       }
   
       
       $new_image = imagecreatetruecolor($new_width, $new_height);
       imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
   
       $ret = imagejpeg($new_image, $out_file, 80);
   
       imagedestroy($new_image);
       imagedestroy($image);
   
       return $ret;
   }
	   
}

?>

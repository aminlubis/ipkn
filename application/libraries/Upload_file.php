<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

final Class upload_file {

    function process($params)
    {
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);

        $vdir_upload = $params['path'];
        $tipe_file   = $_FILES['file']['type'];
        $vfile_upload = $vdir_upload . $params['name'];

        if(move_uploaded_file($_FILES[$params['inputname']]["tmp_name"], $vfile_upload)){
            return true;
        }else{
          return false;
        }

    } 

    function doUpload($inputname, $path)
    {
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);

        $random = rand(1,99);
        $unique_filename = str_replace(' ','_', $random.'_'.preg_replace('/\s+/', '_', $_FILES[''.$inputname.'']['name']));
        $vfile_upload = $path . $unique_filename;
        $type_file = $_FILES[''.$inputname.'']['type'];
        if(move_uploaded_file($_FILES[$inputname]["tmp_name"], $vfile_upload)){
            return $unique_filename;
        }else{
            return false;
        }

    }

    function getUploadedFile($id, $table){

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);

        $html = '';
        $db->where('relation_id', $id);
        $db->where('relation_tbl', $table);
        $files = $db->get('cms_attachment')->result();
        // echo '<pre>'; print_r($db->last_query());die;

        $html = '<b><i class="fa fa-file"></i> Attachment Files</b><br>';
        $html .= '<table id="attc_table_id" class="table table-striped table-bordered">';
        $html .= '<tr style="background-color:#c19542; color:white">';
            $html .= '<th width="30px" class="center">No</th>';
            $html .= '<th width="100px">Nama Dokumen</th>';
            $html .= '<th width="70px" class="center">Ukuran File</th>';
            $html .= '<th width="100px" class="center">Tipe File</th>';
            $html .= '<th width="100px">Tanggal Upload</th>';
            // $html .= '<th width="60px" class="center">Download</th>';
            $html .= '<th width="60px" class="center">Delete</th>';
        $html .= '</tr>';
        $no=1;
        if(count($files) > 0){
            foreach ($files as $key => $row_list) {
                # code...
                $html .= '<tr id="tr_id_'.$row_list->id.'">';
                    $html .= '<td align="center">'.$no.'</td>';
                    $html .= '<td align="left">'.$row_list->document_name.'</td>';
                    $size_to_kb = $row_list->file_size / 1024;
                    $size = ($size_to_kb > 1) ? number_format($size_to_kb, 2).' MB' : number_format($row_list->file_size, 2).' KB';
                    $html .= '<td align="center">'.$size.'</td>';
                    $html .= '<td align="center">'.$row_list->file_type.'</td>';
                    $html .= '<td align="center">'.$row_list->created_date.'</td>';
                    // $html .= '<td align="center"><a href="'.base_url().'/Templates/Attachment/download_file_blob/'.$row_list->id.'" target="_blank" style="color:red">Download</a></td>';
                    $html .= '<td align="center"><a href="#" class="delete_attachment" onclick="delete_attachment('.$row_list->id.')"><i class="fa fa-times-circle red"></i></a></td>';
                $html .= '</tr>';
            $no++;
            }
        }else{
            $html .=  '<tr><td colspan="9">- File not found -</td></tr>';
        }
        
        $html .= '</table>';





        return $html;

    }

    function upload_multiple_file_blob($params)
    {
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $CI->load->library('upload');
        //$CI->load->library('image_lib'); 
        $getData = array();
        foreach ($_FILES[''.$params['name'].'']['name'] as $i=>$values) {

              $_FILES['userfile']['name']     = $_FILES[''.$params['name'].'']['name'][$i];
              $_FILES['userfile']['type']     = $_FILES[''.$params['name'].'']['type'][$i];
              $_FILES['userfile']['tmp_name'] = $_FILES[''.$params['name'].'']['tmp_name'][$i];
              $_FILES['userfile']['error']    = $_FILES[''.$params['name'].'']['error'][$i];
              $_FILES['userfile']['size']     = $_FILES[''.$params['name'].'']['size'][$i];

              $random = rand(1,99999);
              $unique_file_name = $random.preg_replace('/\s+/', '-' , $_FILES[''.$params['name'].'']['name'][$i]);
              $type_file = $_FILES[''.$params['name'].'']['type'][$i];

              $config = array(
                'allowed_types' => '*',
                'upload_path'   => './uploaded/files/',
                // 'max_size'      => '999999',
                'overwrite'     => TRUE,
                'remove_spaces' => TRUE,
              );

              $CI->upload->initialize($config);

              if ($_FILES['userfile']['tmp_name'][$i]) {

                  if ( ! $CI->upload->do_upload()) :
                    $error = array('error' => $CI->upload->display_errors());
                  else :

                    $image_data = $CI->upload->data();
                    $imgdata = file_get_contents($image_data['full_path']);
                    
                    $dataexc = array(
                        'document_name' => $_POST[$params['doc_name']][$i],
                        'relation_id' => $params['ref_id'],
                        'relation_tbl' => $params['ref_table'],
                        'file_type' => $CI->upload->data('file_type'),
                        'file_size' => $CI->upload->data('file_size'),
                        'file_name' =>  $CI->upload->data('file_name'),
                        'file_content' => $imgdata,
                        'created_date' => date('Y-m-d H:i:s'),
                        'updated_date' => date('Y-m-d H:i:s'),
                        'created_by' => $CI->session->userdata('user')->fullname,
                        'updated_by' => $CI->session->userdata('user')->fullname,
                    );
                    
                    $db->insert('cms_attachment', $dataexc);
                    unlink($image_data['full_path']);

                    $getData[] = $dataexc;

                  endif;


              }
                
            }


        return $getData;
    }

    function check_existing($params){

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);

        $files = $this->getUploadedFile($params, 'data');
        /*if exist file*/
        if(count($files) > 0 ){
           foreach ($files as $key => $value) {
                if(file_exists($value->attc_fullpath)){
                    unlink($value->attc_fullpath);
                }
                $CI->db->delete('tr_attachment', array('wa_id' => $value->wa_id));
            }
        }

        return true;

    }

    function process_upload_blob($params)
	{

        $CI =& get_instance();
        $db = $CI->load->database('default', TRUE);

        $config = array();
		$config['upload_path']          = './uploaded/files/';
		$config['allowed_types']        = 'gif|jpg|png|pdf|xls|xlsx|jpeg';
		$config['max_size']             = 1000;
		$CI->load->library('upload', $config);
		if ( ! $CI->upload->do_upload('file'))
		{
				$error = array('error' => $CI->upload->display_errors());
                print_r($error); exit;
		}
		else
		{
			$image_data = $CI->upload->data();
			$imgdata = file_get_contents($image_data['full_path']);
			// $file_encode=base64_encode($imgdata);
			$data['refid'] = $params['refid'];
			$data['reftable'] = $params['reftable'];
			$data['jenis'] = $params['jenis'];
			$data['tipe'] = $CI->upload->data('file_type');
			$data['ukuran'] = $CI->upload->data('file_size');
			$data['file_attachment'] = $imgdata;
			$data['nama_file'] =  $CI->upload->data('file_name');
			$data['npwpd'] =  $params['npwpd'];
			$data['noktp'] =  $params['noktp'];
			$data['dtmCreated'] = date('Y-m-d H:i:s');
			$db->insert('t_fileattachment',$data);
			unlink($image_data['full_path']);
			return true;
		}
	}

    function upload_single_blob($filename)
	{

        $CI =& get_instance();
        $db = $CI->load->database('default', TRUE);

        $config = array();
		$config['upload_path']          = './uploaded/files/';
		$config['allowed_types']        = 'gif|jpg|png|pdf|xls|xlsx|jpeg';
		// $config['max_size']             = 1000;
		$CI->load->library('upload', $config);
		if ( ! $CI->upload->do_upload($filename))
		{
				$error = array('error' => $CI->upload->display_errors());
                print_r($error); exit;
		}
		else
		{
			$image_data = $CI->upload->data();
			$imgdata = file_get_contents($image_data['full_path']);
			unlink($image_data['full_path']);
			return $imgdata;
		}
	}
   
}

?>

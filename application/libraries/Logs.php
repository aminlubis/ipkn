<?php

/*
 * To change this template, choose Tools | templates
 * and open the template in the editor.
 */

final Class Logs {

    public function save($ref_table='', $ref_id='', $content='', $value='', $primary_key_field='', $user_id='',$fullname='') {
        
        $CI =& get_instance();
        $CI->load->library('session');          
        $CI->load->library('lib_menus');          
        $CI->load->database('default', TRUE);  
        $class = $CI->uri->segment(2);
        $modul = $CI->lib_menus->get_menu_by_class($class);
        // print_r($modul);die;
        /*save logs*/
        $data = array();
        $data['ref_table'] = strtolower($ref_table);
        $data['ref_id'] = $ref_id;
        $data['content'] = $content;
        $data['data'] = $value;
        // $data['modul_id'] = isset($modul->modul_id)?$modul->modul_id:0;
        // $data['menu_id'] = isset($modul->menu_id)?$modul->menu_id:0;
        // $data['full_modul'] = json_encode(array('menu_id' => isset($modul->menu_id)?$modul->menu_id:0,'menu_name' => isset($modul->name)?$modul->name:0, 'modul_id' => isset($modul->modul_id)?$modul->modul_id:0));
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $data['query_executed'] = $CI->db->last_query();
        $data['created_date'] = date('Y-m-d H:i:s');
        if($user_id){
            $data['created_by'] = json_encode(array('user_id' => $user_id, 'fullname' => $fullname));
            $data['updated_by'] = json_encode(array('user_id' => $user_id, 'fullname' => $fullname));
            $data['user_id'] = $user_id;
          }else{
            $data['created_by'] = json_encode(array('user_id' => $CI->session->userdata('user')->user_id, 'fullname' => $CI->session->userdata('user')->fullname));
            $data['updated_by'] = json_encode(array('user_id' => $user_id, 'fullname' => $fullname));
            $data['user_id'] = $CI->session->userdata('user')->user_id;
        }
        
        // print_r($data);die;
        $CI->db->insert('log', $data);
        $log_id = $CI->db->insert_id();

        /*update record data*/
        // $CI->db->update(strtolower($ref_table), array('log_id' => $log_id), array($primary_key_field => $ref_id));
        return true;
    }

    public function show_logs_record_datatable($object) {
        
        $CI =& get_instance();
        $CI->load->library('session');          
        $CI->load->library('Tanggal');          
        $CI->load->database('default', TRUE);  

        /*check data*/
        $decode = json_decode($object->created_by);
        $exc_by = (!empty($decode)) ? $decode->fullname : $object->created_by;
        $print = '<div class="left" style="font-size:10px;width:120px !important">'.$CI->tanggal->formatDateTime($object->updated_date).'<br>By : '.$exc_by.'</div>';

        return $print;
    }

    function write_log($params='')
    {
        
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $sess = $CI->load->library('session');

      // Check message
      // Get IP address
      if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
        $remote_addr = "REMOTE_ADDR_UNKNOWN";
      }
     
      // Get requested script
      if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
        $request_uri = "REQUEST_URI_UNKNOWN";
      }
     
      // Escape values
      $log = array(
        'id_user' => $sess->userdata('data_user')->id_user,
        'time' => date('Y-m-d H:i:s'),
        'status' => isset($params['status'])?$params['status']:'TRUE',
        'remote_addr' => $remote_addr,
        'request_uri' => $request_uri,
        'message' => isset($params['message'])?$params['message']:'Message is empty',
        'last_query' => isset($params['last_query'])?$params['last_query']:'No query executed',
        );
     
      // Construct query
     
      // Execute query and save data
      $result = $db->insert('activities_history', $log);
     
      if($result) {
        return array('status' => true);  
      }
      else {
        return array('status' => false, 'message' => 'Unable to write to the database');
      }
    }


}
    
?>
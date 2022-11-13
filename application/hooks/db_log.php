<?php

class db_log {

    function __construct() {
        date_default_timezone_set("Asia/Jakarta");
    }

    function logQueries() {
        $CI = & get_instance();
        $email = $CI->session->userdata('log_email');
		
        if ($CI->session->userdata('login_email') != "") {
            $email = $CI->session->userdata('login_email'); 
            $times = $CI->db->query_times;
            foreach ($CI->db->queries as $key => $query) {
                if (strpos($query, 'UPDATE') !== false ||
                        strpos($query, 'INSERT') !== false ||
                        strpos($query, 'DELETE') !== false) {
                        $log = new stdClass();
                        $log->sql_syntax = $query;
                        $log->host = $_SERVER['REMOTE_ADDR'];
                        $log->email = $email;
                        $CI->db->insert('t_logs', $log);
                }
            }
        }
    }

}

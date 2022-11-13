<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MX_Controller {

    function __construct() {
        parent::__construct();
        /*load libraries*/
        $this->load->library('bcrypt');
        $this->load->library('logs');
        $this->load->library('Form_validation');
        /*load model*/
        $this->load->model('login_model');
        $this->load->model('setting/Tmp_apps_config_model');
    }

    public function index() {
        $data = array(
                'profile_form' => $this->Tmp_apps_config_model->get_by_id(1),
            );

        $this->load->view('login_view_original', $data);

    }

    public function new_index() {
        $data = array(
                'profile_form' => $this->Tmp_apps_config_model->get_by_id(1),
            );

        $this->load->view('login_view_bak', $data);

    }

    public function process(){

        /*post username*/
        $username = $this->regex->_genRegex($this->input->post('username'), 'RGXQSL');
        /*hash password bcrypt*/
        $password = $this->input->post('password');
        // form validation
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // set message error
        $this->form_validation->set_message('required', "Silahkan isi field \"%s\"");
        $this->form_validation->set_message('min_length', "\"%s\" minimal 6 karakter");

        if ($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('<div style="color:white"><i>', '</i></div>');
            //die(validation_errors());
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            //set session expire time, after that user should login again
            $this->session->sess_expiration = 6000;
            $this->session->sess_expire_on_close = FALSE;

            /*check username and password exist*/
            $result = $this->login_model->check_account($username,$password);
            // print_r($result);die;
            if($result){
                $user_data = $result['user'];
                /*clear token existing or before*/
                $this->login_model->clear_token($user_data->user_id);
                /*save data bellow in session*/
                $sess_data = array(
                    'logged' => TRUE,
                    'user' => $result['user'],
                    'token' => $this->login_model->generate_token($user_data->user_id),
                    'menus' => $this->login_model->get_sess_menus($user_data->user_id),
                );
                // print_r($sess_data);die;
                if (isset($result['account'])) {
                    $sess_data['account'] = $result['account'];
                }
                
                if($this->login_model->get_user_profile($user_data->user_id) != false){
                    $sess_data['user_profile'] = $this->login_model->get_user_profile($user_data->user_id);
                }
                $this->session->set_userdata($sess_data);
                /*update last logon user*/
                $this->db->query("UPDATE tmp_user SET last_logon=now() WHERE username='".$user_data->username."' AND password='".$user_data->password."'");
                /*save log activities*/
                $this->logs->save('tmp_user', $user_data->user_id, 'user loged in', json_encode($user_data) , 'user_id',$user_data->user_id,$user_data->fullname);
                echo json_encode(array('status' => 200, 'message' => 'Login berhasil', 'logged' => TRUE, 'token' =>$sess_data['token'], 'user' => $sess_data['user'], 'user_profile' => isset($sess_data['user_profile'])?$sess_data['user_profile']:[], 'flag_user' => $user_data->flag_user ));
            }else{
                echo json_encode(array('status' => 301, 'message' => 'Username dan Password tidak sesuai'));
            }
        
        }

    }

    public function logout()
    {   
        $sess_data = array ('user' => NULL,
                            'token' => NULL,
                            'menus' => NULL,
                            'logged'=>false
                            );
        $this->login_model->clear_token($this->session->userdata('user')->user_id);
        $this->logs->save('tmp_user', $user_data, 'user logout out', json_encode(array()), 'user_id');
        $this->session->unset_userdata($sess_data);
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }


}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */


<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_input_dt extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'data/Tr_input_dt');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Tr_input_dt_model', 'Tr_input_dt');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = ($this->lib_menus->get_menu_by_class(get_class($this)))?$this->lib_menus->get_menu_by_class(get_class($this))->name : 'Title';

    }

    public function get_score(){
        // get min max
        $formulasi = $this->Tr_input_dt->get_formulasi($_GET['year'], $_GET['indicator'], $_GET['entry']);
        echo json_encode($formulasi);
    }

    public function save_row_dt(){
        // save row data
        $this->db->where(array('data_id' => $_POST['data_id']))->update('ipkn_tr_data', array('value' => $_POST['value'], 'data1' => $_POST['value'], 'updated_date' => date('Y-m-d H:i:s'), 'updated_by' => $this->session->userdata('user')->fullname));

        $this->db->where(array('dh_id' => $_POST['dh_id']))->update('ipkn_tr_data_header', array('updated_date' => date('Y-m-d H:i:s'), 'updated_by' => $this->session->userdata('user')->fullname));

        // get formulasi
        $result = $this->Tr_input_dt->get_formulasi($_POST['year'], $_POST['indicator_id'], $_POST['value']);
        echo json_encode($result);

    }
}

/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */

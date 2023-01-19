<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_score_ipkn extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'data/Tr_summary_dt');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Tr_summary_dt_model', 'Tr_summary_dt');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = ($this->lib_menus->get_menu_by_class(get_class($this)))?$this->lib_menus->get_menu_by_class(get_class($this))->name : 'Title';

    }

    public function index() { 
        /*define variable data*/
        $data = array();
        $data['title'] = $this->title;
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        // get master
        $header = $this->Tr_summary_dt->getMasterHeader();
        $data['header'] = $header;
        $data['provinces'] = $this->db->get('mst_provinces')->result();
        $summary = $this->Tr_summary_dt->getSummary();
        $data['summary'] = $summary;
        // echo '<pre>';print_r($summary);die;
        $this->load->view('Tr_score_ipkn/index', $data);
    }


}

/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */

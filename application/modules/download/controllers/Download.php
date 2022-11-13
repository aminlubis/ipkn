<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Download extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    // public function index() {
    //     $this->load->view('index');
    // }

    public function index() {

        $this->load->view('index');
    }

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */


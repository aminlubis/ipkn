<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_capaian_ipkn extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'cms/Cms_capaian_ipkn');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Cms_capaian_ipkn_model', 'Cms_capaian_ipkn');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = ($this->lib_menus->get_menu_by_class(get_class($this)))?$this->lib_menus->get_menu_by_class(get_class($this))->name : 'Title';

    }

    public function index() { 
        /*define variable data*/
        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show(),
        );
        /*load view index*/
        $this->load->view('Cms_capaian_ipkn/index', $data);
    }

    public function load_datatable() { 
        /*define variable data*/
        $year = isset($_GET['year'])?$_GET['year']:date('Y');
        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show(),
            'index' => $this->db->get('ipkn_mst_subindex')->result(),
            'provinces' => $this->db->get('mst_provinces')->result(),
            'value' => $this->get_data($year),
        );
        // echo '<pre>';print_r($data['value']);die;
        /*load view index*/
        $this->load->view('Cms_capaian_ipkn/datatable_view', $data);
    }

    public function get_data($year){
        $getData = [];
        $result = $this->db->get_where('cms_capaian_ipkn', array('year' => $year))->result();
        foreach ($result as $key => $value) {
            $getData[$value->province_id] = $value;
        }
        return $getData;
    }
    public function process()
    {
        // echo '<pre>';print_r($_POST);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;

        foreach ($_POST['prov'] as $key => $value) {
            # code...
            if(isset($_POST['is_active'][$key])){
                $val->set_rules('rank['.$key.']', 'Ranking '.$value.'', 'trim|required');
                $val->set_rules('score_ipkn['.$key.']', 'Skor IPKN '.$value.'', 'trim|required');
                $val->set_rules('score_index_1['.$key.']', 'Skor Sub Index 1 '.$value.'', 'trim|required');
                $val->set_rules('score_index_2['.$key.']', 'Skor Sub Index 2 '.$value.'', 'trim|required');
                $val->set_rules('score_index_3['.$key.']', 'Skor Sub Index 3 '.$value.'', 'trim|required');
                $val->set_rules('score_index_4['.$key.']', 'Skor Sub Index 4 '.$value.'', 'trim|required');
                $val->set_rules('score_index_5['.$key.']', 'Skor Sub Index 5 '.$value.'', 'trim|required');
            }
        }

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->regex->_genRegex($this->input->post('id'),'RGXINT'):0;
            
            // delete first
            $this->db->delete('cms_capaian_ipkn', array('year' => $_POST['tahun']));
            foreach ($_POST['prov'] as $key => $value) {
                # code...
                if(isset($_POST['is_active'][$key])){
                    $dataexc[] = array(
                        'year' => $this->regex->_genRegex($_POST['tahun'], 'RGXQSL'),
                        'province_id' => $this->regex->_genRegex($value, 'RGXQSL'),
                        'rank' => $this->regex->_genRegex($_POST['rank'][$key], 'RGXQSL'),
                        'score_ipkn' => $this->regex->_genRegex($_POST['score_ipkn'][$key], 'RGXQSL'),
                        'index_1' => $this->regex->_genRegex($_POST['score_index_1'][$key], 'RGXQSL'),
                        'index_2' => $this->regex->_genRegex($_POST['score_index_2'][$key], 'RGXQSL'),
                        'index_3' => $this->regex->_genRegex($_POST['score_index_3'][$key], 'RGXQSL'),
                        'index_4' => $this->regex->_genRegex($_POST['score_index_4'][$key], 'RGXQSL'),
                        'index_5' => $this->regex->_genRegex($_POST['score_index_5'][$key], 'RGXQSL'),
                        'is_active' => isset($_POST['is_active'][$key]) ? 'Y' : 'N',
                        'created_date' => date('Y-m-d H:i:s'),
                        'created_by' => json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL'))),
                        'created_date' => date('Y-m-d H:i:s'),
                        'created_by' => json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL'))),
                    );
                }
                
            }
            $this->db->insert_batch('cms_capaian_ipkn', $dataexc);

            // print_r($dataexc);die;

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Gagal Dilakukan'));
            }
            else
            {
                $this->db->trans_commit();
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan'));
            }
        }

    }

    public function delete()
    {
        $id=$this->input->post('ID')?$this->regex->_genRegex($this->input->post('ID',TRUE),'RGXQSL'):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Cms_capaian_ipkn->delete_by_id($toArray)){
                $this->logs->save('Cms_capaian_ipkn', $id, 'delete record', '', 'id');
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));

            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }


}

/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */

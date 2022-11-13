<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_indicator extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'ipkn_master_data/Mst_indicator');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Mst_indicator_model', 'Mst_indicator');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = ($this->lib_menus->get_menu_by_class(get_class($this)))?$this->lib_menus->get_menu_by_class(get_class($this))->name : 'Title';

    }

    public function index() { 
        /*define variable data*/
        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        // save log
        $this->logs->save($this->title, $this->session->userdata('user')->user_id, 'user access '.$this->title.'', json_encode($data) , '' ,$this->session->userdata('user')->user_id,$this->session->userdata('user')->fullname);
        /*load view index*/
        $this->load->view('Mst_indicator/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Mst_indicator/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Mst_indicator->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Mst_indicator/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_indicator/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Mst_indicator/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Mst_indicator->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_indicator/form', $data);
    }

    public function show_detail( $id )
    {
        $fields = $this->db->list_fields( 'ipkn_mst_indicator' );
        $data = $this->Mst_indicator->get_by_id( $id );
        $html = $this->master->show_detail_row_table( $fields, $data );      

        echo json_encode( array('html' => $html) );
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Mst_indicator->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->indicator_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '';
            $row[] = $row_list->indicator_id;
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('ipkn_master_data/Mst_indicator','R',$row_list->indicator_id,2).'
                        '.$this->authuser->show_button('ipkn_master_data/Mst_indicator','U',$row_list->indicator_id,2).'
                        '.$this->authuser->show_button('ipkn_master_data/Mst_indicator','D',$row_list->indicator_id,2).'
                      </div>'; 
            $row[] = '<div style="text-align: center">'.$row_list->indicator_code.'</div>';
            $row[] = ucfirst($row_list->indicator_name);
            $row[] = ucfirst($row_list->indicator_unit);
            $row[] = ucfirst($row_list->indicator_desc);
            $row[] = $row_list->indicator_owner;
            // $row[] = $row_list->indicator_source;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mst_indicator->count_all(),
                        "recordsFiltered" => $this->Mst_indicator->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('pillar_id', 'Pillar', 'trim|required');
        $val->set_rules('indicator_code', 'Kode Indikator', 'trim|required');
        $val->set_rules('indicator_name', 'Nama Indikator', 'trim|required');
        $val->set_rules('indicator_unit', 'Satuan', 'trim|required');
        $val->set_rules('indicator_ratio', 'Ratio', 'trim|required');
        $val->set_rules('indicator_type_value', 'Tipe Value', 'trim|required');
        $val->set_rules('indicator_owner', 'Owner Data', 'trim|required');
        $val->set_rules('indicator_source', 'Sumber Data', 'trim|required');
        $val->set_rules('indicator_desc', 'Deskripsi', 'trim|required');
        $val->set_rules('indicator_principal', 'Prinsip', 'trim|required');
        $val->set_rules('indicator_min_value', 'Nilai Minimum', 'trim|required');
        $val->set_rules('indicator_med_value', 'Nilai Tengah', 'trim|required');
        $val->set_rules('indicator_max_value', 'Nilai Maksimal', 'trim|required');

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

            $dataexc = array(
                'pillar_id' => $this->regex->_genRegex($val->set_value('pillar_id'), 'RGXQSL'),
                'indicator_code' => $this->regex->_genRegex($val->set_value('indicator_code'), 'RGXQSL'),
                'indicator_name' => $this->regex->_genRegex($val->set_value('indicator_name'), 'RGXQSL'),
                'indicator_unit' => $this->regex->_genRegex($val->set_value('indicator_unit'), 'RGXQSL'),
                'indicator_ratio' => $this->regex->_genRegex($val->set_value('indicator_ratio'), 'RGXQSL'),
                'indicator_type_value' => $this->regex->_genRegex($val->set_value('indicator_type_value'), 'RGXQSL'),
                'indicator_owner' => $this->regex->_genRegex($val->set_value('indicator_owner'), 'RGXQSL'),
                'indicator_source' => $this->regex->_genRegex($val->set_value('indicator_source'), 'RGXQSL'),
                'indicator_desc' => $this->regex->_genRegex($val->set_value('indicator_desc'), 'RGXQSL'),
                'indicator_principal' => $this->regex->_genRegex($val->set_value('indicator_principal'), 'RGXQSL'),
                'indicator_min_value' => $this->regex->_genRegex($val->set_value('indicator_min_value'), 'RGXQSL'),
                'indicator_med_value' => $this->regex->_genRegex($val->set_value('indicator_med_value'), 'RGXQSL'),
                'indicator_max_value' => $this->regex->_genRegex($val->set_value('indicator_max_value'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );
            // print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*save post data*/
                $newId = $this->Mst_indicator->save($dataexc);
                /*save logs*/
                $this->logs->save('ipkn_mst_indicator', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'indicator_id');
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Mst_indicator->update(array('indicator_id' => $id), $dataexc);
                $newId = $id;
                /*save logs*/
                $this->logs->save('ipkn_mst_indicator', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'indicator_id');
            }
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
            if($this->Mst_indicator->delete_by_id($toArray)){
                $this->logs->save('ipkn_mst_indicator', $id, 'delete record', '', 'indicator_id');
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

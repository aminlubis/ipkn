<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_data_header extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'data_ipkn/Tr_data_header');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Tr_data_header_model', 'Tr_data_header');
        $this->load->model('Tr_input_dt_model', 'Tr_input_dt');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = 'Input Data IPKN';

    }

    public function index() { 
        /*define variable data*/
        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        $this->logs->save($this->title, $this->session->userdata('user')->user_id, 'user access '.$this->title.'', json_encode($data) , '' ,$this->session->userdata('user')->user_id,$this->session->userdata('user')->fullname);

        // echo '<pre>'; print_r($this->session->all_userdata());die;
        /*load view index*/
        $this->load->view('Tr_data_header/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Tr_data_header/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tr_data_header->get_by_id($id);
            // echo '<pre>';print_r($data['value']);die;
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Tr_data_header/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        // save log
        $this->logs->save($this->title, $this->session->userdata('user')->user_id, 'user access '.strtolower($this->title).'/'.__FUNCTION__.'', json_encode($data) , '' ,$this->session->userdata('user')->user_id,$this->session->userdata('user')->fullname);
        /*load form view*/
        $this->load->view('Tr_data_header/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Tr_data_header/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tr_data_header->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_data_header/form', $data);
    }

    public function show_detail( $id )
    {
        
        $data = array();
        $data['value'] = $this->Tr_data_header->get_by_id($id);
        $data['result'] = $this->Tr_input_dt->get_by_dh_id($id);
        // print_r($data);die;
        $view = $this->load->view('Tr_data_header/view_detail', $data, true);
        echo json_encode( array('html' => $view) );
    }

    public function entry_data( $id='' )
    {
        
        $data = array();
        $data['title'] = $this->title;
        $data['flag'] = "update";
        $data['value'] = $this->Tr_data_header->get_by_id($id);
        $data['result'] = $this->Tr_input_dt->get_by_dh_id($id);
        // echo '<pre>';print_r($data['value']);die;
        $view = $this->load->view('Tr_data_header/form_entry_data', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tr_data_header->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->dh_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '';
            $row[] = $row_list->dh_id;
            $row[] = '<a href="#" onclick="getMenu('."'data_ipkn/Tr_data_header/entry_data/".$row_list->dh_id."'".')">'.$row_list->dh_year.'</a>';
            $row[] = $row_list->province_name;
            $row[] = $row_list->dh_title;
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('data_ipkn/Tr_data_header','R',$row_list->dh_id,2).'
                        '.$this->authuser->show_button('data_ipkn/Tr_data_header','U',$row_list->dh_id,2).'
                        '.$this->authuser->show_button('data_ipkn/Tr_data_header','D',$row_list->dh_id,2).'
                      </div>'; 

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_data_header->count_all(),
                        "recordsFiltered" => $this->Tr_data_header->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('dh_title', 'Judul Header', 'trim|required');
        $val->set_rules('province_id', 'Provinsi', 'trim|required');
        $val->set_rules('dh_year', 'Tahun', 'trim|required');
        $val->set_rules('dh_description', 'Deskripsi', 'trim');

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
                'dh_title' => $this->regex->_genRegex($val->set_value('dh_title'), 'RGXQSL'),
                'province_id' => $this->regex->_genRegex($val->set_value('province_id'), 'RGXQSL'),
                'dh_year' => $this->regex->_genRegex($val->set_value('dh_year'), 'RGXQSL'),
                'dh_date' => $this->regex->_genRegex(date('Y-m-d'), 'RGXQSL'),
                'dh_description' => $this->regex->_genRegex($val->set_value('dh_description'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );
            //print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                // cek data by year and kl
                $dt_exist = $this->db->get_where('ipkn_tr_data_header', array('province_id' => $val->set_value('province_id'), 'dh_year' => $val->set_value('dh_year')) );
                if ($dt_exist->num_rows() == 0) {
                    /*save post data*/
                    $newId = $this->Tr_data_header->save($dataexc);
                    /*save logs*/
                    $this->logs->save('ipkn_tr_data_header', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'dh_id');
                }else{
                    echo json_encode(array('status' => 301, 'message' => 'Tahun dan Provinsi sudah pernah diinput, silahkan periksa data anda!'));
                    exit;
                }
                
            }else{

                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Tr_data_header->update(array('dh_id' => $id), $dataexc);
                // update year of data
                $this->db->update('ipkn_tr_data', array('data_year' => $dataexc['dh_year'], 'province_id' => $dataexc['province_id']), array('dh_id' => $id) );
                $newId = $id;
                /*save logs*/
                $this->logs->save('tr_data_header', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'dh_id');
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
            if($this->Tr_data_header->delete_by_id($toArray)){
                $this->logs->save('tr_data_header', $id, 'delete record', '', 'dh_id');
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

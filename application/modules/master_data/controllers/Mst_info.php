<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_info extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'master_data/Mst_info');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Mst_info_model', 'Mst_info');
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
        $this->load->view('Mst_info/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Mst_info/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Mst_info->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Mst_info/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_info/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Mst_info/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Mst_info->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_info/form_read', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Mst_info->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->info_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('master_data/Mst_info','R',$row_list->info_id,2).'
                        '.$this->authuser->show_button('master_data/Mst_info','U',$row_list->info_id,2).'
                        '.$this->authuser->show_button('master_data/Mst_info','D',$row_list->info_id,2).'
                      </div>'; 
            $row[] = ucwords($row_list->info_title);
            $row[] = $this->tanggal->formatDateFormDmy($row_list->info_start_date);
            $row[] = ucfirst($row_list->info_content);
            $row[] = ($row_list->is_active == 'Y') ? '<div style="text-align: center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Active</span></div>' : '<div style="text-align: center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Not active</span></div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mst_info->count_all(),
                        "recordsFiltered" => $this->Mst_info->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function get_notification()
    {
        /*get data from model*/
        $list = $this->Mst_info->get_data();
        $data = array(
                    "value" => $list,
                    "count" => count($list),
                );
        $this->load->view('Mst_info/view_notification', $data);
    }

    public function count_notification()
    {
        /*get data from model*/
        $list = $this->Mst_info->get_data();
        echo json_encode( array('count' => count($list)) );
    }

    public function process()
    {
    //    print_r($_POST);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('info_title', 'Judul', 'trim|required');
        $val->set_rules('info_start_date', 'Tanggal Pengumuman', 'trim|required');
        // $val->set_rules('info_end_date', 'Tanggal Expired Pengumuman', 'trim|required');
        $val->set_rules('info_content', 'Isi Pengumuman', 'trim|required');
        // $val->set_rules('info_description', 'Keterangan', 'trim');

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
                'info_title' => $this->regex->_genRegex($val->set_value('info_title'), 'RGXQSL'),
                'info_start_date' => $this->regex->_genRegex($val->set_value('info_start_date'), 'RGXQSL'),
                // 'info_end_date' => $this->regex->_genRegex($val->set_value('info_end_date'), 'RGXQSL'),
                'info_content' => $this->regex->_genRegex($val->set_value('info_content'), 'RGXQSL'),
                // 'info_description' => $this->regex->_genRegex($val->set_value('info_description'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );

            // upload notification
            if(isset($_FILES['info_attachment']['name']) AND $_FILES['info_attachment']['name'] != ''){
                $unique_name = $this->upload_file->doUpload('info_attachment', PATH_FILES);
                $dataexc['info_attachment'] = $unique_name;
            }
            // print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*save post data*/
                $newId = $this->Mst_info->save($dataexc);
                /*save logs*/
                $this->logs->save('mst_info', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'info_id');
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Mst_info->update(array('info_id' => $id), $dataexc);
                $newId = $id;
                /*save logs*/
                $this->logs->save('mst_info', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'info_id');
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
            if($this->Mst_info->delete_by_id($toArray)){
                $this->logs->save('mst_info', $id, 'delete record', '', 'info_id');
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

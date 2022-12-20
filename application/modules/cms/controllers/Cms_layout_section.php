<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_layout_section extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'cms/Cms_layout_section');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Cms_layout_section_model', 'Cms_layout_section');
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
        $this->load->view('Cms_layout_section/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Cms_layout_section/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Cms_layout_section->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Cms_layout_section/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        // attachment
        $data['attachment'] = $this->upload_file->getUploadedFile($id, 'cms_layout_section');
        
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Cms_layout_section/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Cms_layout_section/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Cms_layout_section->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Cms_layout_section/form_read', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Cms_layout_section->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->section_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('cms/Cms_layout_section','R',$row_list->section_id,2).'
                        '.$this->authuser->show_button('cms/Cms_layout_section','U',$row_list->section_id,2).'
                        '.$this->authuser->show_button('cms/Cms_layout_section','D',$row_list->section_id,2).'
                      </div>'; 
            $row[] = strtoupper($row_list->section_id);
            $row[] = strtoupper($row_list->section_title);
            $row[] = $row_list->section_class;
            $row[] = $row_list->section_view_name;
            $row[] = $row_list->section_layout_type;
            $row[] = $row_list->section_count;
            $row[] = ($row_list->is_active == 'Y') ? '<div style="text-align: center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Active</span></div>' : '<div style="text-align: center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Not active</span></div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Cms_layout_section->count_all(),
                        "recordsFiltered" => $this->Cms_layout_section->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
    //    print_r($_FILES);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('section_title', 'Judul', 'trim|required');
        $val->set_rules('section_subtitle', 'Sub Judul', 'trim|required');
        $val->set_rules('section_class', 'Class', 'trim|required');
        $val->set_rules('section_layout_type', 'Tipe Layout', 'trim|required');
        $val->set_rules('section_view_name', 'Nama Halaman', 'trim|required');
        $val->set_rules('section_count', 'Urutan', 'trim|required');

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
                'section_title' => $this->regex->_genRegex($val->set_value('section_title'), 'RGXQSL'),
                'section_subtitle' => $this->regex->_genRegex($val->set_value('section_subtitle'), 'RGXQSL'),
                'section_class' => $this->regex->_genRegex($val->set_value('section_class'), 'RGXQSL'),
                'section_layout_type' => $this->regex->_genRegex($val->set_value('section_layout_type'), 'RGXQSL'),
                'section_view_name' => $this->regex->_genRegex($val->set_value('section_view_name'), 'RGXQSL'),
                'section_count' => $this->regex->_genRegex($val->set_value('section_count'), 'RGXINT'),
                'is_active' => $this->input->post('is_active'),
            );


            // print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*save post data*/
                $newId = $this->Cms_layout_section->save($dataexc);
                /*save logs*/
                $this->logs->save('cms_layout_section', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'id');
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Cms_layout_section->update(array('section_id' => $id), $dataexc);
                $newId = $id;
                /*save logs*/
                $this->logs->save('cms_layout_section', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'id');
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
            if($this->Cms_layout_section->delete_by_id($toArray)){
                $this->logs->save('Cms_layout_section', $id, 'delete record', '', 'id');
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

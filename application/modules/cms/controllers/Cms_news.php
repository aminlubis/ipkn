<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_news extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'cms/Cms_news');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Cms_news_model', 'Cms_news');
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
        $this->load->view('Cms_news/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Cms_news/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Cms_news->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Cms_news/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        // attachment
        // $data['attachment'] = $this->upload_file->getUploadedFile($id, 'cms_content');
        
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Cms_news/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Cms_news/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Cms_news->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Cms_news/form_read', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Cms_news->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->content_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('cms/Cms_news','R',$row_list->content_id,2).'
                        '.$this->authuser->show_button('cms/Cms_news','U',$row_list->content_id,2).'
                        '.$this->authuser->show_button('cms/Cms_news','D',$row_list->content_id,2).'
                      </div>'; 
            // $row[] = strtoupper($row_list->section_title);
            $row[] = strtoupper($row_list->content_title).' ['.$row_list->category_berita.']';
            $row[] = $row_list->content_owner;
            $row[] = $this->tanggal->formatDateFormDmy($row_list->content_publish_date);
            // $row[] = $row_list->content_view_count;
            $row[] = ($row_list->is_active == 'Y') ? '<div style="text-align: center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Active</span></div>' : '<div style="text-align: center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Not active</span></div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Cms_news->count_all(),
                        "recordsFiltered" => $this->Cms_news->count_filtered(),
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
        // $val->set_rules('section_id', 'Section', 'trim');
        $val->set_rules('content_title', 'Judul', 'trim|required');
        // $val->set_rules('content_subtitle', 'Sub Judul', 'trim');
        $val->set_rules('content_category', 'Kategori Berita', 'trim');
        $val->set_rules('content_owner', 'Author', 'trim|required');
        $val->set_rules('content_description', 'Deskripsi', 'trim|required');
        // $val->set_rules('content_view_count', 'Jumlah Viewer', 'trim|required');
        $val->set_rules('content_publish_date', 'Tgl Publish', 'trim|required');

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
                // 'section_id' => $this->regex->_genRegex($val->set_value('section_id'), 'RGXQSL'),
                // 'content_subtitle' => $this->regex->_genRegex($val->set_value('content_subtitle'), 'RGXQSL'),
                'content_category' => $this->regex->_genRegex($val->set_value('content_category'), 'RGXINT'),
                'content_title' => $this->regex->_genRegex($val->set_value('content_title'), 'RGXQSL'),
                'content_owner' => $this->regex->_genRegex($val->set_value('content_owner'), 'RGXQSL'),
                'content_description' => $this->regex->_genRegex($val->set_value('content_description'), 'RGXQSL'),
                'content_view_count' => $this->regex->_genRegex($val->set_value('content_view_count'), 'RGXINT'),
                'content_publish_date' => $this->regex->_genRegex($val->set_value('content_publish_date'), 'RGXQSL'),
                'content_type' => 1,
                'is_active' => $this->input->post('is_active'),
            );

            // upload attachment
            if(!empty($_FILES['content_cover']['name'])){
                $dataexc['content_cover'] = $this->upload_file->upload_single_blob('content_cover');
            }

            // print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*save post data*/
                $newId = $this->Cms_news->save($dataexc);
                /*save logs*/
                $this->logs->save('Cms_news', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'content_id');
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Cms_news->update(array('content_id' => $id), $dataexc);
                $newId = $id;
                /*save logs*/
                $this->logs->save('Cms_news', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'content_id');
            }

            // upload multiple file
            /*insert dokumen adjusment*/
            // if(isset($_FILES['file_upload'])){
            //     $this->upload_file->upload_multiple_file_blob(array(
            //         'doc_name' => 'document_name',
            //         'name' => 'file_upload',
            //         'ref_id' => $newId,
            //         'ref_table' => 'cms_content',
            //     ));
            // }

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
            if($this->Cms_news->delete_by_id($toArray)){
                $this->logs->save('Cms_news', $id, 'delete record', '', 'id');
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

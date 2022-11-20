<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_capaian_ttdi extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'cms/Cms_capaian_ttdi');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Cms_capaian_ttdi_model', 'Cms_capaian_ttdi');
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
            'index' => $this->db->get('mst_index')->result(),
            'provinces' => $this->db->get('mst_provinces')->result(),
            'value' => $this->db->get_where('cms_capaian_ttdi', array('year' => date('Y'))),
        );

        // echo '<pre>';print_r($data['value']->result());die;
        // save log
        $this->logs->save($this->title, $this->session->userdata('user')->user_id, 'user access '.$this->title.'', json_encode($data) , '' ,$this->session->userdata('user')->user_id,$this->session->userdata('user')->fullname);
        /*load view index*/
        $this->load->view('Cms_capaian_ttdi/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Cms_capaian_ttdi/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Cms_capaian_ttdi->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Cms_capaian_ttdi/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        // attachment
        $data['attachment'] = $this->upload_file->getUploadedFile($id, 'cms_content');
        
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Cms_capaian_ttdi/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Cms_capaian_ttdi/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Cms_capaian_ttdi->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Cms_capaian_ttdi/form_read', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Cms_capaian_ttdi->get_datatables();
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
                        '.$this->authuser->show_button('cms/Cms_capaian_ttdi','R',$row_list->content_id,2).'
                        '.$this->authuser->show_button('cms/Cms_capaian_ttdi','U',$row_list->content_id,2).'
                        '.$this->authuser->show_button('cms/Cms_capaian_ttdi','D',$row_list->content_id,2).'
                      </div>'; 
            $row[] = strtoupper($row_list->section_title);
            $row[] = strtoupper($row_list->content_title);
            $row[] = $row_list->content_owner;
            $row[] = $this->tanggal->formatDateFormDmy($row_list->content_publish_date);
            $row[] = $row_list->content_view_count;
            $row[] = ($row_list->is_active == 'Y') ? '<div style="text-align: center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Active</span></div>' : '<div style="text-align: center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Not active</span></div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Cms_capaian_ttdi->count_all(),
                        "recordsFiltered" => $this->Cms_capaian_ttdi->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        
        $this->load->library('form_validation');
        $val = $this->form_validation;

        foreach ($_POST['country'] as $key => $value) {
            # code...
            if(!empty($value)){
                $val->set_rules('rank['.$key.']', 'Ranking '.$value.'', 'trim|required');
                $val->set_rules('score_ttdi['.$key.']', 'Skor TTDI '.$value.'', 'trim|required');
                $val->set_rules('score_index_1['.$key.']', 'Skor Sub Index 1 '.$value.'', 'trim|required');
                $val->set_rules('score_index_2['.$key.']', 'Skor Sub Index 2 '.$value.'', 'trim|required');
                $val->set_rules('score_index_3['.$key.']', 'Skor Sub Index 3 '.$value.'', 'trim|required');
                $val->set_rules('score_index_4['.$key.']', 'Skor Sub Index 4 '.$value.'', 'trim|required');
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
            $this->db->delete('cms_capaian_ttdi', array('year' => $_POST['tahun']));
            foreach ($_POST['country'] as $key => $value) {
                # code...
                if(!empty($value)){
                    $dataexc[] = array(
                        'year' => $this->regex->_genRegex($_POST['tahun'], 'RGXQSL'),
                        'country_name' => $this->regex->_genRegex($value, 'RGXQSL'),
                        'rank' => $this->regex->_genRegex($_POST['rank'][$key], 'RGXQSL'),
                        'score_ttdi' => $this->regex->_genRegex($_POST['score_ttdi'][$key], 'RGXQSL'),
                        'index_1' => $this->regex->_genRegex($_POST['score_index_1'][$key], 'RGXQSL'),
                        'index_2' => $this->regex->_genRegex($_POST['score_index_2'][$key], 'RGXQSL'),
                        'index_3' => $this->regex->_genRegex($_POST['score_index_3'][$key], 'RGXQSL'),
                        'index_4' => $this->regex->_genRegex($_POST['score_index_4'][$key], 'RGXQSL'),
                        'is_active' => isset($_POST['is_active'][$key]) ? 'Y' : 'N',
                        'created_date' => date('Y-m-d H:i:s'),
                        'created_by' => json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL'))),
                        'created_date' => date('Y-m-d H:i:s'),
                        'created_by' => json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL'))),
                    );
                }
                
            }
            $this->db->insert_batch('cms_capaian_ttdi', $dataexc);

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
            if($this->Cms_capaian_ttdi->delete_by_id($toArray)){
                $this->logs->save('Cms_capaian_ttdi', $id, 'delete record', '', 'id');
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

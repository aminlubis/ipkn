<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_subpillar extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'master_data/Mst_subpillar');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Mst_subpillar_model', 'Mst_subpillar');
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
        $this->load->view('Mst_subpillar/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Mst_subpillar/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Mst_subpillar->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Mst_subpillar/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_subpillar/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Mst_subpillar/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Mst_subpillar->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_subpillar/form', $data);
    }

    public function show_detail( $id )
    {
        $fields = $this->db->list_fields( 'mst_subpillar' );
        $data = $this->Mst_subpillar->get_by_id( $id );
        $html = $this->master->show_detail_row_table( $fields, $data );      

        echo json_encode( array('html' => $html) );
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Mst_subpillar->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->subpillar_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '';
            $row[] = $row_list->subpillar_id;
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('master_data/Mst_subpillar','R',$row_list->subpillar_id,2).'
                        '.$this->authuser->show_button('master_data/Mst_subpillar','U',$row_list->subpillar_id,2).'
                        '.$this->authuser->show_button('master_data/Mst_subpillar','D',$row_list->subpillar_id,2).'
                      </div>'; 
            // $row[] = '<div style="text-align: center">'.$row_list->subpillar_id.'</div>';
            $row[] = ucfirst($row_list->kl_short_name);
            $row[] = ucfirst($row_list->pillar_desc);
            $row[] = ucfirst($row_list->subpillar_desc).' <span style="font-size: 10px">'.$row_list->year_label.'</span>';
            $row[] = ($row_list->is_active == 'Y') ? '<div style="text-align: center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Active</span></div>' : '<div style="text-align: center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Not active</span></div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mst_subpillar->count_all(),
                        "recordsFiltered" => $this->Mst_subpillar->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('kl_id', 'K/L', 'trim');
        $val->set_rules('pillar_id', 'Pillar', 'trim|required');
        $val->set_rules('subpillar_desc', 'Subpillar', 'trim|required');
        $val->set_rules('question', 'Question', 'trim');
        $val->set_rules('source', 'Source', 'trim');
        $val->set_rules('weighted', 'Weighted', 'trim');
        $val->set_rules('type_data', 'Type', 'trim');
        $val->set_rules('data_value', 'Value Data', 'trim');
        $val->set_rules('min_value', 'Min', 'trim');
        $val->set_rules('med_value', 'Median', 'trim');
        $val->set_rules('max_value', 'Max', 'trim');
        $val->set_rules('year_label', 'Year Label', 'trim');
        $val->set_rules('is_exclusive', 'Is Exclusive?', 'trim');
        $val->set_rules('is_outlayer', 'Is Outlayer?', 'trim');
        $val->set_rules('is_child', 'Is Child?', 'trim');
        $val->set_rules('note', 'Subpillar', 'trim');
        $val->set_rules('ratio', 'Rasio', 'trim');
        $val->set_rules('unit_ratio', 'Satuan', 'trim');

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
                'kl_id' => $this->regex->_genRegex($val->set_value('kl_id'), 'RGXINT'),
                'pillar_id' => $this->regex->_genRegex($val->set_value('pillar_id'), 'RGXINT'),
                'subpillar_desc' => $this->regex->_genRegex($val->set_value('subpillar_desc'), 'RGXQSL'),
                'question' => $this->regex->_genRegex($val->set_value('question'), 'RGXQSL'),
                'source' => $this->regex->_genRegex($val->set_value('source'), 'RGXQSL'),
                'weighted' => $this->regex->_genRegex($val->set_value('weighted'), 'RGXQSL'),
                'type_data' => $this->regex->_genRegex($val->set_value('type_data'), 'RGXQSL'),
                'year_label' => $this->regex->_genRegex($val->set_value('year_label'), 'RGXQSL'),
                'data_value' => $this->regex->_genRegex($val->set_value('data_value'), 'RGXQSL'),
                'min_value' => $this->regex->_genRegex($val->set_value('min_value'), 'RGXQSL'),
                'med_value' => $this->regex->_genRegex($val->set_value('med_value'), 'RGXQSL'),
                'max_value' => $this->regex->_genRegex($val->set_value('max_value'), 'RGXQSL'),
                'is_exclusive' => $this->regex->_genRegex($val->set_value('is_exclusive'), 'RGXQSL'),
                'is_outlayer' => $this->regex->_genRegex($val->set_value('is_outlayer'), 'RGXQSL'),
                'is_child' => $this->regex->_genRegex($val->set_value('is_child'), 'RGXQSL'),
                'note' => $this->regex->_genRegex($val->set_value('note'), 'RGXQSL'),
                'ratio' => $this->regex->_genRegex($val->set_value('ratio'), 'RGXINT'),
                'unit_ratio' => $this->regex->_genRegex($val->set_value('unit_ratio'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );
            // print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*save post data*/
                $newId = $this->Mst_subpillar->save($dataexc);
                /*save logs*/
                $this->logs->save('Mst_subpillar', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'subpillar_id');
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Mst_subpillar->update(array('subpillar_id' => $id), $dataexc);
                $newId = $id;
                /*save logs*/
                $this->logs->save('Mst_subpillar', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'subpillar_id');
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
            if($this->Mst_subpillar->delete_by_id($toArray)){
                $this->logs->save('Mst_subpillar', $id, 'delete record', '', 'subpillar_id');
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

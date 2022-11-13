<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_summary_dt extends MX_Controller {

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
        $this->load->view('Tr_summary_dt/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Tr_summary_dt/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tr_summary_dt->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Tr_summary_dt/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_summary_dt/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Tr_summary_dt/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tr_summary_dt->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_summary_dt/form', $data);
    }

    public function summary_pie_chart() {
        
        $this->output->enable_profiler(false);
        $data = array();
        $this->load->view('Tr_summary_dt/pie_chart', $data);
    }

    public function show_detail( $id )
    {
        $fields = $this->db->list_fields( 'tr_data' );
        $result = $this->db->join('mst_subpillar', 'mst_subpillar.subpillar_id=tr_data.subpillar_id','left')->get_where('tr_data', array('data_id' => $id ))->row();
        if(!empty($result)){
            // show template detail
            $data = array('value' => $result);
            $html = $this->load->view('Tr_summary_dt/detail_row_data', $data, true);
            // $html = $this->master->show_detail_row_table( $fields, $data );      
        }else{
            $html = '<div class="alert alert-warning" role="alert">
                        <div class="alert-text"><strong>Warning !</strong> you have not entered data.</div>
                    </div>';
        }

        echo json_encode( array('html' => $html) );
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tr_summary_dt->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            // $row[] = '<div style="text-align: center">
            //                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
            //                 <input type="checkbox" name="selected_id[]" value="'.$row_list->data_id.'" class="kt-checkable">
            //                 <span></span>
            //                 </label>
            //           </div>';
            $row[] = $row_list->data_id;
            $row[] = '';
            $row[] = '<div style="text-align: center">'.$row_list->data_id.'</div>';
            // $row[] = '';
            $row[] = $row_list->pillar_desc;
            $row[] = $row_list->subpillar_desc;
            // $row[] = $row_list->kl_short_name;
            $last_value = ($row_list->last_value)?$row_list->last_value:$row_list->data_value;
            $current_value = ($row_list->current_value)?$row_list->current_value:0;
            $score = ($row_list->score)?$row_list->score:0;
            $row[] = '<div style="text-align: center">'.$last_value.'</a>';
            $row[] = '<div style="text-align: center">'.$current_value.'</a>';
            $row[] = '<div style="text-align: center">'.$score.'</a>';
            $status_data = $this->master->getTypeDataFormat($row_list->data_type);
            $row[] = '<div style="text-align: center">'.$status_data.'</div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);
            $row[] = '<div style="text-align: center"><a href="#">Edit</a></div>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_summary_dt->count_all(),
                        "recordsFiltered" => $this->Tr_summary_dt->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('name', 'Nama KL', 'trim|required');
        $val->set_rules('description', 'Deskripsi', 'trim|required');

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
                'name' => $this->regex->_genRegex($val->set_value('name'), 'RGXQSL'),
                'description' => $this->regex->_genRegex($val->set_value('description'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );
            //print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*save post data*/
                $newId = $this->Tr_summary_dt->save($dataexc);
                /*save logs*/
                $this->logs->save('Tr_summary_dt', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'data_id');
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Tr_summary_dt->update(array('data_id' => $id), $dataexc);
                $newId = $id;
                /*save logs*/
                $this->logs->save('Tr_summary_dt', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'data_id');
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

    public function getDataGiat(){

        $this->db->select('t_renja_giat_log.*, m_unit_activity.ua_name');
        $this->db->join('mst_pillar','mst_pillar.pillar_id=mst_subpillar.pillar_id','left');
        $this->db->join('tr_data','tr_data.subpillar_id=mst_subpillar.subpillar_id','left');
        $this->db->group_by('t_renja_giat_log.kode');
        $data = $this->db->get('mst_subpillar')->result();
        
        /*get atasan langsung*/
        foreach ($data as $key => $value) {
            $ParentTo = ($value->parent==NULL)?NULL:$value->parent;
            $formasi_data[] = array(
                "Id" => $value->rgl_id, 
                "Kode" => $value->kode, 
                "ParentTo" => $ParentTo, 
                "Title" => $value->kode.' - '.$value->text, 
                "Target" => $this->T_renja->getTarget($value->kode, $_GET['renja']),
                // "Target" => $value->target,
                "Unit" => ($value->ua_name)?$value->ua_name:'-',
                );
        }

        // echo '<pre>';print_r($formasi_data);die;

        /*source*/
        $source = array(
            'id' => 'ID',
            'localData' => $formasi_data,
            'dataType' => "json",
            'dataFields' => array(
                array( 'name' => 'ID', 'type' => 'string' ),
                array( 'name' => 'ParentTo', 'type' => 'string' ),
                array( 'name' => 'Title', 'type' => 'string' ),
                array( 'name' => 'Target', 'type' => 'number' ),
                array( 'name' => 'Unit', 'type' => 'string' )
                ),

            'hierarchy' => array('keyDataField' => array('name' => 'ID'), 'parentDataField' => array('name' => 'ParentTo') ),
        );

        //echo '<pre>'; print_r(json_encode($source));die;

        //echo '<pre>';print_r($merge_with_line);die;
        echo json_encode($source);

    }


}

/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */

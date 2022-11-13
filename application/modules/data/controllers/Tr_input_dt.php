<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_input_dt extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'data/Tr_input_dt');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Tr_input_dt_model', 'Tr_input_dt');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = ($this->lib_menus->get_menu_by_class(get_class($this)))?$this->lib_menus->get_menu_by_class(get_class($this))->name : 'Title';

    }

    public function index() { 
        /*get subpillar active*/
        $subpillar = $this->Tr_input_dt->getSubpillarActive($_GET['dh_id']);
        $getData = array();
        foreach($subpillar as $row){
            $getData[$row->pillar_desc][] = $row;
        }
        // get last data inputed
        $dh_dt = $this->db->join('mst_kl','mst_kl.kl_id=tr_data_header.kl_id','left')->get_where('tr_data_header', array('dh_id' => $_GET['dh_id']))->row();
        $last_data = $this->Tr_input_dt->getLastDataInputed($_GET['dh_id']); 
        // get overall score
        $overall_score = $this->master->getOverallScore($dh_dt->kl_id, $dh_dt->dh_year);
        // get subpillar active
        $subpillar = $this->master->getSubpillarActiveByKl($dh_dt->kl_id);
        // echo '<pre>';print_r($last_data);die;
        foreach ($subpillar as $key => $value) {
            // count data primer
            $data_primer[] = ($value->type_data=='E')?1:0;
            $data_sekunder[] = ($value->type_data=='S')?1:0;
        }
        // get progress current
        $progress = $this->master->getProgressCurrent($dh_dt->kl_id, $dh_dt->dh_year);
        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($dh_dt->kl_id, $dh_dt->dh_year-1);

        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show(),
            'pillar' => $getData,
            'dh_id' => $_GET['dh_id'],
            'dh_dt' => $dh_dt,
            'last_data' => $last_data,
            'total_subpillar' => count($subpillar),
            'total_primer' => array_sum($data_primer),
            'total_sekunder' => array_sum($data_sekunder),
            'progress' => ($progress)?number_format($progress['persentase_progress']):0,
            'class_progress' => $this->master->getColorFromValue($progress),
            'overall_score' => ($overall_score)?number_format($overall_score, 2):0,
            'overall_score_last_year' => ($overall_score_last_year)?number_format($overall_score_last_year, 2):0,
            'sign' => $this->master->getSignScore($overall_score, $overall_score_last_year),
        );
        
        // save log
        $this->logs->save($this->title, $this->session->userdata('user')->user_id, 'user access '.$this->title.'', json_encode($data) , '' ,$this->session->userdata('user')->user_id,$this->session->userdata('user')->fullname);
        /*load view index*/
        $this->load->view('Tr_input_dt/index_form_wizard', $data);
    }

    public function getProgressScore($dh_id){
        // data header
        $dh_dt = $this->db->join('mst_kl','mst_kl.kl_id=tr_data_header.kl_id','left')->get_where('tr_data_header', array('dh_id' => $dh_id))->row();
        // subpillar active
        $subpillar = $this->Tr_input_dt->getSubpillarActive($dh_id);
        // get last data inputed
        $last_data = $this->Tr_input_dt->getLastDataInputed($dh_id);
        // looping data
        foreach ($subpillar as $key => $value) {
            $last_data_inputed = isset($last_data[$value->pillar_id][$value->subpillar_id])?$last_data[$value->pillar_id][$value->subpillar_id]:array();

            // perhitungan rumus
            $conf = array(
                'subpillar' => $value->subpillar_id,
                'year' => $dh_dt->dh_year,
                'kl' => $dh_dt->kl_id,
                'last_value' => $this->master->getLastValueBySubpillar(array('kl' => $dh_dt->kl_id, 'year' => $dh_dt->dh_year, 'subpillar' => $value->subpillar_id)),
                'current_value' => isset($last_data_inputed[0]->current_value)?$last_data_inputed[0]->current_value:0,
            ); 
            $score_dt[] = $this->master->getScore($conf);
        }
        $average_score = array_sum($score_dt) / count($score_dt);
        return $average_score;
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Tr_input_dt/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tr_input_dt->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Tr_input_dt/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        // data header 
        $dt_header = $this->db->get_where('tr_data_header', array('dh_id' => $_GET['dh_id']))->row();
        $data['dt_header'] = $dt_header;
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        // save log
        $this->logs->save($this->title, $this->session->userdata('user')->user_id, 'user access '.strtolower(get_class($this)).'/'.__FUNCTION__.'', json_encode($data) , '' ,$this->session->userdata('user')->user_id,$this->session->userdata('user')->fullname);
        /*load form view*/
        $this->load->view('Tr_input_dt/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Tr_input_dt/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tr_input_dt->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_input_dt/form', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tr_input_dt->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->data_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('data/Tr_input_dt','R',$row_list->data_id,2).'
                        <button class="btn btn-icon btn-sm btn-success" onclick="getMenu('."'data/Tr_input_dt/form/".$row_list->data_id."?dh_id=".$_GET['dh_id']."'".')"><i class="ace-icon fa fa-edit bigger-50"></i></button>
                        '.$this->authuser->show_button('data/Tr_input_dt','D',$row_list->data_id,2).'
                      </div>'; 
            $row[] = '<div style="text-align: center">'.$row_list->data_id.'</div>';
            $row[] = $row_list->kl_name;
            $row[] = ucfirst($row_list->subpillar_desc);
            $row[] = '<div style="text-align: center !important">'.$row_list->year.'</div>';
            $row[] = '<div style="text-align: center !important">'.$row_list->value.'</div>';
            $row[] = '<div style="text-align: center !important">'.$row_list->score.'</div>';
            // $row[] = ($row_list->is_active == 'Y') ? '<div style="text-align: center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Active</span></div>' : '<div style="text-align: center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Not active</span></div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_input_dt->count_all(),
                        "recordsFiltered" => $this->Tr_input_dt->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        print_r($_POST);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('value', 'Value', 'trim');
        foreach($_POST['subpillar_id'] as $row){
            if( $_POST['type_data'][$row] != 'draft' ){
                $val->set_rules('link_url['.$row.']', 'Link URL', 'trim|required');
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
           
            foreach($_POST['subpillar_id'] as $row_dt){
                
                if( $_POST['current_value'][$row_dt] != 0 ) : 
                    // jika data primer maka default menggunakan data last value
                    $value_input = ($_POST['data_type'][$row_dt] == 'E') ? $_POST['last_value'][$row_dt] : $_POST['current_value'][$row_dt];

                    $input_value = ($_POST['rasio'][$row_dt] > 0) ? ($value_input / $_POST['rasio'][$row_dt]) : $value_input;

                    // perhitungan rumus
                    $conf = array(
                        'subpillar' => $row_dt,
                        'year' => $_POST['dh_year'],
                        'kl' => $_POST['kl_id'],
                        // 'last_value' => $_POST['last_value'][$row_dt],
                        'current_value' => $input_value,
                    ); 
                    $score_dt = $this->master->getScore($conf);

                    // score last value
                    $last_conf = array(
                        'subpillar' => $row_dt,
                        'year' => $_POST['dh_year'],
                        'kl' => $_POST['kl_id'],
                        // 'last_value' => $_POST['last_value'][$row_dt],
                        'current_value' => isset($_POST['last_value'][$row_dt])?$_POST['last_value'][$row_dt]:0,
                    ); 
                    $last_score_dt = $this->master->getScore($last_conf);

                    // value input by ratio
                    $input_value = ($_POST['rasio'][$row_dt] > 0) ? ($value_input / $_POST['rasio'][$row_dt]) : $value_input;
                    $last_value = isset($_POST['last_value'][$row_dt])?$_POST['last_value'][$row_dt]:0;
                    
                    $dataexc = array(
                        'dh_id' => $this->regex->_genRegex($_POST['dh_id'], 'RGXINT'),
                        'pillar_id' => $this->regex->_genRegex($_POST['pillar_id'][$row_dt], 'RGXINT'),
                        'kl_id' => $this->regex->_genRegex($_POST['kl_id'], 'RGXINT'),
                        'subpillar_id' => $this->regex->_genRegex($row_dt, 'RGXINT'),
                        'year' => $this->regex->_genRegex($_POST['dh_year'], 'RGXINT'),
                        'current_value' => $input_value,
                        'last_value' => ($input_value != 0) ? $last_value : 0,
                        'last_score' => $last_score_dt['score'],
                        'data_type' => $_POST['type_data'][$row_dt],
                        'data_year' => $_POST['data_year'][$row_dt],
                        'score' => $score_dt['score'],
                        'rank' => '',
                        'ir' => '',
                        'min' => $score_dt['master_dt']->min_value,
                        'med' => $score_dt['master_dt']->med_value,
                        'max' => $score_dt['master_dt']->max_value,
                        'footnote' => $_POST['note'][$row_dt],
                        'is_active' => $this->input->post('is_active'),
                    );
                    if( $_POST['type_data'][$row_dt] == 'draft' ){
                        $dataexc['attachment'] = $_POST['filename'][$row_dt];
                    }else{
                        $dataexc['link_url'] = $_POST['link_url'][$row_dt];
                    }
                    // cek data existing
                    $is_exist = $this->db->get_where('tr_data', array('dh_id' => $_POST['dh_id'], 'subpillar_id' => $row_dt, 'year' => $_POST['dh_year']))->row();
                    
                    if(empty($is_exist)){
                        $dataexc['created_date'] = date('Y-m-d H:i:s');
                        $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                        /*save post data*/
                        $newId = $this->Tr_input_dt->save($dataexc);
                        /*save logs*/
                        $this->logs->save('tr_data', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'data_id');
                    }else{
                        $dataexc['updated_date'] = date('Y-m-d H:i:s');
                        $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                        /*update record*/
                        $this->Tr_input_dt->update(array('data_id' => $is_exist->data_id), $dataexc);
                        $newId = $is_exist->data_id;
                        /*save logs*/
                        $this->logs->save('tr_data', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'data_id');
                    }
                endif; 

            }
            
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

    public function upload_file(){

    }

    public function delete()
    {
        $id=$this->input->post('ID')?$this->regex->_genRegex($this->input->post('ID',TRUE),'RGXQSL'):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Tr_input_dt->delete_by_id($toArray)){
                $this->logs->save('Tr_input_dt', $id, 'delete record', '', 'data_id');
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

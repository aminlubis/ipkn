<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_kl extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'master_data/Mst_kl');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Mst_kl_model', 'Mst_kl');
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
        $this->load->view('Mst_kl/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Mst_kl/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Mst_kl->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Mst_kl/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_kl/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Mst_kl/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Mst_kl->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_kl/form', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Mst_kl->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->kl_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = '<div style="text-align: center">
                        '.$this->authuser->show_button('master_data/Mst_kl','R',$row_list->kl_id,2).'
                        '.$this->authuser->show_button('master_data/Mst_kl','U',$row_list->kl_id,2).'
                        '.$this->authuser->show_button('master_data/Mst_kl','D',$row_list->kl_id,2).'
                      </div>'; 
            // $row[] = '<div style="text-align: center">'.$row_list->kl_id.'</div>';
            $row[] = strtoupper($row_list->kl_short_name);
            $row[] = strtoupper($row_list->kl_name);
            // $row[] = $row_list->description;
            $row[] = ($row_list->is_active == 'Y') ? '<div style="text-align: center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Active</span></div>' : '<div style="text-align: center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Not active</span></div>';
            $row[] = $this->logs->show_logs_record_datatable($row_list);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mst_kl->count_all(),
                        "recordsFiltered" => $this->Mst_kl->count_filtered(),
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
        $val->set_rules('kl_name', 'Nama Lengkap K/L', 'trim|required');
        $val->set_rules('kl_short_name', 'Nama Singkat K/L', 'trim|required');
        $val->set_rules('kl_email', 'Email', 'trim');
        $val->set_rules('kl_link_website', 'Website', 'trim');
        $val->set_rules('kl_address', 'Alamat', 'trim');
        $val->set_rules('description', 'Deskripsi', 'trim');

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
                'kl_name' => $this->regex->_genRegex($val->set_value('kl_name'), 'RGXQSL'),
                'kl_email' => $this->regex->_genRegex($val->set_value('kl_email'), 'RGXQSL'),
                'kl_link_website' => $this->regex->_genRegex($val->set_value('kl_link_website'), 'RGXQSL'),
                'kl_address' => $this->regex->_genRegex($val->set_value('kl_address'), 'RGXQSL'),
                'kl_short_name' => $this->regex->_genRegex($val->set_value('kl_short_name'), 'RGXQSL'),
                'description' => $this->regex->_genRegex($val->set_value('description'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );

            if(isset($_FILES['kl_icon']['name']) AND $_FILES['kl_icon']['name'] != ''){
                /*hapus dulu file yang lama*/
                if( $id != 0 ){
                    $res_dt = $this->Mst_kl->get_by_id($id);
                    if($res_dt->kl_icon != NULL){
                        if (file_exists(PATH_IMAGES.$res_dt->kl_icon.'')) {
                            unlink(PATH_IMAGES.$res_dt->kl_icon.'');
                        }    
                    }
                }
                $dataexc['kl_icon'] = $this->upload_file->doUpload('kl_icon', PATH_IMAGES);
            }

            //print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*save post data*/
                $newId = $this->Mst_kl->save($dataexc);
                /*save logs*/
                $this->logs->save('Mst_kl', $newId, 'insert new record on '.$this->title.' module', json_encode($dataexc),'kl_id');
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>$this->regex->_genRegex($this->session->userdata('user')->user_id,'RGXINT'), 'fullname' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')));
                /*update record*/
                $this->Mst_kl->update(array('kl_id' => $id), $dataexc);
                $newId = $id;
                /*save logs*/
                $this->logs->save('Mst_kl', $newId, 'update record on '.$this->title.' module', json_encode($dataexc),'kl_id');
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
            if($this->Mst_kl->delete_by_id($toArray)){
                $this->logs->save('Mst_kl', $id, 'delete record', '', 'kl_id');
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

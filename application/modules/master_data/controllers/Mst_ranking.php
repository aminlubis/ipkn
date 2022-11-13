<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_ranking extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'master_data/Mst_ranking');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Mst_ranking_model', 'Mst_ranking');
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
        $this->load->view('Mst_ranking/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Mst_ranking/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Mst_ranking->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Mst_ranking/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_ranking/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Mst_ranking/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Mst_ranking->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Mst_ranking/form', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Mst_ranking->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div style="text-align: center">
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" name="selected_id[]" value="'.$row_list->rank_id.'" class="kt-checkable">
                            <span></span>
                            </label>
                      </div>';
            $row[] = strtoupper($row_list->country_name);
            $row[] = $row_list->score;
            $row[] = '<div style="text-align: center">'.$no.'</div>';
            $row[] = $row_list->year;
            $row[] = $row_list->created_by;
            $row[] = $row_list->created_date;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mst_ranking->count_all(),
                        "recordsFiltered" => $this->Mst_ranking->count_filtered(),
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
        $val->set_rules('file_upload', 'File Upload', 'trim');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            
            if(isset($_FILES['file_upload']['name']) AND $_FILES['file_upload']['name'] != ''){
                $unique_name = $this->upload_file->doUpload('file_upload', PATH_FILES);
                // import data 
                // $this->import($unique_name);
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
            if($this->Mst_ranking->delete_by_id($toArray)){
                $this->logs->save('Mst_ranking', $id, 'delete record', '', 'rank_id');
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));

            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }

    public function import($file_name){
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        /*declare class*/
        $excelreader = new PHPExcel_Reader_Excel2007();
        /*load file excel to execute*/
        $loadexcel = $excelreader->load(PATH_FILES.$file_name); // Load file yang telah /*load exce and get data from sheet*/
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        // echo '<pre>'; print_r($sheet);die;
        /*get klas by remove empty for sheet klas*/
        $title = $sheet[1]['A'];
        // echo '<pre>'; print_r($title);die;
        /* define variabel array*/
        $data = [];
        $detail_tarif = [];

        /*define num row*/
        $numrow = 1;
        /*loop data from sheet*/
        foreach($sheet as $key=>$row){
            
            /*start data from sheet 4*/
            if($numrow >= 5){
                /*save log book*/
                /*pull data to variabel data array*/

                $data[] = [
                    'country_name' => $row['A'],
                    'score  ' => $row['B'],
                    'year' => $sheet[3]['B'],
                    'is_active' => 'Y',
                    'is_deleted' => 'N',
                    'created_by' => $sheet[2]['B'],
                    'created_date' => date('Y-m-d H:i:s'),
                ];

            }

            $numrow++; // Tambah 1 setiap kali looping
        }
        // echo '<pre>'; print_r($data);die;
        // cek data exist 
        $cek_data = $this->db->get_where('mst_rank', array('year' => $sheet[3]['B']));
        if($cek_data->num_rows() > 0){
            $this->db->where('year', $sheet[3]['B'])->delete('mst_rank');
        }

        $this->db->insert_batch('mst_rank', $data);
        $fp = fopen(PATH_FILES.$file_name.'.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
        return array('totalData' => count($data), 'keterangan' => $title);
        
    }

}

/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */

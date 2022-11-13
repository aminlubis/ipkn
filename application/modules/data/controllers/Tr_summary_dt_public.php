<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_summary_dt_public extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'data/Tr_summary_dt_public');
        /*load model*/
        $this->load->model('Tr_summary_dt_public_model', 'Tr_summary_dt_public');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = ($this->lib_menus->get_menu_by_class(get_class($this)))?$this->lib_menus->get_menu_by_class(get_class($this))->name : 'Title';

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
        $list = $this->Tr_summary_dt_public->get_datatables();
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

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_summary_dt_public->count_all(),
                        "recordsFiltered" => $this->Tr_summary_dt_public->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */

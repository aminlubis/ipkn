<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    function __construct() {
        parent::__construct();
        /*breadcrumb default*/

        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');
        }

    }

    public function index() {
        
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push($this->session->userdata('user')->fullname, 'main/'.strtolower(get_class($this)));
        

        $data = array(
            'title' => 'Dashboard',
            'subtitle' => 'Selamat Datang',
            'breadcrumbs' => $this->breadcrumbs->show(),
            
        );

        // echo '<pre>'; print_r($this->session->all_userdata());die;
        $this->template->load($data, 'dashboard');
    }

    public function print_preview() {
        
        $data = array();
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push($this->session->userdata('user')->fullname, 'main/'.strtolower(get_class($this)));
        // title for this page
        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Welcome ';
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $kl = isset($this->session->userdata('user')->kl_id)?$this->session->userdata('user')->kl_id:0;
        // get subpillar active
        $subpillar = $this->master->getSubpillarCurrentByKl($kl);
        // echo '<pre>';print_r($subpillar);die;
        $data['year_current'] = $subpillar['year'];
        // get overall score by kl, last year and current year
        $overall_score = $this->master->getOverallScore($kl, $subpillar['year']);
        $data['overall_score'] = ($overall_score)?number_format($overall_score, 2):0;

        // get progress current
        $progress = $this->master->getProgressCurrent($kl, $subpillar['year']);
        $data['progress'] = ($progress != false)?$progress:0;
        $data['class_progress'] = ($progress != false) ? $this->master->getColorFromValue($progress['persentase_progress']) : [];

        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($kl, $subpillar['year']);
        $data['overall_score_last_year'] = ($overall_score_last_year)?number_format($overall_score_last_year, 2):0;
        $data['sign'] = $this->master->getSignScore($overall_score, $overall_score_last_year);
        // print_r($overall_score_last_year);die;
        
        $this->load->view('Dashboard/print_preview', $data);
    }

    public function chart() {
        
        $data = array();
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push($this->session->userdata('user')->fullname, 'main/'.strtolower(get_class($this)));
        // title for this page
        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Welcome ';
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $kl = isset($this->session->userdata('user')->kl_id)?$this->session->userdata('user')->kl_id:0;
        // get subpillar active
        $subpillar = $this->master->getSubpillarCurrentByKl($kl);
        // echo '<pre>';print_r($subpillar);die;
        $data['year_current'] = $subpillar['year'];
        // get overall score by kl, last year and current year
        $overall_score = $this->master->getOverallScore($kl, $subpillar['year']);
        $data['overall_score'] = ($overall_score)?number_format($overall_score, 2):0;

        // get progress current
        $progress = $this->master->getProgressCurrent($kl, $subpillar['year']);
        // print_r($progress);die;

        $data['progress'] = ($progress != false)?$progress:0;
        $data['class_progress'] = ($progress != false) ? $this->master->getColorFromValue($progress['persentase_progress']) : [] ;

        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($kl, $subpillar['year']);
        $data['overall_score_last_year'] = ($overall_score_last_year)?number_format($overall_score_last_year, 2):0;
        $data['sign'] = $this->master->getSignScore($overall_score, $overall_score_last_year);
        
        
        $this->load->view('Dashboard/chart_view', $data);
    }

    public function table_data_index() {
        
        $data = array();
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push($this->session->userdata('user')->fullname, 'main/'.strtolower(get_class($this)));
        // title for this page
        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Welcome ';
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $kl = isset($this->session->userdata('user')->kl_id)?$this->session->userdata('user')->kl_id:$_GET['kl'];
        $data['kl'] = $kl;
        $params_year = isset($_GET['year'])?$_GET['year']:'';
        // get subpillar active
        $subpillar = $this->master->getSubpillarCurrentByKl($kl, $params_year);
        // echo '<pre>';print_r($subpillar);die;
        $data['year_current'] = $subpillar['year'];
        $getData = array();
        $last_score = array();
        $current_score = array();
		foreach ($subpillar['data'] as $key => $value) {
            // get last score by subpillar
            $get_last_score = ($value->last_score==NULL)?$this->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;
			$getData[$value->index_desc][$value->pillar_desc][] = array(
                'subpillar_id' => $value->key_subpillar,
                'pillar_note' => $value->pillar_note,
                'subpillar_note' => $value->subpillar_note,
                'icon' => $value->pillar_icon,
				'subpillar_desc' => $value->subpillar_desc,
				'last_score' => $get_last_score,
				'current_score' => $value->score,
            ); 
            
            // get score pillar
            $last_score[$value->pillar_desc][] = array('title' => $value->subpillar_desc, 'score' =>  $get_last_score, 'is_summed_as_single' => $value->is_summed_as_single, 'is_child' => $value->is_child, 'is_aggregation' => $value->is_aggregation, 'type_data' => $value->type_data, 'pillar_id' => $value->pillar_id_master, 'subpillar_id' => $value->key_subpillar, 'parent_subpillar' => $value->parent_subpillar, 'index_desc' => $value->index_desc);

            $current_score[$value->pillar_desc][] = array('title' => $value->subpillar_desc, 'score' =>  $value->score, 'is_summed_as_single' => $value->is_summed_as_single, 'is_child' => $value->is_child, 'is_aggregation' => $value->is_aggregation, 'type_data' => $value->type_data, 'pillar_id' => $value->pillar_id_master, 'subpillar_id' => $value->key_subpillar, 'parent_subpillar' => $value->parent_subpillar, 'index_desc' => $value->index_desc);


            // $current_score[$value->pillar_desc][] = $value->score;
            $last_score_index[$value->index_desc][] = $get_last_score;
            $current_score_index[$value->index_desc][] = ($value->score)?$value->score:0;
            
             // count data primer
             $data_primer[] = ($value->type_data=='E')?1:0;
             $data_sekunder[] = ($value->type_data=='S')?1:0;

        }

        // last score pillar last year
        // echo '<pre>';print_r($last_score);die;
        $getScorePillar = $this->master->getScorePillar($last_score);
        $getScorePillarCurrent = $this->master->getScorePillar($current_score);

        
        $data['subpillar'] = $getData;
        $data['total_subpillar'] = count($subpillar['data']);
        $data['total_primer'] = array_sum($data_primer);
        $data['total_sekunder'] = array_sum($data_sekunder);

        $data['last_score'] = $getScorePillar['pillar'];
        $data['last_score_index'] = $getScorePillar['index'];

        $data['current_score'] = $getScorePillarCurrent['pillar'];
        $data['current_score_index'] = $getScorePillarCurrent['index'];

        // get score rank
        $score_rank = $this->master->getScoreRank($getScorePillar['index']);
        $score_rank_current = $this->master->getScoreRank($getScorePillarCurrent['index']);

        // echo '<pre>';print_r($score_rank);die;
        $data['score_rank'] = array_sum($score_rank) / count($score_rank);
        $data['score_rank_current'] = array_sum($score_rank_current) / count($score_rank_current);
        

        // get overall score by kl, last year and current year
        $overall_score = $this->master->getOverallScore($kl, $subpillar['year']);
        $data['overall_score'] = ($overall_score)?number_format($overall_score, 2):0;

        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($kl, $subpillar['year']);
        // echo '<pre>';print_r($overall_score_last_year`);die;
        $data['overall_score_last_year'] = ($overall_score_last_year)?number_format($overall_score_last_year, 2):0;

        // get progress current
        $progress = $this->master->getProgressCurrent($kl, $subpillar['year']);
        $data['progress'] = ($progress != false)?$progress:0;
        $data['class_progress'] = ($progress != false) ? $this->master->getColorFromValue($progress['persentase_progress']) : [];



        // get overall score last year
        // $overall_score_last_year = array_sum($getScorePillar) / count($getScorePillar);
        // $data['overall_score_last_year'] = $overall_score_last_year;
        $data['sign'] = $this->master->getSignScore($data['score_rank_current'], $data['score_rank']);
        
        
        $this->load->view('Dashboard/data_table_view', $data);
    }

    public function table_data_index_detail() {
        
        $data = array();
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push($this->session->userdata('user')->fullname, 'main/'.strtolower(get_class($this)));
        // title for this page
        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Welcome ';
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $kl = isset($this->session->userdata('user')->kl_id)?$this->session->userdata('user')->kl_id:$_GET['kl'];
        $params_year = isset($_GET['year'])?$_GET['year']:'';
        // get subpillar active
        $subpillar = $this->master->getSubpillarCurrentByKl($kl, $params_year);
        // echo '<pre>';print_r($subpillar);die;
        $data['year_current'] = $subpillar['year'];
        $getData = array();
        $last_score = array();
        $current_score = array();
		foreach ($subpillar['data'] as $key => $value) {
            // get last score by subpillar
            $get_last_score = ($value->last_score==NULL)?$this->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

			$getData[$value->index_desc][$value->pillar_desc][] = array(
				'subpillar_desc' => $value->subpillar_desc,
				'last_score' => $get_last_score,
				'current_score' => $value->score,
            ); 

            $last_score[$value->pillar_desc][] = $get_last_score;
            $current_score[$value->pillar_desc][] = $value->score;

            $last_score_index[$value->index_desc][] = $get_last_score;
            $current_score_index[$value->index_desc][] = ($value->score)?$value->score:0;
            
             // count data primer
             $data_primer[] = ($value->type_data=='E')?1:0;
             $data_sekunder[] = ($value->type_data=='S')?1:0;

        }
        
        $data['subpillar'] = $getData;
        $data['total_subpillar'] = count($subpillar['data']);
        $data['total_primer'] = array_sum($data_primer);
        $data['total_sekunder'] = array_sum($data_sekunder);
        $data['last_score'] = $last_score;
        $data['current_score'] = $current_score;
        $data['last_score_index'] = $last_score_index;
        $data['current_score_index'] = $current_score_index;
        
        // echo '<pre>';print_r($data);die;

        // get overall score by kl, last year and current year
        $overall_score = $this->master->getOverallScore($kl, $subpillar['year']);
        $data['overall_score'] = ($overall_score)?number_format($overall_score, 2):0;

        // get progress current
        $progress = $this->master->getProgressCurrent($kl, $subpillar['year']);
        // print_r($progress);die;
        $data['progress'] = ($progress != false)?$progress:0;
        $data['class_progress'] = ($progress != false) ? $this->master->getColorFromValue($progress['persentase_progress']) : [];

        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($kl, $subpillar['year']);
        $data['overall_score_last_year'] = ($overall_score_last_year)?number_format($overall_score_last_year, 2):0;
        $data['sign'] = $this->master->getSignScore($overall_score, $overall_score_last_year);
        
        // echo '<pre>';print_r($data);die;
        $this->load->view('Dashboard/data_table_detail_view', $data);
    }

    public function chart_global() {
        
        $this->output->enable_profiler(false);
        $data = array();
        $data['year'] = $_GET['year'];
        $data['kl'] = $_GET['kl'];
        $data['subpillar'] = $_GET['subpillar'];
        // print_r($data);die;
        if( $this->session->userdata('user')->role != 1){
            $this->load->view('Dashboard/bar_chart_for_kl', $data);
        }else{
            if(isset($_GET['kl']) AND $_GET['kl'] != 0){
                $this->load->view('Dashboard/bar_chart_for_kl', $data);
            }else{
                $this->load->view('Dashboard/chart_global_value', $data);
            }
        }
    }

    public function list_datatable() {
        
        $this->output->enable_profiler(false);
        $data = array();
        $this->load->view('Dashboard/list_datatable_view', $data);
    }

    public function getProgresEntry(){
        // get progress current
        $progress = $this->master->getProgressCurrent($_GET['kl'], $_GET['year']);
        // print_r($progress);die;
        $data['progress'] = ($progress != false)?$progress:0;
        $data['class_progress'] = ($progress != false) ? $this->master->getColorFromValue($progress['persentase_progress']) : [];

        echo json_encode($data);
    }

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */


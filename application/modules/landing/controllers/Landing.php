<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landing extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $data = array();
        // get data master kementerian
        $data['kementerian'] = $this->db->get_where('mst_kl', array('is_active' => 'Y'))->result();
        $kl = 0;
        // get subpillar active
        $subpillar = $this->master->getSubpillarCurrentByKl($kl);
        // echo '<pre>';print_r($subpillar['data']);die;
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
        
        // echo '<pre>';print_r($getData);die;

        // get overall score by kl, last year and current year
        $overall_score = $this->master->getOverallScore($kl, $subpillar['year']);
        $data['overall_score'] = ($overall_score)?number_format($overall_score, 2):0;

        // get progress current
        $progress = $this->master->getProgressCurrent($kl, $subpillar['year']);
        // print_r($progress);die;
        $data['progress'] = ($progress)?number_format($progress, 2):0;
        $data['class_progress'] = $this->master->getColorFromValue($progress);

        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($kl, $subpillar['year']);
        $data['overall_score_last_year'] = ($overall_score_last_year)?number_format($overall_score_last_year, 2):0;
        $data['sign'] = $this->master->getSignScore($overall_score, $overall_score_last_year);
        // echo '<pre>';print_r($data);die;
        
        $this->load->view('index', $data);
    }

    public function chart_global() {
        
        $this->output->enable_profiler(false);
        $data = array();
        $this->load->view('chart_global_view', $data);
    }

    public function zoomable_radar_chart() {
        
        $this->output->enable_profiler(false);
        $data = array();
        $this->load->view('zoomable_radar_chart_view', $data);
    }

    public function modal_information($flag, $id) {
        
        $this->output->enable_profiler(false);
        $year_active = $this->master->getYearActive(0);

        if ($flag == 'subpillar') {
            $dt = $this->master->getSubpillarDataBySubpillarId($id, $year_active);
        }
        // echo '<pre>';print_r($dt);die;
        $data = array(
            'value' => $dt,
            'year' => $year_active,
        );
        $this->load->view('modal_information', $data);
    }


}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */


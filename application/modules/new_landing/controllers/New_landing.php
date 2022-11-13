<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class New_landing extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        // get data master kementerian
        $kl = $this->db->get_where('mst_kl', array('is_active' => 'Y'))->result();
        $data['kementerian'] = count($kl);

        $kl = 0;
        // get subpillar active
        $subpillar = $this->master->getSubpillarCurrentByKl($kl);
        
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

            $last_score[$value->pillar_desc][] = $get_last_score;
            $current_score[$value->pillar_desc][] = $value->score;

            $last_score_index[$value->index_desc][] = $get_last_score;
            $current_score_index[$value->index_desc][] = ($value->score)?$value->score:0;

            // count data primer
            $data_primer[] = ($value->type_data=='E')?1:0;
            $data_sekunder[] = ($value->type_data=='S')?1:0;

        }

        // $data['subpillar'] = $getData;
        $data['total_subpillar'] = count($subpillar['data']);
        // $data['total_primer'] = array_sum($data_primer);
        // $data['total_sekunder'] = array_sum($data_sekunder);
        // $data['last_score'] = $last_score;
        // $data['current_score'] = $current_score;
        // $data['last_score_index'] = $last_score_index;
        // $data['current_score_index'] = $current_score_index;

        

        // get overall score by kl, last year and current year
        $overall_score = $this->master->getOverallScore($kl, $subpillar['year']);
        $data['overall_score'] = ($overall_score)?number_format($overall_score, 2):0;

        // get progress current
        $progress = $this->master->getProgressCurrent($kl, $subpillar['year']);
        // print_r($progress);die;
        $data['progress'] = $progress;
        $data['class_progress'] = $this->master->getColorFromValue($progress['persentase_progress']);

        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($kl, $subpillar['year']);
        $data['overall_score_last_year'] = ($overall_score_last_year)?number_format($overall_score_last_year, 2):0;
        $data['sign'] = $this->master->getSignScore($overall_score, $overall_score_last_year);
        // echo '<pre>';print_r($data);die;

        $this->load->view('index', $data);
    }

    public function about()
    {
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
        $data['progress'] = $progress;
        $data['class_progress'] = $this->master->getColorFromValue($progress['persentase_progress']);

        // get overall score last year
        $overall_score_last_year = $this->master->getOverallScoreLastYear($kl, $subpillar['year']);
        $data['overall_score_last_year'] = ($overall_score_last_year)?number_format($overall_score_last_year, 2):0;
        $data['sign'] = $this->master->getSignScore($overall_score, $overall_score_last_year);
        // echo '<pre>';print_r($data);die;

        $this->load->view('about', $data);
    }

    public function download()
    {
        $this->load->view('download');
    }

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */


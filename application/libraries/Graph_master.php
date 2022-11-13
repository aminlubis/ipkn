<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

final Class Graph_master {

    function get_graph($params) {
    	// print_r($params);die;
    	$data = $this->setting_module($params);

		return $data;
		
    }

    function setting_module($params) {
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$CI->load->library('master');
		/*modul setting*/
		if($params['mod']==1){
			if($params['prefix']==1){

				$kl = isset($_GET['kl'])?$_GET['kl']:$CI->session->userdata('user')->kl_id;
				
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl, $_GET['year']);
				// echo '<pre>';print_r($subpillar);die;
				$data['year_current'] = isset($subpillar['year'])?$subpillar['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($subpillar['data'] as $key => $value) {
					// if($value->type_data=='S'){
						// get last score by subpillar
						$get_last_score = ($value->last_score==NULL)?$CI->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

						$getData[$value->pillar_desc][] = array(
							'subpillar_desc' => $value->subpillar_desc,
							'last_score' => number_format($get_last_score, 2),
							'current_score' => number_format($value->score, 2),
						); 

						$last_score[$value->pillar_desc][] = $get_last_score;
						$current_score[$value->pillar_desc][] = $value->score;
					// }
					
				}
								
				foreach ($getData as $key_dt => $value_dt) {
					$last_score_pillar = array_sum($last_score[$key_dt]) / count($last_score[$key_dt]);
                    $current_score_pillar = array_sum($current_score[$key_dt]) / count($current_score[$key_dt]);
					$resultData['2019'][$key_dt] = array('score' => number_format($last_score_pillar, 2));
					$resultData[$subpillar['year']][$key_dt] = array('name' => $key_dt, 'score' => number_format($current_score_pillar, 2));
				}
				
				$year_active = ($subpillar['year'])?$subpillar['year']:date('Y');
				
				$fields = array('2019' => 'score', $year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

			if($params['prefix']==11){
				$kl = 0;
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl);
				$data['year_current'] = isset($subpillar['year'])?$subpillar['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($subpillar['data'] as $key => $value) {
					// get last score by subpillar
					$get_last_score = ($value->last_score==NULL)?$CI->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

					$getData[$value->pillar_desc][] = array(
						'subpillar_desc' => $value->subpillar_desc,
						'last_score' => number_format($get_last_score, 2),
						'current_score' => number_format($value->score, 2),
					); 

					$last_score[$value->pillar_desc][] = $get_last_score;
					$current_score[$value->pillar_desc][] = $value->score;
					
				}
								
				foreach ($getData as $key_dt => $value_dt) {
					$last_score_pillar = array_sum($last_score[$key_dt]) / count($last_score[$key_dt]);
                    $current_score_pillar = array_sum($current_score[$key_dt]) / count($current_score[$key_dt]);
					$resultData['2019'][$key_dt] = array('score' => number_format($last_score_pillar, 2));
					$resultData[$subpillar['year']][$key_dt] = array('name' => $key_dt, 'score' => number_format($current_score_pillar, 2));
				}
				
				$year_active = ($subpillar['year'])?$subpillar['year']:date('Y');
				
				$fields = array('2019' => 'score', $year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

			if($params['prefix']==12){
				$kl = 0;
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl);
				$data['year_current'] = isset($subpillar['year'])?$subpillar['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($subpillar['data'] as $key => $value) {
					// get last score by subpillar
					$get_last_score = ($value->last_score==NULL)?$CI->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

					$getData[$value->pillar_desc][] = array(
						'subpillar_desc' => $value->subpillar_desc,
						'last_score' => number_format($get_last_score, 2),
						'current_score' => number_format($value->score, 2),
					); 

					$last_score[$value->pillar_desc][] = $get_last_score;
					$current_score[$value->pillar_desc][] = $value->score;
					
				}
								
				foreach ($getData as $key_dt => $value_dt) {
					$last_score_pillar = array_sum($last_score[$key_dt]) / count($last_score[$key_dt]);
                    $current_score_pillar = array_sum($current_score[$key_dt]) / count($current_score[$key_dt]);
					$resultData['2019'][$key_dt] = array('score' => number_format($last_score_pillar, 2));
					$resultData[$subpillar['year']][$key_dt] = array('name' => $key_dt, 'score' => number_format($current_score_pillar, 2));
				}
				
				$year_active = ($subpillar['year'])?$subpillar['year']:date('Y');
				
				$fields = array('2019' => 'score', $year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

			/*pie chart*/
			if($params['prefix']==2){
				$kl = isset($CI->session->userdata('user')->kl_id)?$CI->session->userdata('user')->kl_id:0;
				// get subpillar active
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl);
				// echo '<pre>';print_r($subpillar);die;
				$getData = array();
				foreach ($subpillar['data'] as $key => $value) {
					
					$getData['draft'][] = ($value->data_type=='draft')?1:0;
					$getData['national'][] = ($value->data_type=='national')?1:0;
					$getData['international'][] = ($value->data_type=='international')?1:0;
					$getData['unfill'][] = ($value->data_type==null)?1:0;
				}
				$arr_field = array('draft', 'national', 'international', 'unfill');
				// echo '<pre>';print_r($getData);die;

				foreach ($arr_field as $k => $v) {
					
					$total = array_sum($getData[$v]);
					$data[] = array( 'name' => $v, 'total' => $total);
				}
				
				// echo '<pre>';print_r($data);die;

				$fields = array('name' => 'total');
				$title = '<span style="font-size:13.5px">percentage of data status</span>';
				$subtitle = 'Tanggal '.$CI->tanggal->formatDate(date('Y-m-d')).'';
			}

			if($params['prefix']==3){
				$kl = isset($_GET['kl'])?$_GET['kl']:0;
				$params_year = isset($_GET['year'])?$_GET['year']:'';
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl, $params_year);
				// echo '<pre>';print_r($subpillar);die;
				$data['year_current'] = isset($subpillar['year'])?$subpillar['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($subpillar['data'] as $key => $value) {
					// get last score by subpillar
					$get_last_score = ($value->last_score==NULL)?$CI->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

					$getData[] = array(
						'subpillar_desc' => $value->subpillar_desc,
						'last_score' => number_format($get_last_score, 2),
						'current_score' => number_format($value->score, 2),
					); 
					
				}
				foreach ($getData as $key_dt => $value_dt) {
					$resultData['2019'][$value_dt['subpillar_desc']] = array('score' => $value_dt['last_score']);
					$resultData[$subpillar['year']][$value_dt['subpillar_desc']] = array('name' => $value_dt['subpillar_desc'], 'score' => $value_dt['current_score']);
				}
				// echo '<pre>';print_r($resultData);die;
				
				$year_active = ($subpillar['year'])?$subpillar['year']:date('Y');
				
				$fields = array('2019' => 'score', $year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

		}

		if($params['mod']==2){
			if($params['prefix']==1){

				$province = isset($_GET['province'])?$_GET['province']:$CI->session->userdata('user')->kl_id;
				
				$indicator = $CI->master->getIndicatorByProvince($province, $_GET['year']);
				// echo '<pre>';print_r($indicator);die;
				$data['year_current'] = isset($indicator['year'])?$indicator['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($indicator['data'] as $key => $value) {
						$getData[$value->pillar_desc][] = array(
							'pillar' => $value->pillar_desc,
							'value' => number_format($value->avg_value, 2),
							'score' => number_format($value->avg_score, 2),
						); 

						$score[$value->pillar_desc][] = $value->avg_score;
					
				}
								
				foreach ($getData as $key_dt => $value_dt) {
					$last_score_pillar = array_sum($score[$key_dt]) / count($score[$key_dt]);
					$resultData[$indicator['year']][$key_dt] = array('name' => $key_dt, 'score' => number_format($last_score_pillar, 2));
				}
				
				$year_active = ($indicator['year'])?$indicator['year']:date('Y');
				
				$fields = array($year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

			if($params['prefix']==11){
				$kl = 0;
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl);
				$data['year_current'] = isset($subpillar['year'])?$subpillar['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($subpillar['data'] as $key => $value) {
					// get last score by subpillar
					$get_last_score = ($value->last_score==NULL)?$CI->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

					$getData[$value->pillar_desc][] = array(
						'subpillar_desc' => $value->subpillar_desc,
						'last_score' => number_format($get_last_score, 2),
						'current_score' => number_format($value->score, 2),
					); 

					$last_score[$value->pillar_desc][] = $get_last_score;
					$current_score[$value->pillar_desc][] = $value->score;
					
				}
								
				foreach ($getData as $key_dt => $value_dt) {
					$last_score_pillar = array_sum($last_score[$key_dt]) / count($last_score[$key_dt]);
                    $current_score_pillar = array_sum($current_score[$key_dt]) / count($current_score[$key_dt]);
					$resultData['2019'][$key_dt] = array('score' => number_format($last_score_pillar, 2));
					$resultData[$subpillar['year']][$key_dt] = array('name' => $key_dt, 'score' => number_format($current_score_pillar, 2));
				}
				
				$year_active = ($subpillar['year'])?$subpillar['year']:date('Y');
				
				$fields = array('2019' => 'score', $year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

			if($params['prefix']==12){
				$kl = 0;
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl);
				$data['year_current'] = isset($subpillar['year'])?$subpillar['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($subpillar['data'] as $key => $value) {
					// get last score by subpillar
					$get_last_score = ($value->last_score==NULL)?$CI->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

					$getData[$value->pillar_desc][] = array(
						'subpillar_desc' => $value->subpillar_desc,
						'last_score' => number_format($get_last_score, 2),
						'current_score' => number_format($value->score, 2),
					); 

					$last_score[$value->pillar_desc][] = $get_last_score;
					$current_score[$value->pillar_desc][] = $value->score;
					
				}
								
				foreach ($getData as $key_dt => $value_dt) {
					$last_score_pillar = array_sum($last_score[$key_dt]) / count($last_score[$key_dt]);
                    $current_score_pillar = array_sum($current_score[$key_dt]) / count($current_score[$key_dt]);
					$resultData['2019'][$key_dt] = array('score' => number_format($last_score_pillar, 2));
					$resultData[$subpillar['year']][$key_dt] = array('name' => $key_dt, 'score' => number_format($current_score_pillar, 2));
				}
				
				$year_active = ($subpillar['year'])?$subpillar['year']:date('Y');
				
				$fields = array('2019' => 'score', $year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

			/*pie chart*/
			if($params['prefix']==2){
				$kl = isset($CI->session->userdata('user')->kl_id)?$CI->session->userdata('user')->kl_id:0;
				// get subpillar active
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl);
				// echo '<pre>';print_r($subpillar);die;
				$getData = array();
				foreach ($subpillar['data'] as $key => $value) {
					
					$getData['draft'][] = ($value->data_type=='draft')?1:0;
					$getData['national'][] = ($value->data_type=='national')?1:0;
					$getData['international'][] = ($value->data_type=='international')?1:0;
					$getData['unfill'][] = ($value->data_type==null)?1:0;
				}
				$arr_field = array('draft', 'national', 'international', 'unfill');
				// echo '<pre>';print_r($getData);die;

				foreach ($arr_field as $k => $v) {
					
					$total = array_sum($getData[$v]);
					$data[] = array( 'name' => $v, 'total' => $total);
				}
				
				// echo '<pre>';print_r($data);die;

				$fields = array('name' => 'total');
				$title = '<span style="font-size:13.5px">percentage of data status</span>';
				$subtitle = 'Tanggal '.$CI->tanggal->formatDate(date('Y-m-d')).'';
			}

			if($params['prefix']==3){
				$kl = isset($_GET['kl'])?$_GET['kl']:0;
				$params_year = isset($_GET['year'])?$_GET['year']:'';
				$subpillar = $CI->master->getSubpillarCurrentByKl($kl, $params_year);
				// echo '<pre>';print_r($subpillar);die;
				$data['year_current'] = isset($subpillar['year'])?$subpillar['year']:0;
				$getData = array();
				$last_score = array();
				$current_score = array();
				foreach ($subpillar['data'] as $key => $value) {
					// get last score by subpillar
					$get_last_score = ($value->last_score==NULL)?$CI->master->getScoreSubpillarLastYear($kl, $value->key_subpillar, $subpillar['year']) : $value->last_score;

					$getData[] = array(
						'subpillar_desc' => $value->subpillar_desc,
						'last_score' => number_format($get_last_score, 2),
						'current_score' => number_format($value->score, 2),
					); 
					
				}
				foreach ($getData as $key_dt => $value_dt) {
					$resultData['2019'][$value_dt['subpillar_desc']] = array('score' => $value_dt['last_score']);
					$resultData[$subpillar['year']][$value_dt['subpillar_desc']] = array('name' => $value_dt['subpillar_desc'], 'score' => $value_dt['current_score']);
				}
				// echo '<pre>';print_r($resultData);die;
				
				$year_active = ($subpillar['year'])?$subpillar['year']:date('Y');
				
				$fields = array('2019' => 'score', $year_active => 'score');
				$title = '<span style="font-size:20.5px">Travel & Tourism Competitiveness Index<br></span>';
				$subtitle = '';
				/*excecute query*/
				$data = $resultData;
			}

		}
		
		
		/*find and set type chart*/
		$chart = $this->chartTypeData($params['TypeChart'], $fields, $params, $data);
		$chart_data = array(
			'title' 	=> $title,
			'subtitle' 	=> $subtitle,
			'xAxis' 	=> isset($chart['xAxis'])?$chart['xAxis']:'',
			'series' 	=> isset($chart['series'])?$chart['series']:'',
		);
		// echo '<pre>';print_r($data);die;

		return $chart_data;
		
    }


    public function chartTypeData($style, $fields, $params, $data){

    	switch ($style) {
    		case 'column':
    			/*lanjutkan buat function jika ada style yang lain*/
    			if ($params['style']==1) {
    				return $this->ColumnStyleOneData($fields, $params, $data);
    			}
    			break;
    		case 'pie':
    			if ($params['style']==1) {
    				return $this->PieStyleOneData($fields, $params, $data);
    			}
    			break;
    		case 'line':
    			if ($params['style']==1) {
    				return $this->LineStyleOneData($fields, $params, $data);
    			}
    			break;
    		case 'table':
    			if ($params['style']==1) {
    				return $this->TableStyleOneData($fields, $params, $data);
    			}
				break;
			
			case 'polar':
				if ($params['style']==1) {
					return $this->PolarStyleOne($fields, $params, $data);
				}
				if ($params['style']==2) {
					return $this->PolarStyleTwo($fields, $params, $data);
				}
				break;
			
			case 'radar-zoomable':
				if ($params['style']==1) {
					return $this->RadarZoomableStyleOne($fields, $params, $data);
				}
				break;
			
			case 'bar':
				if ($params['style']==1) {
					return $this->BarStyleOne($fields, $params, $data);
				}
				break;
    		
    		default:
    			# code...
    			break;
    	}
    }
    public function ColumnStyleOneData($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
        $getData = array();
		foreach($data as $key=>$row){
			foreach ($fields as $kf => $vf) {
				$getData[$kf][$row['bulan']-1] = (int)$row[$vf];
			}
		}
		
		for ($i=0; $i < 12; $i++) { 
			foreach ($fields as $kf2 => $vf2) {
				if(!isset($getData[$kf2][$i])){
					$getData[$kf2][$i] = 0;
				}
				ksort($getData[$kf2]);
			}
			$categories[] = $CI->tanggal->getBulan($i+1);
			
		}

		foreach ($getData as $k => $r) {
			$series[] = array('name' => $k, 'data' => $r );
		}
		
		$chart_data = array(
			'xAxis' 	=> array('categories' => $categories),
			'series' 	=> $series,
		);
		return $chart_data;
	}
	
	public function PolarStyleOne($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
		$getData = array();
		
		foreach($data as $key=>$row){
			foreach ($row as $k_dt => $v_dt) {
				$getData[$key][] = (float)$v_dt['score'];
				if($key=='2019'){
					$categories[] = $k_dt;
				}
			}
		}
		
		foreach ($getData as $k => $r) {
			$name = ($k != 2019) ? $k.' (P)' : $k;
			$series[] = array('name' => $name, 'data' => $r, 'pointPlacement' => 'on' );
		}
		
		$chart_data = array(
			'xAxis' 	=> array('categories' => $categories, 'tickmarkPlacement' => 'on', 'lineWidth' => 0),
			'series' 	=> $series,
		);
		
		// echo '<pre>';print_r($chart_data);die;
		return $chart_data;
	}

	public function PolarStyleTwo($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
		$getData = array();
		
		foreach($data as $key=>$row){
			foreach ($row as $k_dt => $v_dt) {
				$getData[$key][] = (float)$v_dt['score'];
				$categories[] = $k_dt;
			}
		}
		
		foreach ($getData as $k => $r) {
			$name = $k;
			$series[] = array('name' => $name, 'data' => $r, 'pointPlacement' => 'on' );
		}
		
		$chart_data = array(
			'xAxis' 	=> array('categories' => $categories, 'tickmarkPlacement' => 'on', 'lineWidth' => 0),
			'series' 	=> $series,
		);
		
		// echo '<pre>';print_r($chart_data);die;
		return $chart_data;
	}
	
	public function RadarZoomableStyleOne($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
		$getData = array();
		
		// echo '<pre>';print_r($data);die;
		foreach($data as $key=>$row){
			foreach ($row as $k_dt => $v_dt) {
				$getData[$k_dt][] = (float)$v_dt['score'];
			}
			$year[] = $key;
		}
		

		foreach ($getData as $k => $r) {
			$chart_dt[] = array('category' => $k, 'value_'.$year[0].'' => $r[0], 'value_'.$year[1].'' => $r[1]);
		}
		$series = array('category' => $year, 'data' => $chart_dt);
		
		
		$chart_data = array(
			'series' 	=> $series,
			'data' 	=> $chart_dt,
		);
		// echo '<pre>';print_r($chart_data);die;
		
		return $chart_data;
    }

    public function PieStyleOneData($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
        $getData = array();
		foreach($data as $key=>$row){
			foreach ($fields as $kf => $vf) {
				$getData[$row[$kf]][] = (int)$row[$vf];
			}
		}

		foreach ($getData as $k => $r) {
			$series[] = array($k, array_sum($r));
		}
		$chart_data = array(
			'series' 	=> $series,
		);
		return $chart_data;
    }

    public function LineStyleOneData($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
        $getData = array();
		foreach($data as $key=>$row){
			foreach ($fields as $kf => $vf) {
				$getData[$kf][$row['bulan']-1] = (int)$row[$vf];
			}
		}
		
		for ($i=0; $i < 12; $i++) { 
			foreach ($fields as $kf2 => $vf2) {
				if(!isset($getData[$kf2][$i])){
					$getData[$kf2][$i] = 0;
				}
				ksort($getData[$kf2]);
			}
			$categories[] = $CI->tanggal->getBulan($i+1);
			
		}

		foreach ($getData as $k => $r) {
			$series[] = array('name' => $k, 'data' => $r );
		}
		
		$chart_data = array(
			'xAxis' 	=> array('categories' => $categories),
			'series' 	=> $series,
		);
		return $chart_data;
	}
	
	public function BarStyleOne($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
		$getData = array();
		foreach($data as $key=>$row){
			foreach ($row as $k_dt => $v_dt) {
				$getData[$key][] = (float)$v_dt['score'];
				if($key=='2019'){
					$categories[] = $k_dt;
				}
			}
		}
		// echo '<pre>';print_r($row);die;
		
		foreach ($getData as $k => $r) {
			$series[] = array('name' => $k, 'data' => $r);
		}
		
		$chart_data = array(
			'xAxis' 	=> array('categories' => $categories),
			'series' 	=> $series,
		);
		
		// echo '<pre>';print_r($chart_data);die;
		return $chart_data;
    }

    public function TableStyleOneData($fields, $params, $data){
    	$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
    	
        $html = '';
        $html .='<table class="table table-bordered table-hover"><thead>
			        <tr><th width="20px" class="center">No</th>';
		        foreach ($fields as $kf => $vf) {
		        	$html .= '<th>'.ucfirst($kf).'</th>';
		        }
      	$html .='</thead>';
      	$html .='<tbody>';
      	$no=0;
      	foreach ($data as $key => $value) { $no++;
      		$html .='<tr>';
	      	$html .='<td align="center">'.$no.'</td>';
	      	foreach ($fields as $keyf => $valuef) {
	      		$html .='<td align="left">'.ucwords(strtolower($value[$valuef])).'</td>';
	      	}
	      	$html .='</tr>';
      	}
      	
      	$html .='</tbody>';
      	$html .='</table>';

        $chart_data = array(
			'xAxis' 	=> 0,
			'series' 	=> $html,
		);
		return $chart_data;
    }
	
}

?> 
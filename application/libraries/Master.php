<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

final Class Master {


    function get_tahun($nid='',$name,$id,$class='',$required='',$inline='') {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$year = array();
		$now = date('Y');
		for ($i=$now-2; $i < $now+2 ; $i++) { 
			$year[] = $i;
		}
		$data = $year;

		$selected = $nid?'':'selected';
		$readonly = '';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.=$fieldset.'
		<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >';

				foreach($data as $row){
					$sel = $nid==$row?'selected':'';
					$field.='<option value="'.$row.'" '.$sel.' >'.strtoupper($row).'</option>';
				}	
			
		$field.='
		</select>
		'.$fieldsetend;
		
		return $field;
		
    }

    function custom_selection_radio($custom=array(), $nid='',$name,$id,$class='',$required='',$inline='') {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		
		if(isset($custom['where_in'])){
			$db->where_in($custom['where_in']['col'],$custom['where_in']['val']);
			$data = $db->get($custom['table'])->result_array();

		}else if(isset($custom['like'])&&isset($custom['where'])){
			$db->like($custom['like']['col'],$custom['like']['val']);
			$db->where($custom['where']);
			$data = $db->get($custom['table'])->result_array();
		}else{
			$data = $db->where($custom['where'])->get($custom['table'])->result_array();
		}

		$field='';

		$field.='<div class="checkbox">';
		foreach($data as $row){
			$sel = $nid==$row[$custom['id']]?'checked':'';
			$field.='<label>';
			$field.='<input type="checkbox" name="'.$name.'" class="ace" value="'.$row[$custom['id']].'" '.$sel.'>';
			$field.='<span class="lbl"> '.$row[$custom['name']].' </span>';
			$field.='</label>';
		}	
		$field.='</div>';
			
		
		return $field;
		
    }
    
    function get_bulan($nid='',$name,$id,$class='',$required='',$inline='') {
		//print_r($nid);die;
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$year = array();
		for ($i=1; $i < 13 ; $i++) { 
			$list = array(
				'key' => $i,
				'value' => $CI->tanggal->getBulan($i),
				);
			$year[] = $list;
		}
		$data = $year;

		$selected = $nid?'':'selected';
		$readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.=$fieldset.'
		<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >
			<option value="0" '.$selected.'> - Select All - </option>';

				foreach($data as $row){
					$sel = $nid==$row['key']?'selected':'';
					$field.='<option value="'.$row['key'].'" '.$sel.' >'.strtoupper($row['value']).'</option>';
				}	
			
		$field.='
		</select>
		'.$fieldsetend;
		
		return $field;
		
    }

    function custom_selection($custom=array(), $nid='',$name,$id,$class='',$required='',$inline='') {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		
		if(isset($custom['where_in'])){
			$db->where_in($custom['where_in']['col'],$custom['where_in']['val']);
			$data = $db->get($custom['table'])->result_array();

		}else if(isset($custom['where'])&&isset($custom['where_in'])){
			$db->where_in($custom['where_in']['col'],$custom['where_in']['val']);
			$db->where($custom['where']);
			$data = $db->get($custom['table'])->result_array();
		}else if(isset($custom['like'])&&isset($custom['where'])){
			$db->like($custom['like']['col'],$custom['like']['val']);
			$db->where($custom['where']);
			$data = $db->get($custom['table'])->result_array();
		}else{
			$data = $db->where($custom['where'])->get($custom['table'])->result_array();
		}
        //$data = $db->where($custom['where'])->get($custom['table'])->result_array();
		
		$selected = $nid?'':'selected';
		$readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.='
		<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >
			<option value="" '.$selected.'> - Select All - </option>';

				foreach($data as $row){
					$sel = $nid==$row[$custom['id']]?'selected':'';
					$field.='<option value="'.$row[$custom['id']].'" '.$sel.' >'.strtoupper($row[$custom['name']]).'</option>';
				}	
			
		$field.='
		</select>
		';
		
		return $field;
		
    }

    function custom_selection_with_db_selected($custom=array(), $nid='',$name,$id,$class='',$required='',$inline='', $load_db) {
		
		$CI =&get_instance();
		$db = $CI->load->database($load_db, TRUE);
		
		if(isset($custom['where_in'])){
			$db->where_in($custom['where_in']['col'],$custom['where_in']['val']);
			$data = $db->get($custom['table'])->result_array();

		}else if(isset($custom['where'])&&isset($custom['where_in'])){
			$db->where_in($custom['where_in']['col'],$custom['where_in']['val']);
			$db->where($custom['where']);
			$data = $db->get($custom['table'])->result_array();
		}else if(isset($custom['like'])&&isset($custom['where'])){
			$db->like($custom['like']['col'],$custom['like']['val']);
			$db->where($custom['where']);
			$data = $db->get($custom['table'])->result_array();
		}else{
			$data = $db->where($custom['where'])->get($custom['table'])->result_array();
		}
        //$data = $db->where($custom['where'])->get($custom['table'])->result_array();
		
		$selected = $nid?'':'selected';
		$readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.='
		<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >
			<option value="" '.$selected.'> - Select All - </option>';

				foreach($data as $row){
					$sel = $nid==$row[$custom['id']]?'selected':'';
					$field.='<option value="'.$row[$custom['id']].'" '.$sel.' >'.strtoupper($row[$custom['name']]).'</option>';
				}	
			
		$field.='
		</select>
		';
		
		return $field;
		
    }

    function custom_selection_checkbox($custom=array(), $nid='',$name, $id, $class='', $required='', $inline='') {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		
		if(isset($custom['where_in'])){
			$db->where_in($custom['where_in']['col'],$custom['where_in']['val']);
			$data = $db->get($custom['table'])->result_array();

		}else if(isset($custom['where'])&&isset($custom['where_in'])){
			$db->where_in($custom['where_in']['col'],$custom['where_in']['val']);
			$db->where($custom['where']);
			$data = $db->get($custom['table'])->result_array();
		}else if(isset($custom['like'])&&isset($custom['where'])){
			$db->like($custom['like']['col'],$custom['like']['val']);
			$db->where($custom['where']);
			$data = $db->get($custom['table'])->result_array();
		}else{
			$data = $db->where($custom['where'])->get($custom['table'])->result_array();
		}
        //$data = $db->where($custom['where'])->get($custom['table'])->result_array();
		
		$selected = explode(',', $nid);
		$readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.='<div class="checkbox">';
		foreach($data as $row){
			if( in_array($row[$custom['name']], $selected)){
				$checked = 'checked';
			}else{
				$checked = '';
			}
			$field.='
	              <label>
	                <input name="'.$name.'" type="checkbox" class="ace" value="'.$row[$custom['name']].'" '.$checked.'>
	                <span class="lbl"> '.ucwords( $row[$custom['name']] ).' </span>
	              </label>
			';
		}	
		$field.='</div>';
			
		
		return $field;
		
    }


    function custom_selection_with_join($custom=array(), $nid='',$name,$id,$class='',$required='',$inline='') {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		
		$select = array( $custom['id'], $custom['name'] );
		$db->select( $select );
		foreach ($custom['join'] as $k => $v) {
			$db->join($v['relation_table'],$custom['table'].'.'.$v['relation_ref_id'].'='.$v['relation_table'].'.'.$v['relation_id'],$v['join_type']);
		}
        $db->where($custom['where']);
        foreach ($select as $rw) {
        	$db->group_by($rw, 'ASC');
        }
		$data = $db->get($custom['table'])->result_array();

		$selected = $nid?'':'selected';
		$readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.='
		<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >
			<option value="" '.$selected.'> - Select All - </option>';

				foreach($data as $row){
					$sel = $nid==$row[$custom['id']]?'selected':'';
					$field.='<option value="'.$row[$custom['id']].'" '.$sel.' >'.strtoupper($row[$custom['name']]).'</option>';
				}	
			
		$field.='
		</select>
		';
		
		return $field;
		
    }


    function on_change_custom_selection($custom=array(), $nid='',$name,$id,$class='',$required='',$inline='') {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		
		if($nid != ''){
        	$data = $db->where($custom['id'], $nid)
        			   ->where($custom['where'])
        			   ->get($custom['table'])->result_array();
		}else{
			$data = array();
		}
		
		$selected = $nid?'':'selected';
		$readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.='
		<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >
			<option value="" '.$selected.'> - Select All - </option>';

				foreach($data as $row){
					$sel = $nid==$row[$custom['id']]?'selected':'';
					$field.='<option value="'.$row[$custom['id']].'" '.$sel.' >'.strtoupper($row[$custom['name']]).'</option>';
				}	
			
		$field.='
		</select>
		';
		
		return $field;
		
    }

    function get_change($params=array(), $nid='',$name,$id,$class='',$required='',$inline='') {
        
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        
        if($nid!=''){
            $data = $db->where($params['id'], $nid)->get($params['table'])->result_array();
        }else{
            $data = array();
        }

        $selected = $nid?'':'selected';
        $readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
        
        $starsign = $required?'*':'';
        
        $fieldset = $inline?'':'<fieldset>';
        $fieldsetend = $inline?'':'</fieldset>';
        
        $field='';
        $field.=$fieldset.'
        <select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >
            <option value="0" '.$selected.'> - Select All - </option>';
                foreach($data as $row){
                    $sel = $nid==$row[$params['id']]?'selected':'';
                    $field.='<option value="'.$row[$params['id']].'" '.$sel.' >'.strtoupper($row[$params['name']]).'</option>';
                }
                
            
        $field.='
        </select>
        '.$fieldsetend;
        return $field;
        
    }
    

    function get_custom_data($table, $select, $where, $return) {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$db->select($select);
		$db->from($table);
		$db->where($where);
		$qry = $db->get()->$return();
		return $qry;
		
    }

    function get_max_number($table, $field) {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$db->select_max($field);
		$db->from($table);
		$qry = $db->get()->row();
		/*plus 1*/
		$max_num = $qry->$field + 1 ;
		return $max_num;
		
    }

	function get_max_number_per_month($table, $field, $field_date, $db) {
		
		$CI =&get_instance();
		$db = $CI->load->database($db, TRUE);
		$db->from($table);
		$db->where('MONTH('.$field_date.')', date('m'));
		$qry = $db->get()->num_rows();
		/*plus 1*/
		$max_num = $qry + 1 ;
		$format = $this->get_length_num(5, $max_num);
		return $format;
		
	}

	function get_length_num($length, $num){
		$null = '';
		for( $i = 0; $i < $length; $i++ ){
			$null .= '0';
		}
		$length_null = $null.$num;
		$strlen = strlen($length_null);
		if( $strlen > $length ){
			$offset = $strlen - $length;
			$num = substr($length_null,$offset,$length);
		}else{
			$num = $length_null;
		}
		
		return $num;
	}
	
	function show_detail_row_table( $fields, $data, $exp_field=[]){

		$CI =&get_instance();
		$CI->load->library('session');
		$sess_role = $CI->session->userdata('user')->role;
		$html = '<br>';
	 $html .= '<div class="row"><div class="col-md-12">';
	 $html .= '<b>DETAIL DATA</b><br>';
		
		$exp_field_origin = array('is_active','is_deleted','log_id');
		$merge_exp_field = array_merge($exp_field_origin, $exp_field);
	 $html .= '<table>';
		if($sess_role=='Admin Sistem'){
		 foreach ($fields as $key => $value) {
			 if(!in_array($value, $exp_field )){
				 $html .= '<tr>';    
				 $html .= '<td width="150px">'.ucfirst($value).'</td><td style="text-align: justify"> '.$data->$value.'</td>';    
				 $html .= '</tr>';    
			 }
		 }
		}else{
		 foreach ($fields as $key => $value) {
			 if(!in_array($value, $merge_exp_field )){
				 $html .= '<tr>';    
				 $html .= '<td width="150px">'.ucfirst($value).'</td><td> '.$data->$value.'</td>';    
				 $html .= '</tr>';  
			 }
		 }
		}
	 $html .= '<table>';
	 $html .= '</div></div">';

		return $html;

	}

   	function get_content_dashboard() {
		
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);

		$data = array();
		/*total room*/
		$total_room = $db->select('SUM(limit_room) as total')->get_where('cms_product', array('is_active' => 'Y') )->row();

		/*new user*/
		$total_user = $db->select('COUNT(customer_id) as total')->get_where('cms_customer', array('is_active' => 'Y', 'MONTH(created_date)' => date('m')) )->row();

		/*booking today*/
		$total_booking = $db->select('COUNT(booking_id) as total')->get_where('cms_t_booking', array('DAY(created_date)' => date('d')) )->row();

		/*new booking today*/
		$total_new_booking = $db->select('COUNT(booking_id) as total')->get_where('cms_t_booking', array('status' => 0) )->row();

		/*success order today*/
		$total_success_order = $db->select('COUNT(booking_id) as total')->get_where('cms_t_booking', array('status' => 1) )->row();

		/*success order today*/
		$total_cancel_order = $db->select('COUNT(booking_id) as total')->get_where('cms_t_booking', array('status' => 3) )->row();

		/*total review*/
		$total_review = $db->select('COUNT(id) as total')->get('cms_product_has_reviews')->row();

		/*product views*/
		$total_read = $db->select('SUM(count_read) as total')->get_where('cms_product', array('is_active' => 'Y') )->row();

		$data['total_room'] = $total_room->total;
		$data['total_user'] = $total_user->total;
		$data['total_booking'] = $total_booking->total;
		$data['total_new_booking'] = $total_new_booking->total;
		$data['total_success_order'] = $total_success_order->total;
		$data['total_cancel_order'] = $total_cancel_order->total;
		$data['total_review'] = $total_review->total;
		$data['total_read'] = $total_read->total;
		return $data;
		
    }

	function custom_selection_no_database($data=array(), $nid='',$name,$id,$class='',$required='',$inline='', $load_db) {
		
		$selected = $nid?'':'selected';
		$readonly = '';//$CI->session->userdata('nrole')=='approver'?'readonly':'';
		
		$starsign = $required?'*':'';
		
		$fieldset = $inline?'':'<fieldset>';
		$fieldsetend = $inline?'':'</fieldset>';
		
		$field='';
		$field.='
		<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$readonly.' '.$required.' >
			<option value="" '.$selected.'> - Select All - </option>';

				foreach($data as $row){
					$sel = $nid==$row?'selected':'';
					$field.='<option value="'.$row.'" '.$sel.' >'.strtoupper($row).'</option>';
				}	
			
		$field.='
		</select>
		';
		
		return $field;
		
	}
	
	public function getScore($params){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		// get last data index
		$master = $db->get_where('mst_subpillar', array('subpillar_id' => $params['subpillar'] ) )->row();
		
		$config = array(
			'max_exclusive_filter' => $master->max_exclusive_filter,
			'is_exclusive' => $master->is_exclusive,
			'is_child' => $master->is_child,
			'is_outlayer' => $master->is_outlayer,
			'type' => $master->type_data,
			'formula' => $master->formula,
			'weighted' => $master->weighted,
			'min' => $master->min_value,
			'max' => $master->max_value,
			'med' => $master->med_value,
			'value' => $params['current_value'],
		);
		$score = $this->FormulaScore($config);
		return array('master_dt' => $master, 'score' => $score);

	}

	public function FormulaScore($config){

		$value = ($config['value'] != NULL) ? $config['value'] : 0;

		// formula condition
		if( $config['is_outlayer'] == 'Y') {
			$mst_max = $config['med'];
		}elseif ( $config['is_exclusive'] == 'Y') {
			$mst_max =  $config['value'];
		}else{
			$mst_max = $config['max'];
		}
		
		$pembanding = ($value - $config['min']) / ($config['max'] - $config['min']);
		// jika merupakan data primary (E)
		if($config['type'] == 'E'){
			$score = $value + $config['weighted'];
		// jika merupakan data sekunder (S)
		}else{
			if($config['formula'] == 1){
				$pengkali_ = (6 * $pembanding) + 1;
				$score = $pengkali_ + $config['weighted'];
			}else{
				$pengkali_ = (-6 * $pembanding) + 7;
				$score = $pengkali_ + $config['weighted'];
			}
		}
		
		return isset($score)?$score:0;
	}

	public function getTypeDataFormat($data_type){
		switch ($data_type) {
			case 'draft':
				# code...
				$format = '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill kt-badge--rounded">draft</span>';
				break;
			
			case 'national':
				# code...
				$format = '<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-badge--rounded">national publication</span>';
				break;
			
			case 'international':
				# code...
				$format = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">international publication</span>';
				break;
				
			
			default:
				# code...
				$format = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">not filled</span>';
				break;
		}
		return $format;
	}

	public function getLastValueBySubpillar($params){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$last_year = $params['year'] - 1;
		$selected_year = $params['year'];
		// get last data
		$last_data = $db->get_where('tr_data', array('kl_id' => $params['kl'],'subpillar_id' => $params['subpillar'], 'year' => $last_year))->row();
		if(!empty($last_data)){
			$last_value = $last_data->last_value;
		}else{
			// get last value from master
			$mst_subpillar = $db->get_where('mst_subpillar', array('subpillar_id' => $params['subpillar']))->row();
			$last_value = $mst_subpillar->data_value;
		}
		return $last_value;

	}

	public function getOverallScore($kl_id, $current_year){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		// get data inputted
		$filter = ($kl_id != 0) ? array('kl_id' => $kl_id, 'year' => $current_year) : array('year' => $current_year);
		// total subpillar 
		$filter_kl = ($kl_id != 0) ? array('kl_id' => $kl_id, 'is_active' => 'Y') : array('is_active' => 'Y');
		$total_subpillar = $db->get_where('mst_subpillar', $filter_kl)->result();
		$last_data = $db->get_where('tr_data', $filter)->result();

		if(count($last_data) == 0){
			return false;
		}else{
			$arr_score = array();
			$count_data = count($total_subpillar);
			foreach ($last_data as $key => $value) {
				$arr_score[] = $value->score;
			}
			$score = array_sum($arr_score) / $count_data;
			return $score;
		}
	}

	public function getScoreBySubpillar($subpillar_id, $year){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		// get data inputted
		$filter = ($kl_id != 0) ? array('kl_id' => $kl_id, 'year' => $current_year) : array('year' => $current_year);
		
		$last_data = $db->get_where('tr_data', $filter)->result();

		if(count($last_data) == 0){
			return false;
		}else{
			$arr_score = array();
			$count_data = count($last_data);
			foreach ($last_data as $key => $value) {
				$arr_score[] = $value->score;
			}
			$score = array_sum($arr_score) / $count_data;
			return $score;
		}
	}
	
	public function getOverallScoreLastYear($kl_id, $last_year){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		// get data inputted
		$filter_kl = ($kl_id != 0) ? array('kl_id' => $kl_id) : array();
		
		$db->from('tr_data');
		$db->where($filter_kl);
		$db->where('year < '.$last_year.'');
		$last_data = $db->get()->result();
		// echo $db->last_query();die;
		if(count($last_data) == 0){
			// get data from master
			$filter_subpillar = ($kl_id != 0) ? array('kl_id' => $kl_id, 'is_active' => 'Y') : array('is_active' => 'Y');
			$data_cut_off_score = $db->get_where('mst_subpillar', $filter_subpillar)->result();
			foreach($data_cut_off_score as $row_dt){
				$config = array(
					'max_exclusive_filter' => $row_dt->max_exclusive_filter,
					'is_exclusive' => $row_dt->is_exclusive,
					'is_child' => $row_dt->is_child,
					'is_outlayer' => $row_dt->is_outlayer,
					'type' => $row_dt->type_data,
					'formula' => $row_dt->formula,
					'weighted' => $row_dt->weighted,
					'min' => $row_dt->min_value,
					'max' => $row_dt->max_value,
					'med' => $row_dt->med_value,
					'value' => $row_dt->data_value,
				);
				$arr_score[] = $this->FormulaScore($config);
			}
			$score = array_sum($arr_score) / count($data_cut_off_score) ;
			return $score;
		}else{
			$arr_score = array();
			$count_data = count($last_data);
			foreach ($last_data as $key => $value) {
				$arr_score[] = $value->score;
			}
			$score = array_sum($arr_score) / $count_data;
			return $score;
		}
	}

	public function getSubpillarActiveByKl($kl){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$data = $db->get_where('mst_subpillar', array('is_active' => 'Y', 'kl_id' => $kl));
		return $data->result();
	}

	public function getProgressCurrent($kl_id, $current_year){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		// get data inputted
		$filter = ($kl_id != 0) ? array('tr_data.kl_id' => $kl_id, 'year' => $current_year, 'tr_data_header.is_active' => 'Y') : array('year' => $current_year, 'tr_data_header.is_active' => 'Y');

		// $last_data = $db->join('mst_subpillar','mst_subpillar.subpillar_id=tr_data.subpillar_id','left')->join('tr_data_header','tr_data_header.dh_id=tr_data.dh_id','left')->where('CAST(current_value as DOUBLE) != 0')->where('type_data', 'S')->get_where('tr_data', $filter)->result();

		$last_data = $db->join('mst_subpillar','mst_subpillar.subpillar_id=tr_data.subpillar_id','left')->join('tr_data_header','tr_data_header.dh_id=tr_data.dh_id','left')->where('CAST(current_value as DECIMAL(9,2)) != 0')->where('type_data', 'S')->get_where('tr_data', $filter)->result();

		
		// get subpillar active
		$filter_subpillar = ($kl_id != 0) ? array('kl_id' => $kl_id, 'is_active' => 'Y') : array('is_active' => 'Y');
		$subpillar = $db->where('type_data', 'S')->get_where('mst_subpillar', $filter_subpillar)->result();
		
		if(count($last_data) == 0){
			return false;
		}else{
			$progress = (count($last_data) / count($subpillar)) * 100;
			return array('total_dt' => count($last_data), 'persentase_progress' => $progress, 'total_subpillar' => count($subpillar));
		}
	}

	public function getColorFromValue($value){
		if ($value <= 50 ) {
			$color = array('class' => 'danger', 'color' => 'red');
		}elseif ($value <= 75) {
			$color = array('class' => 'success', 'color' => 'green');
		}else {
			$color = array('class' => 'primary', 'color' => 'blue');
		}
		return $color;
	}

	public function getSignScore($a, $b){
		if($a > $b){
			$sign = '<span class="arrow-up-color" style="color: green"><i class="fa fa-arrow-up"></i></span>';
		}elseif ($a < $b) {
			$sign = '<span class="arrow-down-color" style="color: red"><i class="fa fa-arrow-down"></i></span>';
		}else{
			$sign = '';
		}
		return $sign;
	}

	public function getYearActive($kl_id){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$filter = ($kl_id != 0) ? array('kl_id' => $kl_id, 'is_active' => 'Y') : array( 'is_active' => 'Y') ;
		$db->select_max('dh_year');
		$db->from('tr_data_header');
		$db->where($filter);
		$result = $db->get()->row();
		if(!empty($result)){
			$year = $result->dh_year;
		}else{
			$year = 0;
		}
		return $year;
	}
	
	public function getIndicatorByProvince($province, $params_year=''){

		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		// get year active
		$year = $params_year;
		// get subpillar data active
		$db->select('ipkn_mst_indicator.pillar_id, pillar_desc, AVG(ipkn_tr_data.value) as avg_value, AVG(ipkn_tr_data.score) as avg_score');
		$db->from('ipkn_tr_data');
		$db->join('ipkn_mst_indicator','ipkn_mst_indicator.indicator_id=ipkn_tr_data.indicator_id','left');
		$db->join('ipkn_mst_pillar','ipkn_mst_pillar.pillar_id=ipkn_mst_indicator.pillar_id','left');
		$db->join('ipkn_mst_subindex','ipkn_mst_subindex.index_id=ipkn_mst_pillar.index_id','left');
		$db->join('ipkn_tr_data_header','ipkn_tr_data_header.dh_id=ipkn_tr_data.dh_id','left');
		$db->where('dh_year', $year);
		if($province > 0){
			$db->where('ipkn_tr_data.province_id', $province);
		}
		$db->group_by('ipkn_mst_indicator.pillar_id, pillar_desc');
		$dt = $db->get()->result();
		// print_r($db->last_query());die;
		
		// echo '<pre>';print_r($getData);die;
		return array('year' => $year, 'data' => $dt);
	}

	public function getSubpillarCurrentByKl($kl_id, $params_year=''){

		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		// get year active
		$year_active = ($params_year == '') ? $this->getYearActive($kl_id) : $params_year;
		$year = ($year_active != false)?$year_active:0;
		// filter
		$filter_kl = ($kl_id != 0) ? array('mst_subpillar.kl_id' => $kl_id) : array();
		// get subpillar data active
		$db->select('t_data.*, mst_subpillar.subpillar_desc, mst_subpillar.type_data, mst_subpillar.formula, mst_subpillar.weighted, mst_subpillar.min_value, mst_subpillar.max_value, mst_pillar.pillar_desc, mst_subpillar.subpillar_id as key_subpillar, mst_subpillar.data_value, mst_subpillar.type_data, index_desc, pillar_icon, pillar_note, mst_subpillar.note as subpillar_note, is_exclusive, is_outlayer, is_child, is_summed_as_single, is_aggregation, mst_subpillar.pillar_id as pillar_id_master, mst_subpillar.parent_subpillar');
		$db->from('mst_subpillar');
		$db->join('(SELECT * FROM tr_data WHERE year = '.$year.' ) as t_data','mst_subpillar.subpillar_id=t_data.subpillar_id','left');
		$db->join('mst_pillar','mst_pillar.pillar_id=mst_subpillar.pillar_id','left');
		$db->join('mst_index','mst_index.index_id=mst_pillar.index_id','left');
		$db->where($filter_kl);
		$db->where('mst_subpillar.is_active', 'Y');
		$dt = $db->get()->result();
		// print_r($db->last_query());die;
		
		// echo '<pre>';print_r($getData);die;
		return array('year' => $year, 'data' => $dt);
	}

	public function getScoreSubpillarLastYear($kl_id, $subpillar_id, $year){

		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);

		$filter = ($kl_id != 0) ? 'and kl_id='.$kl_id.'' : '';
		// get subpillar data active
		$db->select('t_data.*, mst_subpillar.subpillar_desc, mst_subpillar.type_data, mst_subpillar.formula, mst_subpillar.weighted, mst_subpillar.min_value, mst_subpillar.med_value, mst_subpillar.max_value, mst_pillar.pillar_desc, mst_subpillar.data_value, is_exclusive, is_outlayer, is_child, is_summed_as_single, is_aggregation, max_exclusive_filter, mst_subpillar.subpillar_id as key_subpillar');
		$db->from('mst_subpillar');
		$db->join('(SELECT * FROM tr_data WHERE year = (select dh_year from tr_data_header where is_active='."'Y'".' and dh_year < '.$year.' '.$filter.'  order by dh_year DESC limit 1) ) as t_data','mst_subpillar.subpillar_id=t_data.subpillar_id','left');
		$db->join('mst_pillar','mst_pillar.pillar_id=t_data.pillar_id','left');
		$db->where('mst_subpillar.subpillar_id', $subpillar_id);
		$dt = $db->get()->row();
		// print_r($db->last_query());die;
		$config = array(
			'max_exclusive_filter' => $dt->max_exclusive_filter,
			'is_exclusive' => $dt->is_exclusive,
			'is_child' => $dt->is_child,
			'is_outlayer' => $dt->is_outlayer,
			'type' => $dt->type_data,
			'formula' => $dt->formula,
			'weighted' => $dt->weighted,
			'min' => $dt->min_value,
			'med' => $dt->med_value,
			'max' => $dt->max_value,
			'value' => ($dt->data_id==null)? $dt->data_value : $dt->current_value,
		);
		$score = $this->FormulaScore($config);
		
		return $score;
	}

	function getSubpillarDataBySubpillarId($subpillar_id, $year){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);

		$db->select('mst_subpillar.*, last_value, last_score, current_value, score, data_type, year');
		$db->from('mst_subpillar');
		$db->join('(SELECT * FROM tr_data WHERE year = (select dh_year from tr_data_header where is_active='."'Y'".' and dh_year < '.$year.'  order by dh_year DESC limit 1) ) as t_data','mst_subpillar.subpillar_id=t_data.subpillar_id','left');
		$db->join('mst_pillar','mst_pillar.pillar_id=t_data.pillar_id','left');
		$db->where('mst_subpillar.subpillar_id', $subpillar_id);
		$dt = $db->get()->row();

		return $dt;

	}
	function getRanking($score){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$rank = $db->select('score')->from('mst_rank')->order_by('score', 'DESC')->get()->result_array();
		foreach($rank as $row_rank){
			$valueRank[] = $row_rank['score'];
		}
		$arr_score = array($score);
		$merge_array = array_merge($valueRank, $arr_score);
		$i=1;
		foreach($merge_array as $key=>$values)
		{
			$max = max($merge_array);
			if($max == $score){
				$result_rank = array('score' => $score, 'rank' => $i);
			}
			// echo "\n".$max." rank is ". $i."\n";
			$keys = array_search($max, $merge_array);    
			unset($merge_array[$keys]);
			if(sizeof($merge_array) >0)
			if(!in_array($max,$merge_array))
				$i++;
				$count_array[] = $i;
		}
		$from_total = count($count_array);
		return $result_rank['rank'].'/'.$from_total;;
	}

	function getRankingArray($score){
		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);
		$rank = $db->select('score')->from('mst_rank')->order_by('score', 'DESC')->get()->result_array();
		foreach($rank as $row_rank){
			$valueRank[] = $row_rank['score'];
		}
		$arr_score = array($score);
		$merge_array = array_merge($valueRank, $arr_score);
		$i=1;
		foreach($merge_array as $key=>$values)
		{
			$max = max($merge_array);
			if($max == $score){
				$result_rank = array('score' => $score, 'rank' => $i);
			}
			// echo "\n".$max." rank is ". $i."\n";
			$keys = array_search($max, $merge_array);    
			unset($merge_array[$keys]);
			if(sizeof($merge_array) >0)
			if(!in_array($max,$merge_array))
				$i++;
				$count_array[] = $i;
		}
		$from_total = count($count_array);
		// echo '<pre>';print_r($result_rank);die;
		return array('rank' => $result_rank['rank'], 'total_country' => $from_total);
	}

	public function getColorOfTypeData($data_type){
		switch ($data_type) {
			case 'draft':
				$class = 'kt-badge--warning';
				break;
			
			case 'national':
				$class = 'kt-badge--success';
				break;
				
			case 'international':
				$class = 'kt-badge--primary';
				break;
			
			default:
				# code...
				$class = '-' ;
				break;
		}
		return $class;
	}

	public function getScorePillar($data){

		$CI =&get_instance();
		$db = $CI->load->database('default', TRUE);

		foreach ($data as $key_pillar => $val_pillar) {
			
				$summed_ls[$key_pillar] = [];
				$score_aggregation[$key_pillar] = [];
				$score_general[$key_pillar] = [];
				$score_general_sp[$key_pillar] = [];
				foreach ($val_pillar as $key_ls => $val_ls) {
					# code...
					// print_r($val_ls);die;
					// if ($val_ls['pillar_id'] ==4) {
						if( $val_ls['is_child'] == 'N' ){
							if( $val_ls['is_summed_as_single'] == 'Y' ){
								$summed_ls[$key_pillar][] = $val_ls['score'];
							}
							
							if( $val_ls['parent_subpillar'] > 0 ){
								$score_general_sp[$key_pillar][$val_ls['parent_subpillar']][] = $val_ls['score'];
							}else{
								if( $val_ls['is_summed_as_single'] == 'N' ){
									if( $val_ls['is_aggregation'] == 'Y' ){
										$score_aggregation[$key_pillar][] = $val_ls['score'];
									}
			
									if( $val_ls['is_aggregation'] == 'N' ){
										$score_general[$key_pillar][] = $val_ls['score'];
									}
								}
							}
							
						}
					// }
				}

				// width parent subpillar
				$avg_gsp = [];
				if(count($score_general_sp[$key_pillar]) > 0){
					foreach ($score_general_sp[$key_pillar] as $k_gsp => $v_gsp) {
						$avg_gsp[] = array_sum($v_gsp)/count($v_gsp);
					}
					$count_avg_gsp = (count($avg_gsp) > 0) ? count($avg_gsp)  : 0;
					$sum_avg_gsp = (count($avg_gsp) > 0) ? array_sum($avg_gsp)  : 0;
					$average_score = $sum_avg_gsp / $count_avg_gsp;
				}else{
					
					// average aggreagation
					$avg_aggregation = (count($score_aggregation[$key_pillar]) > 0) ? (array_sum($score_aggregation[$key_pillar]) / count($score_aggregation[$key_pillar])) : 0;

					// summed as single 
					$sum_single = (count($summed_ls[$key_pillar]) > 0) ? array_sum($summed_ls[$key_pillar]) : 0;

					// sum all score
					$sum_score_global = $avg_aggregation + array_sum($score_general[$key_pillar]) + $sum_single;

					$is_empty_sum = (count($summed_ls[$key_pillar]) > 0) ? 1 : 0 ;
					$is_empty_score_aggregation = (count($score_aggregation[$key_pillar]) > 0) ? 1 : 0 ;

					$count_global = count($score_general[$key_pillar]) + $is_empty_sum + $is_empty_score_aggregation ;
					$average_score = $sum_score_global / $count_global;
				}

				$getScorePillar[$key_pillar] = round($average_score, 2);
				$getScoreIndex[$val_pillar[0]['index_desc']][] = $getScorePillar[$key_pillar];
			
			
			// echo '<pre>';print_r($avg_gsp);
			// echo '<pre>';print_r($count_global);
			// echo '<pre>';print_r($score_aggregation);
			// echo '<pre>';print_r($score_general);
			// // echo '<pre>';print_r($score_general_sp);
			// echo '<pre>';print_r($average_score);
			// echo '<pre>';print_r($summed_ls);
			// die;
			
		}
		// echo '<pre>';print_r($getScoreIndex);die;
		
		return array('pillar' => $getScorePillar, 'index' => $getScoreIndex);
		
		
	}

	public function getScoreRank($data){
		foreach ($data as $key => $value) {
			$getData[$key] = array_sum($value) / count($value);
		}
		// echo '<pre>';print_r($getData);die;
		return $getData;
	}
	
}

?> 
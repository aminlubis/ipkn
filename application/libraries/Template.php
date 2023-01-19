<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{

    private $_CI;

    public function __construct()
    {
        $this->_CI =& get_instance();
        //$this->_CI->load->library("firephp");
    }
    public function load( $data = null, $template_name = null, $body_view = null, $module_name = null )
    {
        $caller = debug_backtrace();

        if ( is_null($module_name) )
        {
            $module_name = ucfirst($caller[1]['class']);
        }

        if ( ! is_null( $body_view ) )
        {
            $body_view_path = ucfirst($module_name).'/'.strtolower($body_view).'_view';
        }
        else
        {
            $body_view_path = ucfirst($module_name).'/'.strtolower($module_name).'_view';
        }

        //print_r($body_view_path);die;
        // Load the view as a string for passing to the template module
        $body = $this->_CI->load->view($body_view_path, $data, TRUE);

        // Put the body content into the $data array/object as is appropriate
        if ( is_null($data) )
        {
            $data = array('body' => $body);
        }
        else if ( is_array($data) )
        {
            $data['body'] = $body;
        }
        else if ( is_object($data) )
        {
            $data->body = $body;
        }
        // Load template view files with the module view data
        $this->_CI->load->module('Templates');
        /*$this->_CI->load->model('templates/templates_model');*/
        
        $this->_CI->templates->index($data, strtolower($template_name));

    } // end load function

    function show_status_payment( $params ){

        if( $params->payment_status == '0' ){
            $status = '<label class="label label-warning">Dalam proses</label>' ;
        }elseif( $params->payment_status == '1' ){
            $status = '<label class="label label-success">Request terbaru</label>';
        }elseif( $params->payment_status == '2' ){
            $status = '<label class="label label-info">Request diterima</label>';
        }elseif( $params->payment_status == '3' ){
            $status = '<label class="label label-danger">Dibatalkan</label>' ;
        }elseif( $params->payment_status == '4' ){
            $status = '<label class="label label-info"><a href="'.PATH_MBR_IMG.''.$params->attachment.'" target="_blank" style="color: white !important; text-decoration: none">Sudah Dibayar</a></label><br>Sudah dibayarkan pada '.$this->_CI->tanggal->formatDateTime($params->updated_date).'' ;
        }

        return $status;
    }

    function color_parameter( $value ){

        $color = '';
        if( $value >= 0 && $value < 1 ){
            $color = '#e13306'; // merah
        }

        if( $value >= 1 && $value < 2 ){
            $color = '#e13306bd';
        }

        if( $value >= 2 && $value < 3 ){
            $color = '#e133065e';
        }

        if( $value >= 3 && $value < 4 ){
            $color = '#0692e16b';
        }

        if( $value >= 4 && $value < 5 ){
            $color = '#0692e1b3';
        }

        if( $value >= 5 && $value < 6 ){
            $color = '#0692e1e3';
        }

        if( $value >= 6 && $value < 7 ){
            $color = '#036ba6';
        }

        if( $value >= 7 && $value < 8 ){
            $color = '#035583';
        }

        if( $value >= 8 && $value < 9 ){
            $color = '#0c9d056b';
        }

        if( $value >= 9 && $value < 10 ){
            $color = '#0c9d0596';
        }

        if( $value >= 10 && $value < 11 ){
            $color = '#0c9d05bd';
        }

        if( $value == 11 ){
            $color = '#0c9d05e0';
        }
        if( $value > 11 ){
            $color = '#107c0b';
        }

        return $color;

    }
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */

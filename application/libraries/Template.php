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
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */

<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class DTemplate {
 
		function show($view, $data=array()){

 			$CI = & get_instance();
			$CI->load->view('dtemplate/header',$data);
			$CI->load->view($view, $data);
			$CI->load->view('dtemplate/footer',$data);
			$CI->load->view('dtemplate/scripts',$data);
			
		}
}
 

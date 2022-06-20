<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		
		$this->load->view('welcome_message');
		foreach($this->connection->query("SELECT * FROM pao") as $linha){
		
				//var_dump($this -> lang -> line('title'));
				echo'<hr>';

				}
                                
	}
}

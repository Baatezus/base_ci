<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$this->load->view('components/header');
		$this->load->view('home');
                $this->load->view('components/endpage');
	}
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Learning extends CI_Controller
{
	public function index()
	{
		$this->load->view('learning.vue');
	}
	public function showVerbs()
	{
		$verbs =  $this->getVerbsFromDB();
		$data = [
			'verbs' => $verbs
		];
		echo json_encode($data);
	}
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Verbs extends CI_Controller
{
    public function index()
    {
        $this->load->view('contact.vue');
    }
    public function saveVerbs()
    {
        $this->load->model('Verbs_repository', 'Model');
        $result = $this->Model->saveVerb($_POST['newVerb']);
        $verbs =  $this->getVerbsFromDB();
        $data = [
            'verbs' => $verbs,
            'result' => $result
        ];
        echo json_encode($data);
    }
    private function getVerbsFromDB()
    {
        $this->load->model('Verbs_repository', 'Model');
        return $this->Model->getVerbs();
    }
}

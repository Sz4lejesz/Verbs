<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Verb_list extends CI_Controller
{
    public function index()
    {
        $this->load->view('verb_list.vue');
    }
    public function saveVerbs()
    {
        $this->load->model('Verbs_model', 'Model');
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
        $this->load->model('Verbs_model', 'Model');
        return $this->Model->getVerbs();
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

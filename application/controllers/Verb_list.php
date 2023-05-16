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
        $form = $_POST['newVerb'];
        var_dump($_POST['newVerb']);

        if (
            !(
            $form['verbInPolish'] === '' ||
            $form['verbInInfinitive'] === '' ||
            $form['verbInPastSimple1'] === '' ||
            $form['verbInPastParticiple1'] === ''
            )
        ) {
            $result = $this->Model->saveVerb($_POST['newVerb']);
            $verbs = $result ? $this->getVerbsFromDB() : null;
            $data = [
                'verbs' => $verbs,
                'result' => $result
            ];
            echo json_encode($data);
        }
    }
    private function getVerbsFromDB()
    {
		$verb = new \application\Model\Verb();
        $this->load->model('Verbs_model', 'Model');
		v( $this->Model->getVerbs());
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

<?php

use application\Model\Verb;

defined('BASEPATH') or exit('No direct script access allowed');
class Verb_list extends CI_Controller
{
    public function index()
    {
        $this->load->view('verb_list.vue');
    }
    public function saveVerbs()
    {
        $this->load->model('Repository\VerbsRepository', 'Model');
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
		/** @var $verb Verb */
		$this->load->model('Repository\VerbsRepository', 'Model');
		$result = $this->Model->getVerbs();
		$verbs = [];
		foreach ($result as $verb) {
			$verbs[] = [
				'id' => $verb->getId(),
				'verbInPolish' => $verb->getVerbInPolish(),
				'verbInInfinitive' => $verb->getVerbInInfinitive(),
				'verbInPastSimple1' => $verb->getVerbInPastSimple1(),
				'verbInPastSimple2' => $verb->getVerbInPastSimple2(),
				'verbInPastParticiple1' => $verb->getVerbInPastParticiple1(),
				'verbInPastParticiple2' => $verb->getVerbInPastParticiple2(),
				'additionalDescription' => $verb->getAdditionalDescription()
			];
		}

		return $verbs;
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

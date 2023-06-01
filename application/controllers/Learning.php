<?php

defined('BASEPATH') or exit('No direct script access allowed');
use application\Model\Verb;

class Learning extends CI_Controller
{

	public function index()
	{
		$this->load->view('learning.vue');
	}
	public function drawVerbs()
	{
		$this->load->model('Repository\VerbsRepository', 'Model');
		$max = $this->Model->getMaxId()['max_id'];
		$min = $this->Model->getMinId()['min_id'];
		$randomID = rand($min, $max);
		$verb = $this->Model->getVerbFromDBById($randomID);
		/** @var Verb $verb */
		if ($randomID === $verb->getId()) {
			$verbs = [
				'verbInPolish' => $verb->getVerbInPolish(),
				'verbInInfinitive' => $verb->getVerbInInfinitive(),
				'verbInPastSimple1' => $verb->getVerbInPastSimple1(),
				'verbInPastParticiple1' => $verb->getVerbInPastParticiple1()
			];
		}
		echo json_encode($verbs, JSON_UNESCAPED_UNICODE);
	}
	public function checkTranslation()
	{
		$form = $_POST['verbs'];
		$x = $_POST['x'];
		/** @var Verb $verb */
		$verb = $this->getVerbFromDB($x['main'], $x['choosen']);
		if (
			trim(lcfirst($form['verbInInfinitive'])) === trim(lcfirst($verb->getVerbInInfinitive())) &
			trim(lcfirst($form['verbInPastSimple'])) === trim(lcfirst($verb->getVerbInPastSimple1())) &
			trim(lcfirst($form['verbInPastParticiple'])) === trim(lcfirst($verb->getVerbInPastParticiple1())) &
			trim(lcfirst($form['verbInPolish'])) === trim(lcfirst($verb->getVerbInPolish()))
		) {
			echo 'Wszystko ok!';
		} else {
			echo 'Błąd!';
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
	private function getVerbFromDB($frontTypeOfVerb, $dbTypeOfVerb)
	{
		$this->load->model('Repository\VerbsRepository', 'Model');
		return $this->Model->getVerbFromDB($frontTypeOfVerb, $dbTypeOfVerb);
	}
}

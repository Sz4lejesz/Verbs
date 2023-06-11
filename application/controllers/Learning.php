<?php

defined('BASEPATH') or exit('No direct script access allowed');
use application\Model\Verb;

class Learning extends CI_Controller
{

	public function index()
	{
		$this->load->view('learning.vue');
	}
	public function allVerbs()
	{
		$verbs = $this->getVerbsFromDB();
		$verbsArray = [];
		foreach ($verbs as $verb) {
			$verbsArray[$verb['verbInPolish']] = $verb['verbInPolish'];
		}
		echo json_encode($verbsArray);
	}
	public function drawVerbs()
	{
		var_dump($_POST);

		$verbsIds = $_POST['ids'];




		$this->load->model('Repository\VerbsRepository', 'Model');
		$amountOfVerbs = $this->howManyVerbs();
		$verb = $this->Model->getVerbFromDBByIds($verbsIds);
		/** @var Verb $verb */
		$verbs = [
			'verbInPolish' => $verb->getVerbInPolish(),
			'verbInInfinitive' => $verb->getVerbInInfinitive(),
			'verbInPastSimple1' => $verb->getVerbInPastSimple1(),
			'verbInPastParticiple1' => $verb->getVerbInPastParticiple1(),
			'amountOfVerbs' => $amountOfVerbs,
			'verbId' => $verb->getId()
		];
		echo json_encode($verbs, JSON_UNESCAPED_UNICODE);
	}
	public function checkTranslation()
	{
		$form = $_POST['verbs'];
		$x = $_POST['x'];
		/** @var Verb $verb */
		$verb = $this->getVerbFromDB($x['main'], $x['choosen']);
		//		v(trim(strtoupper($form['verbInInfinitive'])));
//		v(trim(strtoupper($verb->getVerbInInfinitive())));
//		v(trim(strtoupper($form['verbInPastSimple'])));
//		v(trim(strtoupper($verb->getVerbInPastSimple1())));
//		v(trim(strtoupper($form['verbInPastParticiple'])));
//		v(trim(strtoupper($verb->getVerbInPastParticiple1())));
//		v(trim(mb_strtoupper($form['verbInPolish'], 'UTF-8')));
//		v(trim(mb_strtoupper($verb->getVerbInPolish(), 'UTF-8')));
		if (
//			trim(strtoupper($form['verbInInfinitive'])) === trim(strtoupper($verb->getVerbInInfinitive())) &
//			trim(strtoupper($form['verbInPastSimple'])) === trim(strtoupper($verb->getVerbInPastSimple1())) &
//			trim(strtoupper($form['verbInPastParticiple'])) === trim(strtoupper($verb->getVerbInPastParticiple1())) &
			trim(mb_strtoupper($form['verbInPolish'], 'UTF-8')) === trim(mb_strtoupper($verb->getVerbInPolish(), 'UTF-8'))
		) {
			$data = [
				'communicate' => 'Wszystko ok!'
			];
		} else {
			$data = [
				'communicate' => 'Błąd!'
			];
		}
		echo json_encode($data);
	}
	private function howManyVerbs()
	{
		$result = $this->getVerbsFromDB();
		$i = 0;
		foreach ($result as $row) {
			$i++;
		}
		return $i;
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

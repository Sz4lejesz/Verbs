<?php
namespace Repository;
use application\Model\Verb;

class VerbsRepository extends \CI_Model
{
	public function saveVerb($form)
	{
		$params = [];
		$params[] = $form['verbInPolish'];
		$params[] = $form['verbInInfinitive'];
		$params[] = $form['verbInPastSimple1'];
		$params[] = $form['verbInPastSimple2'];
		$params[] = $form['verbInPastParticiple1'];
		$params[] = $form['verbInPastParticiple2'];
		$params[] = $form['additionalDescription'];
		$query = "INSERT INTO `verbs`(`verbInPolish`, `verbInInfinitive`, `verbInPastSimple1`, `verbInPastSimple2`,
      	 `verbInPastParticiple1`, `verbInPastParticiple2`, `additionalDescription`) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$addVerb = $this->db->query($query, $params);
		return $addVerb;
	}

	/**
	 * @return Verb[]
	 */
	public function getVerbs(): array
	{
		$query = "SELECT * FROM `verbs`";
		$getVerbs = $this->db->query($query);
		$result = $getVerbs->result_array();
		$data = [];
		foreach ($result as $row) {
			$verb = new Verb();
			$data[] = $verb
				->setId($row['id'])
				->setVerbInPolish($row['verbInPolish'])
				->setVerbInInfinitive($row['verbInInfinitive'])
				->setVerbInPastSimple1($row['verbInPastSimple1'])
				->setVerbInPastSimple2($row['verbInPastSimple2'])
				->setVerbInPastParticiple1($row['verbInPastParticiple1'])
				->setVerbInPastParticiple2($row['verbInPastParticiple2'])
				->setAdditionalDescription($row['additionalDescription']);

		}
		return $data;
	}
}

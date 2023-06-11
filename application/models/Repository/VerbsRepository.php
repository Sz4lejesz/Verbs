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
	public function getVerbFromDBByIds(array $ids)
	{
		$query = "SELECT * FROM `verbs` WHERE id NOT IN ?";
		$result = $this->db->query($query, [$ids])->result_array();
		$verb = new Verb();
		$verb
			->setId($result[0]['id'])
			->setVerbInPolish($result[0]['verbInPolish'])
			->setVerbInInfinitive($result[0]['verbInInfinitive'])
			->setVerbInPastSimple1($result[0]['verbInPastSimple1'])
			->setVerbInPastSimple2($result[0]['verbInPastSimple2'])
			->setVerbInPastParticiple1($result[0]['verbInPastParticiple1'])
			->setVerbInPastParticiple2($result[0]['verbInPastParticiple2'])
			->setAdditionalDescription($result[0]['additionalDescription']);
		return $verb;
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
	public function getVerbFromDB($viewVerb, $dbVerb)
	{
		$query = "SELECT * FROM verbs WHERE $dbVerb = ?";
		$result = $this->db->query($query, array($viewVerb))->result_array();
		$verb = new Verb();
		$verb
			->setId($result[0]['id'])
			->setVerbInInfinitive($result[0]['verbInInfinitive'])
			->setVerbInPastSimple2($result[0]['verbInPastSimple2'])
			->setVerbInPastParticiple2($result[0]['verbInPastParticiple2'])
			->setAdditionalDescription($result[0]['additionalDescription'])
			->setVerbInPolish($result[0]['verbInPolish'])
			->setVerbInPastParticiple1($result[0]['verbInPastParticiple1'])
			->setVerbInPastSimple1($result[0]['verbInPastSimple1']);


		return $verb;
	}
}

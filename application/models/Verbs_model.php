<?php

use application\Model\Verb;

class Verbs_model extends \CI_Model
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
    public function getVerbs()
    {
        $query = "SELECT * FROM `verbs`";
        $getVerbs = $this->db->query($query);
        $result = $getVerbs->result_array();
        foreach ($result as $row) {
            $verb = new Verb();
			v($verb);
            v($row['date']);
        }
        return $result;
    }
}

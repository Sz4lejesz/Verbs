<?php

namespace application\Model;

class Verb
{
    private int $id;
    private string $verbInPolish;
    private string $verbInInfinitive;
    private string $verbInPastSimple1;
    private string $verbInPastSimple2;
    private string $verbInPastParticiple1;
    private string $verbInPastParticiple2;
    private string $additionalDescription;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Verb
	 */
	public function setId(int $id): Verb
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVerbInPolish(): string
	{
		return $this->verbInPolish;
	}

	/**
	 * @param string $verbInPolish
	 * @return Verb
	 */
	public function setVerbInPolish(string $verbInPolish): Verb
	{
		$this->verbInPolish = $verbInPolish;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVerbInInfinitive(): string
	{
		return $this->verbInInfinitive;
	}

	/**
	 * @param string $verbInInfinitive
	 * @return Verb
	 */
	public function setVerbInInfinitive(string $verbInInfinitive): Verb
	{
		$this->verbInInfinitive = $verbInInfinitive;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVerbInPastSimple1(): string
	{
		return $this->verbInPastSimple1;
	}

	/**
	 * @param string $verbInPastSimple1
	 * @return Verb
	 */
	public function setVerbInPastSimple1(string $verbInPastSimple1): Verb
	{
		$this->verbInPastSimple1 = $verbInPastSimple1;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVerbInPastSimple2(): string
	{
		return $this->verbInPastSimple2;
	}

	/**
	 * @param string $verbInPastSimple2
	 * @return Verb
	 */
	public function setVerbInPastSimple2(string $verbInPastSimple2): Verb
	{
		$this->verbInPastSimple2 = $verbInPastSimple2;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVerbInPastParticiple1(): string
	{
		return $this->verbInPastParticiple1;
	}

	/**
	 * @param string $verbInPastParticiple1
	 * @return Verb
	 */
	public function setVerbInPastParticiple1(string $verbInPastParticiple1): Verb
	{
		$this->verbInPastParticiple1 = $verbInPastParticiple1;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVerbInPastParticiple2(): string
	{
		return $this->verbInPastParticiple2;
	}

	/**
	 * @param string $verbInPastParticiple2
	 * @return Verb
	 */
	public function setVerbInPastParticiple2(string $verbInPastParticiple2): Verb
	{
		$this->verbInPastParticiple2 = $verbInPastParticiple2;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAdditionalDescription(): string
	{
		return $this->additionalDescription;
	}

	/**
	 * @param string $additionalDescription
	 * @return Verb
	 */
	public function setAdditionalDescription(string $additionalDescription): Verb
	{
		$this->additionalDescription = $additionalDescription;
		return $this;
	}


}

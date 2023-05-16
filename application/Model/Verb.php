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
    private \DateTime $date;
}

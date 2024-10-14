<?php

class actors extends connection
{
    private $tableName = "actors";
    public function __construct() {
        parent::__construct($this->tableName);
    }
    public function getActorNames() {
        $assArr = connection::queryStatement("SELECT `filmindustryprofessional`.`lastname`, `filmindustryprofessional`.`firstname` FROM `filmindustryprofessional` JOIN actors ON actors.filmIndustryProfessional_id = filmindustryprofessional.id JOIN offers ON offers.id = actors.offers_id GROUP BY `lastname`, `firstname`;");
        $arr = [];
        foreach($assArr as $ele) {
            $arr[] = $ele['lastname'] . str_repeat('&nbsp;', 2) . $ele['firstname'];
        }
        return $arr;
    }
}
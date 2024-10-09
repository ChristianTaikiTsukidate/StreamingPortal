<?php

class actors extends connection
{
    private $tableName = "actors";
    public function __construct() {
        parent::__construct($this->tableName);
    }
    public function getActorNames() {
        return connection::getArrOfSingleAttribute("SELECT CONCAT(`filmindustryprofessional`.`lastname`, ' ', `filmindustryprofessional`.`firstname`) AS `name` FROM `filmindustryprofessional` JOIN actors ON actors.filmIndustryProfessional_id = filmindustryprofessional.id JOIN offers ON offers.id = actors.offers_id GROUP BY `name`;", 'name');
    }
}
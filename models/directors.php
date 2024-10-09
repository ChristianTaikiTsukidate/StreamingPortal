<?php

class directors extends connection
{
    private $tableName = "directors";
    public function __construct() {
        parent::__construct($this->tableName);
    }
    public function getDirectorNames() {
        return connection::getArrOfSingleAttribute("SELECT CONCAT(`filmindustryprofessional`.`lastname`, ' ', `filmindustryprofessional`.`firstname`) AS `name` FROM `filmindustryprofessional` JOIN directors ON directors.filmIndustryProfessional_id = filmindustryprofessional.id JOIN offers ON offers.id = directors.offers_id GROUP BY `name`;", 'name');
    }
}
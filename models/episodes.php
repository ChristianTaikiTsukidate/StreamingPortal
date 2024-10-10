<?php

class episodes extends connection
{
    private $tableName = "episodes";

    public function __construct()
    {
        parent::__construct($this->tableName);
    }
    public function insertEpsisodeWithSeasonId() {
        $params = [$_POST["Number"], $_POST["Name"], $_POST["Duration"], $_POST["Release_Year"], $_POST["seasonsId"]];
        connection::prepareStmt("INSERT INTO `episodes`(`number`, `name`, `duration`, `releaseYear`, `seasons_id`) VALUES (?,?,?,?,?)", $params);
    }

    public function getEpisodeNumbers($seasonId) {
        $params = [$seasonId];
        $results = connection::prepareStmt("SELECT count(*) as count FROM `episodes` WHERE `seasons_id`=?", $params);
        return $results[0]['count'];
    }

    public function getLatestEpisode($seasonId) {
        $params = [$seasonId];
        $results = connection::prepareStmt("
SELECT * 
FROM `episodes` 
WHERE `seasons_id` = ? 
ORDER BY `number` DESC 
LIMIT 1;
", $params);
        if (!empty($results)) {
            return $results[0];  // Return the first result if exists
        } else {
            return null;  // Return null if no result is found
        }
    }
}
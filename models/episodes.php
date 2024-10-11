<?php

class episodes extends connection
{
    private $tableName = "episodes";

    public function __construct()
    {
        parent::__construct($this->tableName);
    }
    public function insertEpsisodeWithSeasonId() {
        $params = [$_POST["episodenumber"], $_POST["Name"], $_POST["Duration"], $_POST["Release_Year"], $_POST["seasonId"]];
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

    public function getLatestId() {
        $results = connection::queryStatement("
SELECT * 
FROM `episodes`
ORDER BY `id` DESC 
LIMIT 1;
");
        if (!empty($results)) {
            return $results[0]['id'];  // Return the first result if exists
        } else {
            return null;  // Return null if no result is found
        }
    }
    public function getEpisodesBySeasonId($id) {
    $params = [$id];
    return connection::prepareStmt("SELECT `id`, `number`, `name`, `duration`, `releaseYear`, `seasons_id` FROM `episodes` WHERE `seasons_id` = ?;", $params);
}
    public function getEpisodesById($id) {
        $params = [$id];
        return connection::prepareStmt("SELECT `id`, `number`, `name`, `duration`, `releaseYear`, `seasons_id` FROM `episodes` WHERE `id` = ?;", $params);
    }
}
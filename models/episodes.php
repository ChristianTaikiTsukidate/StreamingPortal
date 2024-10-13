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
        $lastInsertId = connection::$pdo->lastInsertId();
        return $lastInsertId;
    }

    public function getEpisodeNumbers($seasonId) {
        $params = [$seasonId];
        $results = connection::prepareStmt("SELECT count(*) as count FROM `episodes` WHERE `seasons_id`=?", $params);
        return $results[0]['count'];
    }

    public function getLatestEpisode($id) {
        $params = [$id];
        return connection::prepareStmt("
SELECT 
    `offers`.`id` AS `offerId`, 
    `offers`.`title`, 
    `offers`.`trailer`, 
    `offers`.`fsk`, 
    `offers`.`posterLink`, 
    `offers`.`originalTitle`, 
    `offers`.`rating`, 
    `offers`.`description`,
    `episodes`.`releaseYear` AS `releaseYear`, 
    `episodes`.`duration` AS `duration`, 
    `genres`.`name` AS `genre`,
    `seasons`.`number` AS `seasonNumber`,
    `seasons`.`id` AS `seasonId`,
    `episodes`.`number` AS `episodeNumber`,
    `episodes`.`name` AS `name`
FROM 
    `offers`
JOIN 
    `seasons` ON `offers`.`id` = `seasons`.`offers_id`
JOIN 
    `episodes` ON `seasons`.`id` = `episodes`.`seasons_id`
JOIN
    `offersHasGenres` ON `offers`.`id` = `offersHasGenres`.`offers_id`
JOIN
    `genres` ON `offersHasGenres`.`genres_id` = `genres`.`id`
WHERE
    `seasons`.`id` = ?
GROUP BY
`episodes`.`id`;
", $params)[0] ?? "";
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
    return connection::prepareStmt("SELECT 
    `offers`.`id` AS `offerId`, 
    `offers`.`title`, 
    `offers`.`trailer`, 
    `offers`.`fsk`, 
    `offers`.`posterLink`, 
    `offers`.`originalTitle`, 
    `offers`.`rating`, 
    `offers`.`description`,
    `episodes`.`releaseYear` AS `releaseYear`, 
    `episodes`.`duration` AS `duration`, 
    `genres`.`name` AS `genre`,
    `seasons`.`number` AS `seasonNumber`,
    `seasons`.`id` AS `seasonId`,
    `episodes`.`number` AS `episodeNumber`,
    `episodes`.`name` AS `name`,
    `episodes`.`id` AS `episodeId`
FROM 
    `offers`
JOIN 
    `seasons` ON `offers`.`id` = `seasons`.`offers_id`
JOIN 
    `episodes` ON `seasons`.`id` = `episodes`.`seasons_id`
JOIN
    `offersHasGenres` ON `offers`.`id` = `offersHasGenres`.`offers_id`
JOIN
    `genres` ON `offersHasGenres`.`genres_id` = `genres`.`id`
WHERE
    `seasons`.`id` = ?
GROUP BY
`episodes`.`id`;", $params);
}
    public function getEpisodeById($id) {
        $params = [$id];
        return connection::prepareStmt("SELECT 
    `offers`.`id` AS `offerId`, 
    `offers`.`title`, 
    `offers`.`trailer`, 
    `offers`.`fsk`, 
    `offers`.`posterLink`, 
    `offers`.`originalTitle`, 
    `offers`.`rating`, 
    `offers`.`description`,
    `episodes`.`releaseYear` AS `releaseYear`, 
    `episodes`.`duration` AS `duration`, 
    `genres`.`name` AS `genre`,
    `seasons`.`number` AS `seasonNumber`,
    `seasons`.`id` AS `seasonId`,
    `episodes`.`number` AS `episodeNumber`,
    `episodes`.`name` AS `name`,
    `episodes`.`id` AS `episodeId`
FROM 
    `offers`
JOIN 
    `seasons` ON `offers`.`id` = `seasons`.`offers_id`
JOIN 
    `episodes` ON `seasons`.`id` = `episodes`.`seasons_id`
JOIN
    `offersHasGenres` ON `offers`.`id` = `offersHasGenres`.`offers_id`
JOIN
    `genres` ON `offersHasGenres`.`genres_id` = `genres`.`id`
WHERE
    `episodes`.`id` = ?
GROUP BY
`episodes`.`id`;", $params)[0];
    }
    function deleteEpisodeById($id)
    {
        $params = [$id];
        connection::prepareStmt("DELETE FROM `episodes` WHERE `id`=?;", $params);
    }

    function updateEpisodeById($id)
    {
        $params = [$_POST['Name'], $_POST['Duration'], $_POST['Release_Year'], $id];
        connection::prepareStmt("UPDATE `episodes` SET `name`=?,`duration`=?,`releaseYear`=? WHERE `id` = ?;", $params);

    }
}
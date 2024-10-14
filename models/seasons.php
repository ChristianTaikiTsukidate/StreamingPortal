<?php

class seasons extends connection
{
    private $tableName = "seasons";
    public function __construct() {
        parent::__construct($this->tableName);
    }
    public function insertSeasonWithOffersId($id) {
        $params = [$id];
        connection::prepareStmt("INSERT INTO `seasons`(`number`, `offers_id`) VALUES (1, ?)", $params);
        return connection::$pdo->lastInsertId();
    }
    public function insertSeasonWithOffersIdAndNumber($number, $id) {
        $params = [$number, $id];
        connection::prepareStmt("INSERT INTO `seasons`(`number`, `offers_id`) VALUES (?, ?)", $params);
        return connection::$pdo->lastInsertId();
    }
    public function getSeasonsByOffersId($id) {
        $params = [$id];
        return connection::prepareStmt("SELECT `id`, `number`, `offers_id` FROM `seasons` WHERE `offers_id` = ?;", $params);
    }
    public function getLatestSeasonByOffersId($id) {
        $params = [$id];
        return connection::prepareStmt("SELECT `id`, `number`, `offers_id` FROM `seasons` WHERE `offers_id` = ? ORDER BY `number` DESC LIMIT 1;", $params)[0];
    }
    public function getSeasonById($id) {
        $params = [$id];
        return connection::prepareStmt("
SELECT 
    `offers`.`id` AS `id`, 
    `offers`.`title`, 
    `offers`.`trailer`, 
    `offers`.`fsk`, 
    `offers`.`posterLink`, 
    `offers`.`originalTitle`, 
    `offers`.`rating`, 
    `offers`.`description`,
    IF(MIN(`episodes`.`releaseYear`) = MAX(`episodes`.`releaseYear`), 
        MIN(`episodes`.`releaseYear`), 
        CONCAT(MIN(`episodes`.`releaseYear`), ' - ', MAX(`episodes`.`releaseYear`))
    ) AS `releaseYear`, 
    SUM(`episodes`.`duration`) AS `duration`,
    `genres`.`name` AS `genre`,
    `seasons`.`number` AS `number`,
    `seasons`.`id` AS `seasonId`
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
GROUP BY 
    `seasons`.`id`
HAVING 
    `seasons`.`id` = ?;
", $params)[0];
    }
    public function deleteSeasonById($id) {
        $params = [$id];
        connection::prepareStmt("DELETE FROM `seasons` WHERE `id`=?;", $params);
    }
    public function getSeasonsByOffersIdFullInfo($id) {
        $params = [$id];
        return connection::prepareStmt("SELECT 
    `offers`.`id` AS `id`, 
    `offers`.`title`, 
    `offers`.`trailer`, 
    `offers`.`fsk`, 
    `offers`.`posterLink`, 
    `offers`.`originalTitle`, 
    `offers`.`rating`, 
    `offers`.`description`,
    IF(MIN(`episodes`.`releaseYear`) = MAX(`episodes`.`releaseYear`), 
        MIN(`episodes`.`releaseYear`), 
        CONCAT(MIN(`episodes`.`releaseYear`), ' - ', MAX(`episodes`.`releaseYear`))
    ) AS `releaseYear`, 
    SUM(`episodes`.`duration`) AS `duration`,
    `genres`.`name` AS `genre`,
    `seasons`.`number` AS `number`,
    `seasons`.`id` AS `seasonId`
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
GROUP BY 
    `offers`.`id`, `seasons`.`id`  -- Ensure grouping by both offer and season
HAVING 
    `offers`.`id` = ?;", $params);
    }
}
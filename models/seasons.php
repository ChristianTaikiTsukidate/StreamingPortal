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
    public function insertSeasonWithOffersIdAndNumber($id, $number) {
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
        return connection::prepareStmt("SELECT `id`, `number`, `offers_id` FROM `seasons` WHERE `id` = ?;", $params);
    }
    public function deleteSeasonById($id) {
        $params = [$id];
        return connection::prepareStmt("DELETE FROM `seasons` WHERE `id`=?;", $params);
    }

    public function getSeasonsCountByOffersId($id) {
        $params = [$id];
        return connection::prepareStmt("SELECT count(*) as count FROM `seasons` WHERE `offers_id` = ?;", $params)[0]["count"];
}
}
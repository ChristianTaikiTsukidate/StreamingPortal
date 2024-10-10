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

    public function getSeasonsByOffersId($id) {
        $params = [$id];
        return connection::prepareStmt("SELECT `id`, `number`, `offers_id` FROM `seasons` WHERE `offers_id` = ?;", $params);
    }
}
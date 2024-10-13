<?php

class offers extends connection
{
    private $tableName;
    public function __construct($tableName)
    {
        parent::__construct($tableName);
    }
    public function getReleaseYear()
    {
        return connection::getArrOfSingleAttribute("SELECT `movies`.`releaseYear` FROM `movies` UNION DISTINCT SELECT `episodes`.`releaseYear` FROM `episodes`ORDER BY `releaseYear` DESC;", "releaseYear");
    }

    public function getRatings()
    {
        $ratings = [1,2,3,4,5,6,7,8,9,10];
        return $ratings;
    }

    public function updateById($id) {
        $params = [$_POST["Title"], $_POST["Trailer"], $_POST["FSK"], $_POST["Poster_Link"], $_POST["Original_Title"], $_POST["Rating"], $_POST["Description"], $id];
        connection::prepareStmt("UPDATE `offers` SET `title`=?,`trailer`=?,`fsk`=?,`posterLink`=?,`originalTitle`=?,`rating`=?,`description`=? WHERE `id`=?;", $params);
    }
    public function deleteOfferById($id) {
        $params = [$id];
        connection::prepareStmt("DELETE FROM `offers` WHERE `id` = ?;", $params);
    }

    public function insertGetId() {
        $params = [$_POST["Title"], $_POST["Trailer"], $_POST["FSK"], $_POST["Poster_Link"], $_POST["Original_Title"], $_POST["Rating"], $_POST["Description"]];
        connection::prepareStmt("
INSERT INTO `offers`(`title`, `trailer`, `fsk`, `posterLink`, `originalTitle`, `rating`, `description`)
VALUES (?, ?, ?, ?, ?, ?, ?)", $params);
        $lastInsertId = connection::$pdo->lastInsertId();
        return $lastInsertId;
    }
}
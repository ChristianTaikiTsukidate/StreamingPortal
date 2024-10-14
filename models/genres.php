<?php

class genres extends connection
{
    private $tableName = 'genres';
    public function __construct() {
        parent::__construct($this->tableName);
    }
    public function getGenres() {
        return connection::getArrOfSingleAttribute("SELECT * FROM `genres`", "name");
    }

    public function getGenreByOffersId($id) {
        $params = [];
        $params[] = $id;
        $assArr = connection::prepareStmt("
SELECT 
    `genres`.`name` AS `genre`
FROM 
    `genres`
JOIN 
    `offershasgenres` 
ON 
    `genres`.`id` = `offersHasGenres`.`genres_id`
JOIN
`offers`
ON
`offers`.`id` = `offersHasGenres`.`offers_id`
WHERE `offers`.`id`=?;
", $params);
        return connection::convertAssArrToArr($assArr, 'genre');
    }
    public function updateOffersHasGenresById($id) {
        $paramsDelete = [$id];
        connection::prepareStmt("DELETE FROM `offershasgenres` WHERE `offers_id` = ?", $paramsDelete);
        foreach ($_POST["Genres"] as $genre) {
            $genreId = connection::prepareStmt("SELECT `id` FROM `genres` WHERE `name` = ?", [$genre])[0]['id'];
            $paramsInsert = [$id, $genreId];
            connection::prepareStmt("INSERT INTO `offershasgenres`(`offers_id`, `genres_id`) VALUES (?,?)", $paramsInsert);
        }
    }
    public function insertOffersHasGenresById($id) {
        foreach ($_POST["Genres"] as $genre) {
            $genreId = connection::prepareStmt("SELECT `id` FROM `genres` WHERE `name` = ?", [$genre])[0]['id'];
            $paramsInsert = [$id, $genreId];
            connection::prepareStmt("INSERT INTO `offershasgenres`(`offers_id`, `genres_id`) VALUES (?,?)", $paramsInsert);
        }
    }
}
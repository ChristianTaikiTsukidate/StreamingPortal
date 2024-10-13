<?php

class series extends offers
{
    private $tableName = "series";

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function getRecords()
    {
        return connection::queryStatement("SELECT `offers`.`id`, `offers`.`title`, `offers`.`trailer`, `offers`.`fsk`, `offers`.`posterLink`, `offers`.`originalTitle`, `offers`.`rating`, `offers`.`description`, IF(MIN(`episodes`.`releaseYear`) = MAX(`episodes`.`releaseYear`), 
        MIN(`episodes`.`releaseYear`), 
        CONCAT(MIN(`episodes`.`releaseYear`), ' - ', MAX(`episodes`.`releaseYear`))
    ) AS `releaseYear`, SUM(`episodes`.`duration`) AS `duration` FROM `offers` JOIN `seasons` ON `offers`.`id` = `seasons`.`offers_id` JOIN `episodes` ON `seasons`.`id` = `episodes`.`seasons_id` GROUP BY `offers`.`id`; ");
    }
    public function getRecordById($id)
    {
        $params = [];
        $params[] = $id;
        return connection::prepareStmt(
"SELECT 
    `offers`.`id`, 
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
    `genres`.`name` AS `genre`
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
    `offers`.`id`
HAVING 
    `offers`.`id` = ?;
", $params);
    }
    public function getFilteredRecords($assArr)
    {
        $params = [];
        $whereConditionString = "";
        foreach($assArr['genresfilter'] as $value) {
            $whereConditionString = $whereConditionString . " AND `genres`.`name` = ? ";
            $params[] = $value;
        }
        foreach($assArr['ratingsfilter'] as $value) {
            $whereConditionString = $whereConditionString . " AND `offers`.`rating` <= ? ";
            $params[] = $value;
        }
        foreach($assArr['streamingservicefilter'] as $value) {
            $whereConditionString = $whereConditionString . " AND `providers`.`name` = ? ";
            $params[] = $value;
        }
        foreach($assArr['actorsfilter'] as $value) {
            $whereConditionString = $whereConditionString . " AND `actor_fip`.`lastname` = ? AND `actor_fip`.`firstname` = ?";
            $params = array_merge($params, explode(" ", $value)) ;
        }
        foreach($assArr['directorsfilter'] as $value) {
            $whereConditionString = $whereConditionString . " AND `director_fip`.`lastname` = ? AND `director_fip`.`firstname` = ?";
            $params = array_merge($params, explode(" ", $value)) ;
        }
        $havingConditionString = "";
        if(count($assArr['releaseyearfilter']) == 1) {
            $whereConditionString = $whereConditionString . " AND `episodes`.`releaseYear` = ?";
            $params[] = $assArr['releaseyearfilter'][0];
        }
        if(count($assArr['releaseyearfilter']) == 2) {
            $havingConditionString = $havingConditionString . " HAVING MIN(`episodes`.`releaseYear`) = ? OR MAX(`episodes`.`releaseYear`) = ?";
            $params[] = $assArr['releaseyearfilter'][0];
            $params[] = $assArr['releaseyearfilter'][1];
        }
        return connection::prepareStmt("
SELECT
    `offers`.`id`,
    `offers`.`title`,
    `offers`.`trailer`,
    `offers`.`fsk`,
    `offers`.`posterLink`,
    `offers`.`originalTitle`,
    `offers`.`rating`,
    `offers`.`description`,
    CONCAT(MIN(`episodes`.`releaseYear`), ' - ', MAX(`episodes`.`releaseYear`)) AS `releaseYear`,
    SUM(`episodes`.`duration`) AS `duration`
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
LEFT JOIN
    `actors` ON `offers`.`id` = `actors`.`offers_id`
LEFT JOIN
    `directors` ON `offers`.`id` = `directors`.`offers_id`
LEFT JOIN
    `filmIndustryProfessional` AS `actor_fip` ON `actors`.`filmIndustryProfessional_id` = `actor_fip`.`id`
LEFT JOIN
    `filmIndustryProfessional` AS `director_fip` ON `directors`.`filmIndustryProfessional_id` = `director_fip`.`id`
JOIN
    `offershasproviders` ON `offershasproviders`.`offers_id` = `offers`.`id`
JOIN
    `providers` ON `providers`.`id` = `offershasproviders`.`provider_id`
WHERE
    1 = 1
    $whereConditionString        -- Additional dynamic WHERE conditions
GROUP BY
    `offers`.`id`
$havingConditionString;         -- Additional dynamic HAVING conditions

", $params);
    }
}
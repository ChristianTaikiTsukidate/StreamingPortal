<?php

class providers extends connection
{
    private $tableName = "providers";

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function getProviderNames()
    {
        return connection::getArrOfSingleAttribute("SELECT * FROM providers ORDER BY name ASC", "name");
    }

    public function getProvidersByOffersId($id)
    {
        $params = [];
        $params[] = $id;
        return connection::prepareStmt("
SELECT `providers`.`name` AS `provider`, `providers`.`logo` AS `logo` FROM `providers` JOIN 
    `offershasproviders` 
ON 
    `providers`.`id` = `offershasproviders`.`provider_id`
JOIN
`offers`
ON
`offers`.`id` = `offershasproviders`.`offers_id`
WHERE `offers`.`id`=?;
", $params);
    }

    public function getProvidersFullByOffersId($id)
    {
        $params = [];
        $params[] = $id;
        return connection::prepareStmt("
SELECT `providers`.`name` AS `provider`, `providers`.`affiliateLink`, `providers`.`logo` FROM `providers` JOIN 
    `offershasproviders` 
ON 
    `providers`.`id` = `offershasproviders`.`provider_id`
JOIN
`offers`
ON
`offers`.`id` = `offershasproviders`.`offers_id`
WHERE `offers`.`id`=?;
", $params);
    }

    public function updateById($id)
    {
        $params = [$_POST["Genre"], $id];
        connection::prepareStmt("UPDATE `providers` SET ,`name`=?,`affiliateLink`=?,`logo`=? WHERE `id`=?;", $params);
    }

    public function updateOffersHasProvidersById($id) {
        $paramsDelete = [$id];
        connection::prepareStmt("DELETE FROM `offershasproviders` WHERE `offers_id` = ?", $paramsDelete);
        foreach ($_POST["Streaming_Services"] as $provider) {
            $providersId = connection::prepareStmt("SELECT `id` FROM `providers` WHERE `name` = ?", [$provider])[0]['id'];
            $paramsInsert = [$providersId, $id];
            connection::prepareStmt("INSERT INTO `offershasproviders`(`provider_id`, `offers_id`) VALUES (?,?)", $paramsInsert);
        }
    }

    public function insertOffersHasProvidersById($id) {
        foreach ($_POST["Streaming_Services"] as $provider) {
            $providersId = connection::prepareStmt("SELECT `id` FROM `providers` WHERE `name` = ?", [$provider])[0]['id'];
            $paramsInsert = [$providersId, $id];
            connection::prepareStmt("INSERT INTO `offershasproviders`(`provider_id`, `offers_id`) VALUES (?,?)", $paramsInsert);
        }
    }

    public function deleteOffersHasProvidersByOffersId($id) {
        $params = [$id];
        connection::prepareStmt("DELETE FROM `offershasproviders` WHERE `offers_id` = ?;", $params);
    }
}
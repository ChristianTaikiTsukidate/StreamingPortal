<?php

class users extends connection
{
    private $tableName = "users";

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function insertUser()
    {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $userParams = [$_POST["name"], $password, $_POST["email"]];
        connection::prepareStmt("INSERT INTO `users`(`name`, `password`, `email`) VALUES (?,?,?)", $userParams);
        $userHasRolesParams = [connection::$pdo->lastInsertId(), 1];
        connection::prepareStmt("INSERT INTO `usershasroles`(`users_id`, `roles_id`) VALUES (?,?)", $userHasRolesParams);
    }

    public function getUserByEmailAndPassword()
    {
        $userParams = [$_POST["email"]];
        $user = connection::prepareStmt("SELECT `users`.`id` AS `id`, `users`.`name` AS `name`, `users`.`email` AS `email`, `users`.`password` AS `password`, `roles`.`name` AS `role` FROM `users`
JOIN `usershasroles` ON `usershasroles`.`users_id` = `users`.`id`
JOIN `roles` ON `roles`.`id` = `usershasroles`.`roles_id`
WHERE  UPPER(`users`.`email`) = UPPER(?)", $userParams);
        if(isset($user[0]["password"]) && password_verify($_POST['password'], $user[0]["password"])) {
            unset($user[0]["password"]);
            return $user[0];
        }
        return null;
    }

    public function insertWatchlistItem($movieId, $userId){
        $params = [$movieId, $userId];
        connection::prepareStmt("INSERT INTO `watchlists`(`user_id`, `offers_id`) VALUES (?,?)", $params);
    }

}
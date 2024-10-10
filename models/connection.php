<?php
class connection
{
    private $host = "localhost";
    private $username = "editor";
    private $password = "123abc";
    private $dbname = "streamingportal";
    private $port = "3306";
    protected static $pdo = null;
    private $tableName;
    function __construct($tableName) {
        $this->tableName = $tableName;
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO('mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname, $this->username, $this->password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
    }
    function getRecords() {
        if (self::$pdo) {
            try {
                $stmt = self::$pdo->query("SELECT * FROM $this->tableName");
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $records;

            } catch (PDOException $e) {
                // Handle query failure
                echo 'Query failed: ' . $e->getMessage();
                return false;
            }
        } else {
            echo "No database connection.";
            return false;
        }
    }

    function queryStatement($sql)
    {
        if (self::$pdo) {
            try {
                $stmt = self::$pdo->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                // Handle query failure
                echo 'Query failed: ' . $e->getMessage();
                return false;
            }
        } else {
            echo "No database connection.";
            return false;
        }
    }
    function prepareStmt($sql, $params)
    {
        if (self::$pdo) {
            try {
                $stmt = self::$pdo->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Handle query failure
                echo 'Query failed: ' . $e->getMessage();
                return false;
            }
        } else {
            echo "No database connection.";
            return false;
        }
    }

    public function getArrOfSingleAttribute($sql, $attributeName): array
    {
        $assArr = self::queryStatement($sql);
        return self::convertAssArrToArr($assArr, $attributeName);
    }
    public function convertAssArrToArr($assArr, $attributeName): array
    {
        $arr = [];
        foreach($assArr as $ele) {
            $arr[] = $ele[$attributeName];
        }
        return $arr;
    }

}
<?php
class Database
{
    static $dbName = 'clinicrecorddb';
    static $dbHost = 'localhost';
    static $dbUsername = 'root';
    static $dbPassword = '';

    private static $cont = null;

    public static function letsconnect()
    {
        try {
            if (self::$cont === null) {
                self::$cont = new PDO(
                    "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                    self::$dbUsername,
                    self::$dbPassword
                );
            }
            return self::$cont;
        } catch (PDOException $e) {
            echo "Error in connection";
        }
    }


    public static  function GetOneData($pdo, $sql,  $value = 0)
    {
        try {
            if ($value != 0)
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare($sql);
            $q->execute();
            $result = $q->fetch(PDO::FETCH_ASSOC);
            return $result;
            //return false if no record 
        } catch (PDOException $e) {
        }
    }



    public static function GetAllData($pdo, $sql, $value = 0)
    {
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare($sql);
            $q->execute();
            $result = $q->fetchAll();
            return ($result);
        } catch (Exception $e) {
        }
    }

    public static function ManageRecord($pdo, $sql, $value = 0)
    {
        try {
            $q = $pdo->prepare($sql);
            $q->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

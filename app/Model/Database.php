<?php
namespace Mealoclock\Model;
/**
 * classe Database :
 * gère uniquement la connexion (unique) à la base de données, et la "passe" aux
 * Models grâce à la fonction statique getDB()
 * Elle est paramétrée par le CoreController (dans le constructeur)
 * C'est un singleton : sa seule fonction est de faire en sorte qu'une seule connexion DB
 * soit partagée par toutes les classes qui souhaitent faire un requête
 */
 class Database
 {
    private static $db;
    private static $config;
    public static function setConfig($config)
    {
        self::$config = $config;
    }
    public static function getDB()
    {
        if(!self::$db)
        {
            self::$db = new \PDO(
                "mysql:host=localhost;dbname=mealoclock;charset=utf8",
                "mealoclocker",
                "project_meal"
            );
        }
        return self::$db;
    }
 }

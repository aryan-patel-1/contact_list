<?php

class DBConnect
{
    // Stocke l'instance unique de DBConnect (nullable au départ)
    private static ?DBConnect $instance = null;
    // Propriété qui contiendra l'objet PDO (connexion à la BDD)
    private \PDO $pdo;

    // Constructeur privé : empêche l'instanciation directe depuis l'extérieur
    private function __construct()
    {
       $this->pdo = new \PDO('mysql:host=127.0.0.1;dbname=contacts', 'root', '');
    }

    // Méthode statique pour récupérer l'instance unique (Singleton)
    public static function getInstance(): DBConnect
    {
        // Si aucune instance n'existe encore, on en crée une
        if (self::$instance === null)
        {
            self::$instance = new DBConnect();
        }

        return self::$instance;
    }

    // Méthode d'instance (non statique) qui renvoie l'objet PDO
    public function getPDO(): \PDO
    {
        return $this->pdo;
    }
}
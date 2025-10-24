<?php

require_once 'DBConnect.php';

try {
    // On appelle la méthode statique getInstance() de la classe DBConnect
    // Cela retourne l'instance unique du Singleton
    // On appelle getPDO() pour récupérer l'objet PDO (connexion à la base)
    $database = DBConnect::getInstance()->getPDO();

    echo "Connexion réussie à la base de données.";
} catch (\PDOException $exception) {
    echo "Erreur de connexion :" . $exception->getMessage() . "\n";
}
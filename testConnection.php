<?php

require_once 'connection.php';

try 
{

    $db = DBConnect::getInstance()->getPDO();
    echo "Connexion réussie à la base de données.";

} catch (PDOException $e)

{
    echo "Erreur de connexion : " . $e->getMessage() . "\n";

}
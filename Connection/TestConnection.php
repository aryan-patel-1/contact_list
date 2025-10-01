<?php

require_once 'Connection/Connection.php';

try 
{

    $database = DBConnect::getInstance()->getPDO();
    echo "Connexion réussie à la base de données.";

} catch (PDOException $e)

{
    echo "Erreur de connexion :" . $e->getMessage() . "\n";

}
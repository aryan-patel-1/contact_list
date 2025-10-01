<?php

require_once 'Connection/Connection.php';
require_once 'Contact/Contact.php'; 
require_once 'Contact/ContactManager.php';

$manager = new ContactManager(DBConnect::getInstance()->getPDO());

while (true) 
{
    $line = readline("Entrez votre commande : ");

    if ($line === "list") {
        $contacts = $manager->findAll();

        foreach ($contacts as $contact) 
        {
            echo $contact->toString() . "\n";
        }  
    }

     else {

        echo "Commande inconnue : $line\n";
    }
}

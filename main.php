<?php

require_once 'Connection/DBConnect.php';
require_once 'Contact/Contact.php';
require_once 'Contact/ContactManager.php';
require_once 'Command.php';

// On crée un nouvel objet de la classe Command
$commandClass = new Command();

while (true)  {

    $line = readline("Entrez votre commande (list, detail, create, delete, modify & help) : ");

    if ($line == 'list') {
        $commandClass->list();
        continue;
    }

    // $line contient la commande entrée par l'utilisateur
    // $matches est un tableau qui est rempli automatiquement par la fonction preg_match()
    /* preg_match() : ^ :→ le début de la ligne
    ** detail → doit commencer par le mot "detail" suivi d’un espace
    ** (.*) → capture tout ce qui suit (les paramètres)
    ** $ → fin de la ligne
    */
    if (preg_match("/^detail (.*)$/", $line, $matches)) {
        $commandClass->detail($matches[1]);
        continue;
    }

    if (preg_match("/^create (.*), (.*), (.*)$/", $line, $matches)) {
        $commandClass->create($matches[1], $matches[2], $matches[3]);
        continue;
    }

    if (preg_match("/^delete (.*)$/", $line, $matches)) {
        $commandClass->delete($matches[1]);
        continue;
    }

    if ($line == 'help') {
        $commandClass->help();
        continue;
    }

    if (preg_match("/^modify (.*)$/", $line, $matches)) {
        $commandClass->modify($matches[1]);
        continue;
    }
}
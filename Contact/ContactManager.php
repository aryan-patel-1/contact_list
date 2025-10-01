<?php

class ContactManager
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function findAll(): array
    {
        $query = $this->database->prepare("SELECT * FROM contact");
        $query->execute();

        $contacts = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
        {
            $contacts[] = Contact::fromArray($row);
        }

        return $contacts;
    }


    public function findById(int $id): ?Contact
    {

        $query = $this->database->prepare("SELECT * FROM contact WHERE id = :id");
        $query->execute(["id" => $id]);

        $contact = $query->fetch(PDO::FETCH_ASSOC);

        if (!$contact) 
        {
            return null;
        }

        $contact = Contact::fromArray($contact);

        return $contact;
    }
}
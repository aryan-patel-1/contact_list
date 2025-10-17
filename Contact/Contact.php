<?php

class Contact
{
    private int $id ;
    private string $name;
    private string $email;
    private string $phone_number;

    // Le constructeur est appelé lors de la création d'un nouvel objet Contact
    // On initialise ici les propriétés avec les valeurs passées en paramètres
    public function __construct(int $id , string $name, string $email, string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    // Permet de créer un objet Contact directement à partir d'un tableau associatif
    public static function fromArray(array $contact): Contact
    {
        return new Contact(
            $contact['id'],
            $contact['name'], 
            $contact['email'],
            $contact['phone_number']
        );
    }

    // Pour afficher le contact dans le terminal
    public function toString(): string
    {
        return $this->id . ", " . $this->name . ", " . $this->email . ", " . $this->phone_number . "\n";
    }

    // Pour récupérer ou modifier les propriétés privées 
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }
}
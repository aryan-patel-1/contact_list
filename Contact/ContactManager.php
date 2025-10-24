<?php

class ContactManager
{
    private \PDO $database;
    // Est appelé à l'instanciation de la classe
    
    public function __construct(\PDO $database)
    {
        // On stocke la connexion PDO dans la propriété $database
        $this->database = $database;
    }

    /**
     * Méthode pour récupérer tous les contacts dans la base de données.
     * Retourne un tableau d’objets Contact.
     */
    public function findAll(): array
    {
        $query = $this->database->prepare("SELECT * FROM contact");
        $query->execute();

        $contacts = [];

        // fetch(PDO::FETCH_ASSOC) récupère les données sous forme de tableau associatif (clé = nom de colonne)
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
        {
            // var_dump($query->fetch(PDO::FETCH_ASSOC));die;
            // Chaque ligne de la base est transformée en objet Contact grâce à la méthode fromArray
            $contacts[] = Contact::fromArray($row);
        }

        return $contacts;
    }


    public function findById(int $id): ?Contact
    {
        $query = $this->database->prepare("SELECT * FROM contact WHERE id = :id");
        $query->execute(["id" => $id]);

        // Récupère une seule ligne de résultat
        $contact = $query->fetch(PDO::FETCH_ASSOC);

         // Si aucun contact n’est trouvé, on renvoie null
        if (!$contact) 
        {
            return null;
        }
        $contact = Contact::fromArray($contact);

        return $contact;
    }

    /**
     * Méthode pour créer un nouveau contact dans la base de données.
     * Retourne l’objet Contact créé.
     */
    public function create(string $name, string $email, string $phone_number): Contact
    {
        $query = $this->database->prepare("INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)");
        $query->execute(["name" => $name, "email" => $email, "phone_number" => $phone_number]);
        // Récupération du dernier id inséré
        $id = $this->database->lastInsertId();
        // Retourne l’objet Contact correspondant à cet ID
        return $this->findById($id);
    }

    public function delete(int $id): void
    {
        $query = $this->database->prepare("DELETE FROM contact WHERE id = :id");
        // Lie la valeur du paramètre :id à la variable $id
        // bindParam lie la variable par référence, donc elle garde sa valeur pendant l’exécution
        $query->bindParam(":id", $id);
        $query->execute();
    }

    public function modify(Contact $contact): void
    {
        // Met à jour les informations d’un contact dans la base de données
        $query = $this->database->prepare("UPDATE contact SET name = :name, email = :email, phone_number = :phone_number WHERE id = :id");

        // Exécute la requête avec les valeurs des propriétés de l’objet Contact
        $query->execute([
            "name" => $contact->getName(),
            "email" => $contact->getEmail(),
            "phone_number" => $contact->getPhoneNumber(),
            "id" => $contact->getId()
        ]);
    }
}
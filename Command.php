<?php 

require_once 'Contact/ContactManager.php';

class Command
{
    // Propriété privée qui va contenir une instance de ContactManager
    private $manager;

    public function __construct()
    {
        // À la création de l’objet Command, on instancie un ContactManager
        // On lui passe la connexion à la base de données grâce à DBConnect
        $this->manager = new ContactManager(DBConnect::getInstance()->getPDO()); 
    }

    public function list(): void
    {
        // On récupère tous les contacts via la méthode findAll() du ContactManager
        $contacts = $this->manager->findAll();
        // Si le tableau de contact est vide, on affiche un message et on arrête l'exécution de la méthode
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return ;
        }

        echo "Liste des contacts : \n";
        echo "id, nom, email, telephone\n";
        // On parcourt le tableau de contacts et on affiche chaque contact
        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
    }

    // Affiche les détails d’un contact à partir de son identifiant
    public function detail(int $id): void {
        $contact = $this->manager->findById($id);
        // Si aucun contact n’est trouvé, on affiche un message
        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }
        echo $contact->toString();
    }

    public function create(string $name, string $email, string $phone_number): void
    {
        // On appelle la méthode create() du ContactManager pour insérer le contact dans la base
        $contact = $this->manager->create($name, $email, $phone_number);
        echo "Contact créé : " . $contact->toString();
    }

    public function delete(int $id): void
    {
        $this->manager->delete($id);
        echo "Contact supprimé\n";
    }
}
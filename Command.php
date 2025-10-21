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
            echo $contact;
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
        echo $contact;
    }

    public function create(string $name, string $email, string $phone_number): void
    {
        // On appelle la méthode create() du ContactManager pour insérer le contact dans la base
        $contact = $this->manager->create($name, $email, $phone_number);
        echo "Contact créé : " . $contact;
    }

    public function delete(int $id): void
    {
        $this->manager->delete($id);
        echo "Contact supprimé\n";
    }

    public function help(): void {
        echo "help : affiche cette aide\n";
        echo "list : liste les contacts\n";
        echo "create [nom], [email], [telephone] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
    }

    public function modify(int $id): void
    {
        // Permet de chercher le contact correspondant à l'id donné
        $contact = $this->manager->findById($id);

        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }

        $name = readline("Nouveau nom ({$contact->getName()}) : ");
        $email = readline("Nouvel email ({$contact->getEmail()}) : ");
        $phone = readline("Nouveau téléphone ({$contact->getPhoneNumber()}) : ");

        // Si pas de valeur alors on garde l'ancienne valeur
        if (!empty($name)) $contact->setName($name);
        if (!empty($email)) $contact->setEmail($email);
        if (!empty($phone)) $contact->setPhoneNumber($phone);

        // Permet l'envoie de l'objet contact mis à jour à ContactManager
        $this->manager->modify($contact);

        echo "Contact mis à jour avec succès : " . $contact . "\n";
    }

}
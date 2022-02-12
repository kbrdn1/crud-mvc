<?php

// On créer l'object Model() qui va gerer le lien a la bases de donnée (BDD)
class Model
{
    // On donne les propriétés nécessaires en 'private' pour la sécurité
    private int $id = 0;
    private string $produit = "";
    private float $prix = 0;
    private int $nombre = 0;

    //On donne nos Getter et Setter pour chaque propriétés

    // Pour l'id
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    // Pour le produit
    public function setProduit(string $produit)
    {
        $this->produit = $produit;
    }

    public function getProduit()
    {
        return $this->produit;
    }

    // Pour le prix
    public function setPrix(float $prix)
    {
        $this->prix = $prix;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    // Pour le nombre
    public function setNombre(int $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    // On setup nos methodes pour les liaisons à la BDD 

    // On fait la connetion à la BDD
    private function connect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=crud', 'root', '');  // nom de la base / id / mdp
            $db->exec('SET NAMES "UTF8"');
            return $db;
        } catch (PDOException $e) {
            echo 'ERREUR : ' . $e->getMessage(); // message d'erreur
            die();
        }
    }

    // Methode pour récupèrer les tous les produits de la BDD
    public function view()
    {
        // On démarre une session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        // Requête sql
        $sql = 'SELECT * FROM `produit`';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On exéte la requête
        $query->execute();

        // On stocke le résultat dans un tableau assossiatif
        return $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Methode pour ajouter un produit à la BDD
    public function add()
    {
        // On démarre uune session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        // On donne les variables depuis l'object Model()
        $produit = $this->produit;
        $prix = $this->prix;
        $nombre = $this->nombre;

        // Requête sql
        $sql = 'INSERT INTO `produit` (`produit`, `prix`, `nombre`) VALUES (:produit, :prix, :nombre);';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On donne les valeurs de la requête
        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', strval($prix), PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);

        // On exéte la requête
        $query->execute();

        // On return un message de validation
        $_SESSION['message'] = "Produit Ajouté";

        header('Location: index.php');
    }

    // Methode pour modifier un produit dans la BDD
    public function edit()
    {
        // On démarre uune session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        // On donne les variables depuis l'object Model()
        $id = $this->id;
        $produit = $this->produit;
        $prix = $this->prix;
        $nombre = $this->nombre;

        // Requête sql
        $sql = "UPDATE `produit` SET `produit` = :produit, :prix, :nombre WHERE id= :id;";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On donne les valeurs de la requête
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', strval($prix), PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);

        // On exéte la requête
        $query->execute();

        // On return un message de validation
        $_SESSION['message'] = "Produit Modifié";
    }

    // Methode pour récupèrer le produit a mofifier depuis l'id dans la BDD
    public function getEdit()
    {
        // On démarre uune session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        // On donne les variables depuis l'object Model()
        $id = $this->id;

        // Requête sql
        $sql = "SELECT * FROM `produit` WHERE id = :id;";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On donne les valeurs de la requête
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        // On exéte la requête
        $query->execute();

        // On stocke le résultat dans un tableau assossiatif
        return $result = $query->fetch(PDO::FETCH_ASSOC);
    }

    // Methode pour supprimer un produit depuis l'id à la BDD
    public function delete()
    {
        // On démarre uune session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        // On donne les variables depuis l'object Model()
        $id = $this->id;

        // Requête sql
        $sql = 'DELETE FROM produit WHERE id=' . $id;

        // On prépare la requête
        $query = $db->prepare($sql);

        // On donne les valeurs de la requête
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        // On exéte la requête
        $query->execute();

        // On return un message de validation
        $_SESSION['message'] = "Produit Supprimé";
    }
}

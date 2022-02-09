<?php

class Model
{
    private int $id = 0;
    private string $produit = "";
    private float $prix = 0;
    private int $nombre = 0;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setProduit(string $produit)
    {
        $this->produit = $produit;
    }

    public function getProduit()
    {
        return $this->produit;
    }

    public function setPrix(float $prix)
    {
        $this->prix = $prix;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setNombre(int $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    private function connect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=crud', 'root', '');
            $db->exec('SET NAMES "UTF8"');
            return $db;
        } catch (PDOException $e) {
            echo 'ERREUR : ' . $e->getMessage();
            die();
        }
    }

    public function view()
    {
        // On démarre une session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        $sql = 'SELECT * FROM `produit`';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On exéte la requête
        $query->execute();

        // On stocke le résultat dans un tableau assossiatif
        return $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add()
    {
        // On démarre uune session
        session_start();

        // On inclut la connexion à la base
        $db = $this->connect();

        // On nettoie les données
        $produit = $this->produit;
        $prix = $this->prix;
        $nombre = $this->nombre;

        $sql = 'INSERT INTO `produit` (`produit`, `prix`, `nombre`) VALUES (:produit, :prix, :nombre);';

        $query = $db->prepare($sql);

        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', strval($prix), PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Produit Ajouté";

        header('Location: index.php');
    }
}

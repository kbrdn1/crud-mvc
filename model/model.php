<?php 

class Model
{
    private function connect()
    {
        try{
            $db = new PDO('mysql:host=localhost;dbname=crud','root','');
            $db->exec('SET NAMES "UTF8"');
            return $db;
        } catch (PDOException $e){
            echo 'ERREUR : '. $e->getMessage();
            die();
        }
    }

    private function close()
    {
        return null;
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
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $db = $this->close();
    }

}

?>
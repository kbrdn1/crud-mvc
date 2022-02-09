<?php
session_start();

if ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {

        require_once('connect.php');

        $id = strip_tags($_GET['id']);

        $sql = 'DELETE FROM produit WHERE id=' . $id;

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Produit Supprimé";

        require_once('close.php');

        header('Location: index.php');
    }
}
<?php

// Lien vers model.php
require("./model/model.php");

// Function viewProducts qui récupere les produits et les envoies à list.php
function viewProducts()
{
    $model = new Model();

    // On appelle la methode et on stock le resultat retourné
    $result = $model->view();

    // Lien vers la vue
    require("./view/list.php");
}

// Function addProducts qui récupere le produit ajouté et l'envoie à add.php
function addProduct()
{
    // Envoie des valeurs à l'objet Model() dans model.php
    if ($_POST) {
        if (
            isset($_POST["produit"]) && !empty($_POST["produit"])
            && isset($_POST["prix"]) && !empty($_POST["prix"])
            && isset($_POST["nombre"]) && !empty($_POST["nombre"])
        ) {
            // On nettoies les valeurs et on les envoies à l'objet
            $model = new Model();
            $model->setProduit(strip_tags($_POST["produit"]));
            $model->setPrix(strip_tags($_POST["prix"]));
            $model->setNombre(strip_tags($_POST["nombre"]));

            // On appelle la methode
            $model->add();
        } else {
            $_SESSION['error'] = "Le formulaire est incomplet";
        }
    }

    // Lien vers la vue
    require("./view/add.php");
}

//function editProducts qui récupere le produit modifié et l'envoie à edit.php
function editProduct()
{
    // Envoie des valeurs à l'objet Model() dans model.php
    if ($_POST) {
        if (
            isset($_POST["produit"]) && !empty($_POST["produit"])
            && isset($_POST["prix"]) && !empty($_POST["prix"])
            && isset($_POST["nombre"]) && !empty($_POST["nombre"])
        ) {
            // On nettoies les valeurs et on les envoies à l'objet
            $model = new Model();
            $model->setId(strip_tags($_GET["id"]));
            $model->setProduit(strip_tags($_POST["produit"]));
            $model->setPrix(strip_tags($_POST["prix"]));
            $model->setNombre(strip_tags($_POST["nombre"]));

            // On appelle la methode
            $model->edit();

            header('Location: index.php');
        } else {
            $_SESSION['error'] = "Le formulaire est incomplet";
        }
    }

    // Envoie de l'id à l'objet Model() dans model.php
    if ($_GET) {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            // On nettoies les valeurs et on les envoies à l'objet
            $model = new Model();
            $model->setId(strip_tags($_GET["id"]));

            // On appelle la methode et on stock le resultat retourné
            $result = $model->getEdit();
        }
    }

    // Lien vers la vue
    require("./view/edit.php");
}

//function deleteProducts qui return le produit supprimé et renvoie à list.php
function deleteProduct()
{
    // Envoie de l'id à l'objet Model() dans model.php
    if ($_GET["id"]) {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            // On nettoies les valeurs et on les envoies à l'objet
            $model = new Model();
            $model->setId(strip_tags($_GET["id"]));

            // On appelle la methode
            $model->delete();

            header('Location: index.php');
        }
    }

    // Lien vers la vue
    require("./view/list.php");
}

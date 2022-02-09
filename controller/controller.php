<?php

require("./model/model.php");

function viewProducts()
{
    $model = new Model();
    $result = $model->view();

    require("./view/list.php");
}

function addProduct()
{
    if ($_POST) {
        if (
            isset($_POST["produit"]) && !empty($_POST["produit"])
            && isset($_POST["prix"]) && !empty($_POST["prix"])
            && isset($_POST["nombre"]) && !empty($_POST["nombre"])
        ) {
            $model = new Model();
            $model->setProduit(strip_tags($_POST["produit"]));
            $model->setPrix(strip_tags($_POST["prix"]));
            $model->setNombre(strip_tags($_POST["nombre"]));
            $model->add();
        } else {
            $_SESSION['error'] = "Le formulaire est incomplet";
        }
        
    }
    require("./view/add.php");
}

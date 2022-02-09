<?php
session_start();

require_once('connect.php');

if ($_POST) {
    if (isset($_POST["produit"]) && !empty($_POST["produit"]) && isset($_POST["prix"]) && !empty($_POST["prix"]) && isset($_POST["nombre"]) && !empty($_POST["nombre"])) {

        $id = strip_tags($_GET['id']);
        $produit = strip_tags($_POST['produit']);
        $prix = strip_tags($_POST['prix']);
        $nombre = strip_tags($_POST['nombre']);

        $sql = "UPDATE `produit` SET `produit` = '" . $produit . "', `prix` = '" . $prix . "',`nombre` = '" . $nombre . "' WHERE id=" . $id;

        $query = $db->prepare($sql);

        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', strval($prix), PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Produit Modifié";

        require_once('close.php');

        header('Location: index.php');
    } else {
        $_SESSION['error'] = "Le formulaire est incomplet";
    }
}

if ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {

        $id = strip_tags($_GET['id']);

        $sql = "SELECT * FROM `produit` WHERE id ='" . $id . "'";

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        $produit = $query->fetch(PDO::FETCH_ASSOC);
    }
}
require_once('close.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Edition</title>
</head>

<body class="bg-dark d-flex justify-content-center">


    <div class="col-6">
        <?php
        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION["error"] . '</div>';
            $_SESSION['error'] = "";
        }
        ?>
        <div class="col-12 bg-secondary p-1 mt-5 border rounded-3 border-warning">
            <h2 class="text-center text-warning">Modifier l'id n°<?php echo $id; ?></h2>

            <form class="col-12 d-flex justify-content-around" method="post">
                <input class="col-4 rounded" type="text" id="produit" name="produit" placeholder="Produit" value="<?= $produit['produit'] ?>">
                <input class="col-2 rounded" type="text" id="prix" name="prix" placeholder="Prix" value="<?= $produit['prix'] ?>">
                <input class="col-2 rounded" type="number" id="nombre" name="nombre" placeholder="Quantité" value="<?= $produit['nombre'] ?>">
                <input class="col-2 btn-success rounded-pill" type="submit" name="send" value="Envoyer">
            </form>
            <a href="index"><button class="btn-danger m-1 rounded-pill ms-3">Retour</button></a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
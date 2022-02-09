

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ajouter</title>
</head>

<body class="bg-dark d-flex justify-content-center">


    <div class="col-6">
        <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION["error"] . '</div>';
            $_SESSION['error'] = "";
        }
        ?>
        <div class="col-12 bg-secondary p-1 border rounded-3 border-warning mt-5">
            <h2 class="text-center text-warning">Ajouter</h2>

            <form class="col-12 d-flex justify-content-around" method="post">
                <input class="col-4 rounded" type="text" id="produit" name="produit" placeholder="Produit">
                <input class="col-2 rounded" type="text" id="prix" name="prix" placeholder="Prix">
                <input class="col-2 rounded" type="number" id="nombre" name="nombre" placeholder="Quantité">
                <input class="col-2 btn-success rounded-pill" type="submit" name="send" value="Envoyer">
            </form>
            <a href="/php/produit/index.php"><button class="btn-danger m-1 rounded-pill ms-3">Retour</button></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>


</html>
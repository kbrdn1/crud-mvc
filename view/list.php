<?php
// On démarre uune session
session_start();

// On inclut la connexion à la base
require_once('connect.php');

$sql = 'SELECT * FROM `produit`';

// On prépare la requête
$query = $db->prepare($sql);

// On exéte la requête
$query->execute();

// On stocke le résultat dans un tableau assossiatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Crud</title>
</head>

<body class="bg-dark d-flex justify-content-center">
    <div class="col-6 text-center">
        <?php
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION["message"] . '</div>';
            $_SESSION['message'] = "";
        }
        ?>
        <table class="col-12 bg-light text-center border border-primary border-3 mt-5">
            <thead>
                <tr>
                    <th style="background-color: #eee;" class="border border-primary border-3">ID</th>
                    <th style="background-color: #eee;" class="border border-primary border-3">Produit(s)</th>
                    <th style="background-color: #eee;" class="border border-primary border-3">Prix</th>
                    <th style="background-color: #eee;" class="border border-primary border-3">Quantité(s)</th>
                    <th class="border border-primary border-3 bg-warning">Edition</th>
                    <th class="border border-primary border-3 bg-danger">Suprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // On boucle sur la variable result
                foreach ($result as $produit) {
                ?>
                    <tr>
                        <td style="background-color: #eee;" class="border-bottom border-2 border-end-0 border-start-0"><?= $produit['id'] ?></td>
                        <td class="border-bottom border-2 border-end-0 border-start-0"><?= $produit['produit'] ?></td>
                        <td style="background-color: #eee;" class="border-bottom border-2 border-end-0 border-start-0"><?= $produit['prix'] ?></td>
                        <td class="border-bottom border-2 border-end-0 border-start-0"> <?= $produit['nombre'] ?></td>
                        <td style="background-color: #eee;" class="border-bottom border-2 border-end-0 border-start-0"><a href="edit.php?id=<?= $produit['id'] ?>"><button class="btn-warning rounded-pill">edit</button></a></td>
                        <td class="border-bottom border-2 border-end-0 border-start-0"><a href="delete.php?id=<?= $produit['id'] ?>"><button class="btn-danger rounded-pill">delete</button></a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="add"><button class="col-3 btn-success rounded-pill mt-3">Ajouter</button></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
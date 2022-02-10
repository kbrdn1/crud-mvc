<?php
require("./controller/controller.php");

if (isset($_GET["action"])) {
    if ($_GET["action"] == 'add') {
        addProduct();
    }
    if ($_GET["action"] == 'edit') {
        editProduct();
    }
} else {
    viewProducts();
}
?>
<?php
require("./controller/controller.php");

if (isset($_GET["action"])) {
    if ($_GET["action"] == 'add') {
        addProduct();
    }
    if ($_GET["action"] == 'edit') {
        editProduct();
    }
    if ($_GET["action"] == 'delete') {
        deleteProduct();
    }
    if ($_GET["action"] == 'index') {
        viewProducts();
    }
} else {
    viewProducts();
}
?>
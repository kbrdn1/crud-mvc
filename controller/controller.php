<?php 

    require("./model/model.php");

    function viewProducts()
    {
        $model = new Model();
        $result = $model->view();
        
        require("./view/list.php");
    }

?>
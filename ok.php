<?php include('partials-front/menu.php'); ?>

<?php

if(isset($_POST['cod'])){
    $_SESSION['add'] = "<div class='success text-center'>Ordered placed succesfully.</div>";
            header('Location:'.SITEURL. 'food.php');
            unset($_SESSION['cart']);
            ob_end_flush();
            exit();
}
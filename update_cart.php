<?php 
    session_start();

    if(isset($_POST['id']) && isset($_POST['check'])){
        $id = $_POST['id'];
        $check = $_POST['check'];

        if($_SESSION['cart'][$id]){
            if($check == 'true'){
                $_SESSION['cart'][$id]['qty'] += 1;
            }else{
                $_SESSION['cart'][$id]['qty'] -= 1;
            }
        }
    }
?>
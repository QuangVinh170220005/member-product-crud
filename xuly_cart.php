<?php 
    include 'connect.php';
    session_start();

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $conn -> query($sql);
        $total = 0;

        if($result -> num_rows > 0){
            $product = $result -> fetch_assoc();

            if(isset($_SESSION['cart'][$id])){
                $_SESSION['cart'][$id]['qty'] += 1;
            }else{
                $product['qty'] = 1;
                $_SESSION['cart'][$id] = $product;
            }
            foreach ($_SESSION['cart'] as $value){
                $total += $value['qty'];
            }
            echo $total;
            
        }
    }
?>
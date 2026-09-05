<?php
    include 'connect.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = $id";

    if($conn -> query($sql)){
        header("Location: my-product.php");
		exit();
    }else {
            echo "Lỗi xóa: " . $conn->error;
        }
?>
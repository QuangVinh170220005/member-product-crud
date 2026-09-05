<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
        if(isset($_POST['upload'])){
            if(!empty($_FILES['avatar']['name'])){
                // echo "<pre>";
                // var_dump($_FILES);

                if($_FILES['avatar']['error'] > 0){
                    echo 'Lỗi';
                }else{
                    if($_FILES['avatar']['size'] > 1024 * 1024){
                        echo 'File nhỏ lớn 1MB';
                    }else{
                        $name = $_FILES['avatar']['name'];

                        $duoi = explode('.', $name);
                        $arr = [];
                        foreach($duoi as $key => $value){
                            if($key == 1){
                                $arr = $value;
                            }
                        }
                        $type = ['png', 'jpg', 'jpeg'];
                        
                        if(in_array($arr, $type)){
                        move_uploaded_file(
                            $_FILES['avatar']['tmp_name'],'./image/' . $_FILES['avatar']['name']);
                            echo 'upload thành công';
                        }else{
                            echo "Đuổi file kh được cho phép";
                        }
                    }
                    
                }
                
            }
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" id="">
        <input type="submit" name="upload" id="">
    </form>
</body>
</html>
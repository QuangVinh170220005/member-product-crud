<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php 
    include 'connect.php';
    $err_name = '';
    $err_email = '';
    $err_pass = '';
    $err_avt = '';

    if(isset($_POST['register'])){
        if(empty($_POST['name'])){
            $err_name = 'Hãy nhập username';
        }
        if(empty($_POST['email'])){
        $err_email = 'Hãy nhập email';
        }

        if(empty($_POST['password'])){
            $err_pass = 'Hãy nhập password';
        }

        if(empty($_FILES['avatar']['name'])){
            $err_avt = 'Hãy chọn ảnh đại diện';
        }else{
            if($_FILES['avatar']['size'] > 1024 * 1024){
                $err_avt = 'File phải nhỏ hơn 1MB';
            }else{
                $name = $_FILES['avatar']['name'];
                $arr = explode('.', $name);
                if ($arr[1] != 'jpg' && $arr[1] != 'png' &&  $arr[1] != 'jpeg') {
                    $err_avt = 'Chỉ được upload jpg, png, jpeg';
                }else{
                    move_uploaded_file(
                        $_FILES['avatar']['tmp_name'],'./uploads/'.$_FILES['avatar']['name']
                    );
                }
            }
        }

       if ($err_name == '' &&  $err_email == '' &&  $err_pass == '' &&  $err_avt == ''){
            $username = $_POST['name'];
            $email = $_POST['email'];
            $pass = md5($_POST['password']);
            $avt = './uploads/' . $_FILES['avatar']['name'];

            $sql = "INSERT INTO user(username, email, pass, avatar) 
            VALUES ('$username', '$email', '$pass', '$avt')";

            if($result = $conn -> query($sql)){
                header('Location: login.php');
                exit;
            }else{
                echo 'Đăng ký thất bại';
            }
       }
    }
 ?>
<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="signup-form">
                    <h2>New User Signup!</h2>
                    <form action="" method="post" enctype="multipart/form-data">

                        <input type="text" name="name" placeholder="Name">
                        <span><?php echo $err_name; ?></span>

                        <input type="email" name="email" placeholder="Email Address">
                        <span><?php echo $err_email; ?></span>

                        <input type="password" name="password" placeholder="Password">
                        <span><?php echo $err_pass; ?></span>

                        <input type="file" name="avatar">
                        <span><?php echo $err_avt; ?></span>

                        <button type="submit" name="register" class="btn btn-default">
                            Signup
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>

            <div class="col-sm-4">
                <h2>Already have an account?</h2>

                <a href="login.php"
                   class="btn btn-default">
                    Login
                </a>
            </div>

        </div>
    </div>
</section>

</body>
</html>
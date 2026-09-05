<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CSS của form -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php 
    include 'connect.php';
    session_start();
    $err_email = '';
    $err_pass = '';
    if(isset($_POST['login'])){
        if(empty($_POST['email'])){
        $err_email = 'Hãy nhập email';
        }

        if(empty($_POST['password'])){
            $err_pass = 'Hãy nhập password';
        }
        if($err_email == '' &&  $err_pass == ''){

            $email = $_POST['email'];
            $pass = md5($_POST['password']);

            $sql = "SELECT * FROM user where email = '$email' AND pass = '$pass'";
            $result = $conn -> query($sql);
            if($result -> num_rows > 0){
                $row = $result -> fetch_assoc();

                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pass'] = $row['pass'];
                
                header("Location: index.php");
                exit();
            }else{
                echo 'Đăng nhập thất bại';
            }
        }
    }
?>
<section id="form">
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Login to your account</h2>

                    <form action="" method="post">

                        <input type="email" name="email" placeholder="Email Address">
                        <span><?php echo $err_email; ?></span>

                        <input type="password" name="password" placeholder="Password">
                        <span><?php echo $err_pass; ?></span>

                        <button type="submit" name="login" class="btn btn-default">
                            Login
                        </button>

                    </form>
                </div>
            </div>

            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>

            <div class="col-sm-4">
                <h2>New User?</h2>

                <a href="register.php"
                   class="btn btn-default">
                    Signup
                </a>
            </div>

        </div>
    </div>
</section>

</body>
</html>
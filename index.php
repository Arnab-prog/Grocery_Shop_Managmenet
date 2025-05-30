<?php
    include('connection.php');
    session_start();

    if(isset($_POST['submit']))
    {
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $error=false;
        $sql = "SELECT * FROM login WHERE User='$user' AND Pass='$pass' limit 1";
        $result = $conn->query($sql);
        if ($result->num_rows === 1) {
            $_SESSION['user'] = $user;
            header("Location: home1.php");
        } else {
            $error = true;
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <title>Login Page</title>
    </head>
    <body>

    <img class="wave" src="image/wave.png">
    <div class="container">
        <div class="img">
            <img src="image/bg.svg">
        </div>
        <div class="login-content">
            <form action="index.php" method="post" class="form">
                <img src="image/avatar.svg">
                <h1 class="form__title">Sign In</h1>
                <div class="form_div">
                    <input type="text" name="user" class="form__input" placeholder=" ">
                    <label for="" class="form__label">Username</label>
                </div>
                <div class="form_div">
                    <input type="password" name="pass" class="form__input" placeholder=" ">
                    <label for="" class="form__label">Password</label>
                </div>
                <div class="error">
                    <?php
                    if(isset($error))
                    {
                        echo "Invalid Username or Password";
                    }

                    ?>
                </div>
                <a href="reset.html">Forgot Password?</a>
                <input type="submit" class="btn" name="submit">
                <a href="createaccount.html">Sign Up</a>
            </form>
        </div>
    </div> 
    </body>
    </html>
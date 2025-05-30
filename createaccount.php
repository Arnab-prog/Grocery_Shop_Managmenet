<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/createaccount.css">
    <title>Create User</title>
    <link rel="shortcut icon" type="image" href="image/123.png">
    <?php
    session_start();
    if(isset($_SESSION['user']))
    {
    }
    else{
        echo "<script> alert('Please Login 1st');window.location='index.php';</script>";
    }?>
</head>
<body>
    <img class="wave" src="image/wave2.png">
    <div class="container">
        <div class="img">
            <img src="image/bg2.svg">
        </div>
        <div class="login-content">
            <form action="create%20account.php" method="post" class="form">
                <img src="image/profile pic.svg">
                <h1 class="form__title">Sign Up</h1>
                <div class="position">
                    <div class="form_div">
                        <input type="text" name="user" class="form__input" placeholder=" ">
                        <label for="" class="form__label">Username</label>
                    </div>
                    <div class="form_div"> 
                        <input type="password" name="pass" class="form__input" placeholder=" ">
                        <label for="" class="form__label">Password</label>
                    </div>
                    <div class="form_div">  
                        <input type="password" name="pass1" class="form__input" placeholder=" ">
                        <label for="" class="form__label">Reenter Password</label>
                    </div>
                    <div class="form_div">
                        <input type="date" name="dob" class="form__input" placeholder=" ">
                        <label for="" class="form__label">dath of barth</label>
                    </div>
                </div>
                <div class="button">
                <input type="submit" class="btn" name="submit">
                <a href="home.php">Home</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
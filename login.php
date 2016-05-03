<?php
session_start();

require "connect.php";

$logError = array();

 if(isset($_POST['login']))
 {
     if(isset($_POST['email']) && isset($_POST['pass'])) 
     {
         $email = checkData($_POST['email']);
         $pass = checkData($_POST['pass']);

         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
             if (mysqli_num_rows(Login($email, $pass)) === 1) {
                 $rows = mysqli_fetch_array(Login($email, $pass));
                 $parsInfo = array('name' => $rows['name'], 'lastname' => $rows['lastname'], 'email' => $rows['email'], 'imgpath' => $rows['imgpath'],);
                 $parsInfo = serialize($parsInfo);
                 $_SESSION['login'] = $parsInfo;
                 header("Location: index.php");
             } else {
                 $logError["Incorect"] = "Incorrect Email or password";
             }
         }else
         {
             $logErrors['email'] = "Not valid email";
         }
     }
 };
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="js/jquery-2.2.3.js"></script>
    <script src="js/jquery.validate.js"> </script>
</head>
<body>
    <h2 class ="text-center">LOGIN</h2>
    <div class="container">
        <div class="row">
        <a href="register.php" class="btn btn-info">Register</a>
        <form id="loginForm" action="login.php" method="post">
            <div class="form-group">
                <input id="userEmail" type="email" name="email" placeholder="email" class="form-control"><br>
                <?php
                    if(isset($logErrors['email']))
                    {
                        echo "<p class='redAlert'>".$logErrors['email']."</p>"."<br>";
                    }
                ?>
            </div>
            <div class="form-group">
                <input type="password" name="pass" placeholder="password" class="form-control"><br>
                <?php  if(isset($logError['Incorect']))
                {
                    echo  "<p class='redAlert'>".$logError['Incorect']."<p>"."<br>";
                }
                mysqli_close(connect());
                ?>
            </div>
            <input type="submit" name="login"  class="btn btn-info pull-left">
        </div><!--row-->
    </div><!--container-->
    </form>
    <script src = "js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
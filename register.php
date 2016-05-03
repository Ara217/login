<?php
require "connect.php";

$regErrors = array();
$validTyps = array('image/gif','image/jpeg','image/png');

if(isset($_POST['signup'])) 
{
    if ((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['lastname']) && !empty($_POST['lastname'])) && (isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['confirm']) && !empty($_POST['confirm'])) && (isset($_POST['password']) && !empty($_POST['password']))) 
    {
        $name = checkData($_POST['name']);
        $lastName = checkData($_POST['lastname']);
        $email = checkData($_POST['email']);
        $pass = checkData($_POST['password']);
        $confirm = checkData($_POST['confirm']);
        //$fileName = $_FILES["file"]["name"];
        $filePath = "files/ " . $_FILES["upfile"]["name"];
        $fileType = $_FILES["upfile"]["type"];
        if (($_POST['password'] === $_POST['confirm'])) 
        {
            if ($_FILES["upfile"]["error"] === 0) 
            {
                if(in_array($fileType,$validTyps)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (mysqli_num_rows(check($email)) === 0) {
                            move_uploaded_file($_FILES["upfile"]["tmp_name"],"files/ ".$_FILES["upfile"]["name"]);
                            $insert = mysqli_query(connect(), "INSERT INTO USERS (name,lastname,email,password,imgpath) VALUES ('$name','$lastName','$email','$pass','$filePath')");
                            header('Location: login.php');

                        } else {
                            $regErrors['email'] = "This email already used";
                        }

                    } else {
                        $regErrors['notValideEmail'] = "Not valide email";
                    }
                }else
                {
                    $regErrors['notValideFile'] = "Not valide type file";
                }
            } else
            {
               $regErrors['file'] = "Someting wrong with uploaded file!!!";
            }
        } elseif ($pass !== $confirm) 
        {
            $regErrors['pass'] = "Password or confirm wrong";
        }
    } else
    {
        $regErrors['empty'] = "Some of inputs are empty";
    };
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-2.2.3.js"></script>
    <script src="js/jquery.validate.js"> </script>
</head>
<body>
<div class="main">
    <h2 class ="text-center">SIGN UP</h2>
    <div class="fiel">
        <div class="container">
            <div class="row col-lg-6">
                <a href="login.php" class="btn btn-info">Login</a>
                <form id="registerForm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" class="form-control"><br>
                    </div>

                    <div class="form-group">
                        <input type="text" name="lastname" placeholder="Lastname" class="form-control"><br>
                    </div>

                    <div class="form-group">
                        <input id="userEmail" type="email" name="email" placeholder="Email" class="form-control"><br>
                        <?php
                        if(isset($regErrors['email']))
                        {
                            echo "<p class='redAlert'>".$regErrors['email']."</p>"."<br>";
                        }
                        if(isset($regErrors['notValideEmail']))
                        {
                            echo "<p class='redAlert'>".$regErrors['notValideEmail']."</p>"."<br>";
                        }
                            ?>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" name="password" placeholder="Password" class="form-control"><br>
                        <?php
                        if(isset($regErrors['pass']))
                        {
                            echo "<p class='redAlert'>".$regErrors['pass']."</p>"."<br>";
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <input type="password" name="confirm" placeholder="Confirm password" class="form-control"><br>
                        <?php
                        if(isset($regErrors['empty']))
                        {
                            echo "<p class='redAlert'>".$regErrors['empty']."</p>"."<br>";
                        }
                        ?>
                    </div>
                    <div class="btn btn-default btn-file">
                        UPLOAD YOU FILE
                        <input type="file" name="upfile"><br>
                        <?php
                        if(isset($regErrors['file']))
                        {
                            echo $regErrors['file']."<br>";
                        }
                        if(isset($regErrors['notValideFile']))
                        {
                            echo $regErrors['notValideFile']."<br>";
                        }
                        mysqli_close(connect());
                        ?>
                    </div>
                    <div >
                        <input type="submit" name ="signup" value="SIGN UP" class="btn btn-info pull-left">
                    </div>
                </form>
            </div><!--row-->
        </div><!--container-->
    </div><!--fiel-->
</div><!--main-->
<script src = "js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
<html>
<?php




<?php
    session_start();
    if(isset($_POST['logout']))
    {
        unset($_SESSION['login']);
        header('Location: login.php');
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="js/jquery-2.2.3.js"></script>
</head>
<body>
    <?php
    if (!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }else
    {
        $info = $_SESSION['login'];
        $info = unserialize($info); ?>
        <div class="pers">
                <img src="<?php echo $info['imgpath'] ?>" alt="Persola photo">
            <h2>
                <?php
                    echo $info["name"]." ".$info["lastname"];
                ?>
            </h2>
            <p>
                <?php
                    $info['email'];
                ?>
            </p>
        </div>
    <?php } ?>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <input type="submit" name="logout" value="LOGOUT" class="btn btn-info">
    </form>
    <script src = "js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

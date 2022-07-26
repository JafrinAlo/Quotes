<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['email'])) {
    die('Not logged in');
}
if(isset($_POST['leave'])){
    header('Location:index.php');
    unset($_SESSION['email']);
    return;
}
if(isset($_POST['cancel'])){
    header('Location:home.php');
    return;
}
if(isset($_POST['post'])){
    if(isset($_POST['quote'])){
        $stmt=$pdo->prepare('INSERT INTO `opinion`(`email`, `word`)
                             VALUES (:email,:word)');
        $stmt->execute(array(
                            ':email'=>$_SESSION['email'],
                            ':word'=>$_POST['quote']
    ));
    $_SESSION['success'] = "Quote posted";
   header("Location: home.php");
    return;
    }
   
}


?>
<html>
    <head><link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"></head>
    <title> Home </title>
    <body>
        <form method="POST">
        <input type="submit" name="leave" class="btn btn-primary" value="Leave">
        </form>
        <?php
        if (isset($_SESSION['success'])) {
        echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
        unset($_SESSION['success']);
    }?>
        <form method="POST">
        
            <label for="">Quote</label>
            <input type="text" name="quote" class="form-control">
            <input type="submit" name="post" class="btn btn-primary" value="Post">
            <input type="submit" name="cancel" class="btn btn-primary" value="Cancel">
        </form>
    </body>
</html>

<?php
session_start();
require_once "pdo.php";

if (isset($_POST['cancel'])) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

//$salt = 'XyZzy12*_';
if (isset($_POST['pass']) && isset($_POST['email'])) {
    //$check = hash('md5', $salt . $_POST['pass']);
    $check = hash('md5', $_POST['pass']);
    $stmt = $pdo->prepare('SELECT email FROM user WHERE email = :em AND password = :pw');

    $stmt->execute(array(':em' => $_POST['email'], ':pw' => $check));


    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row !== false) {
        
        $_SESSION['email'] = $row['email'];

        header("Location: home.php");

        return;
    }


// Fall through into the View
}
?>
<!DOCTYPE html>
<html>
<head>
<title> User Login </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="POST" action="login.php">
        User Name <input type="text" name="email" id="id_3535"><br/>
        Password <input type="password" name="pass" id="id_1723"><br/>
        <input type="submit" onclick="return doValidate();" value="Log In">
       
        <input type="submit" name="cancel" value="Cancel">
    </form>
  
</div>
<script>
    function doValidate(){
        console.log('Validating....');
        try{
            pw=document.getElementById('id_1723').value;
            email=document.getElementById('id_3535').value;
            console.log("Validating pw="+pw);
            if(pw==null || pw==""){
                alert("Both fields must be filled out");
                return false;
            }
            console.log("Validating email="+email);
            if(email.includes("@")==false){
                alert("Invalid email address");
                return false;
            }
            return true;

        }catch(e){
            return false;
        }
        return false;
    }
</script>
</body>
</html>



<html>
<head>
        <title> Quotes </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    </head>
    <body>
  
        <h1>Rich/Poor bro Quotes</h1>
        <h2>Made for fun purpose</h2>
       
        <div class="container">
        <form action="">
            <label for="" id="search">Search Quotes</label>
            <input type="text" id="search">
        </form>
            <div class="row">
            <div class="col-md-6 left">
                <h2>Rich Bro once said:</h2>
                <?php
                    require_once "pdo.php";
                    require "result_index.php";
                    /*$serial = $pdo->lastInsertId();
                    var_dump($pdo->lastInsertId());
                    echo $serial;*/
                    $stmt=$pdo->query("SELECT word FROM opinion where date=(select MAX(date) from opinion where email='jafrinalo@gmail.com')");

      
        
                    echo "<table >";
                    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            
                        echo "<tr><td>";
                        echo(htmlentities($row['word']));
                        echo("</td></tr>");
                    }
                    echo "</table>";

                    if(isset($_POST['prev_r'])){
                    show_result('.......@email');
                    }
                ?>
                
                <p></p>
                <form method="POST">
                <input type ="submit" class="btn btn-primary" name="prev_r" value="Previous Quotes">
                </form>
            </div>
            <div class="col-md-6 right">
                <h2>Poor Bro once said:</h2>
                <p></p>
                <input type ="submit" class="btn btn-primary" name="prev_p" value="Previous Quotes">
            </div>
            </div>
        </div>
        
    </body>
</html>

<?php
require_once "pdo.php";

function today_quote($pdo,$email){
    $stmt=$pdo->query("SELECT `word` FROM `opinion` where date=(select MAX(`date`) from `opinion` where email='$email')");
  
    echo "<table >";
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

        echo "<tr><td>";
        echo(htmlentities($row['word']));
        echo("</td></tr>");
    }
    echo "</table>";

}
function show_result($pdo,$email){
    
    
$stmt=$pdo->query("SELECT `word`,`date` FROM `opinion` where email='$email' ORDER BY Id DESC");


echo "<table border='1'>";
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

echo "<tr><td>";
echo(htmlentities($row['word']));
echo("</td></tr>");
echo("<tr><td style='text-align:right' width='40%'>");
echo(htmlentities($row['date']));
echo("</td></tr>");
}
echo "</table>";
   }

?>
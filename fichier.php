
<?php
require("phpMQTT.php");
$server = "10.0.10.77";
$port = 1883;
$username = "snir";
$password = "passsnir";
$client_id = "lamah";
$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if (!$mqtt->connect(true, NULL, $username, $password)) {
 exit(1);
}
$topics["ha/_temperature2"] = array("qos" => 0, "function" => "procmsg");
$topics["ha/pressure"] = array("qos" => 0, "function" => "procmsg");
$topics["ha/humidity"] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);
while ($mqtt->proc()) {
}
$mqtt->close();
function procmsg($topic, $value)
{
 echo($topic. " ".$value."\n");
 
 $servername = "localhost";
 $username = "snir";
 $password = "snir";
 $dbname = "meteo";

 if($topic=="ha/_temperature2")
{
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) { 
        die("Echec de la connexion: " . $conn->connect_error); 
    } 
    $sql = "INSERT IGNORE INTO Temperature (temp) VALUES ('$value')";
    

    if ($conn->query($sql) === TRUE) {
        echo "Nouvel enregistrement réussi ";
       } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
       }
}

if($topic=="ha/pressure")
{
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT IGNORE INTO Pressure (press) VALUES ('$value')";
    if ($conn->connect_error) { 
        die("Echec de la connexion: " . $conn->connect_error); 
    } 

    if ($conn->query($sql) === TRUE) {
        echo "Nouvel enregistrement réussi ";
       } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
       }
}

if($topic=="ha/humidity")
{
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT IGNORE INTO Humidity (hum) VALUES ('$value')";
    if ($conn->connect_error) { 
        die("Echec de la connexion: " . $conn->connect_error); 
    } 

    if ($conn->query($sql) === TRUE) {
        echo "Nouvel enregistrement réussi ";
       } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
       }
}
}
?>


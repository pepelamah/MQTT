<?php

$servername = "localhost";
 $username = "snir";
 $password = "snir";
 $dbname = "meteo";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql1 = "SELECT temp FROM Temperature ORDER BY id_temp DESC LIMIT 1"; 
$result = $conn->query($sql1);
 
if ($result->num_rows >0) 
{ 
    while($row = $result->fetch_assoc()) { 
        echo $row["temp"]."<br>"; 
    }
} 

$sql2 = "SELECT hum FROM Humidity ORDER BY id_hum DESC LIMIT 1"; 
$result = $conn->query($sql2);
 
if ($result->num_rows >0) 
{ 
    while($row = $result->fetch_assoc()) { 
        echo $row["hum"]."<br>"; 
    }
} 

$sql3 = "SELECT press FROM Pressure ORDER BY id_press DESC LIMIT 1"; 
$result = $conn->query($sql3);
 
if ($result->num_rows >0) 
{ 
    while($row = $result->fetch_assoc()) { 
        echo $row["press"]."<br>"; 
    }
} 




//fermer la connexion 
$conn->close();

?>
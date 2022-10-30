<?php


$username = 'root';
$password = 'rootpass';
$dsn1 = 'mysql:host=192.168.3.6;dbname=formresponses';  # [Update]
$dsn2 = 'mysql:host=192.168.3.7;dbname=formresponses';  # [Update]

try{
	$db1 = new PDO($dsn1, $username, $password); # [Update]
	$result=FALSE;

    $query = "SELECT * FROM response";

    $stmt1 = $db1->query($query); # [Update]

    $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);


    # ======= DB server 1 ======= #
    echo "<h2> DB server1 </h2>
    <table border='1'>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>email</th>
    </tr>";
    foreach($rows1 as $row) {
        echo "<tr>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "</tr>";

        //printf("{$row['firstname']} {$row['secondname']} {$row['email']}\n");
    }
    
    
} catch(PDOException $ex) {
	echo $ex->getMessage();
}

echo "</table>";


try{
    $db2 = new PDO($dsn2, $username, $password); # [Update]
	$result=FALSE;

    $query = "SELECT * FROM response";

    $stmt2 = $db2->query($query); # [Update]
    $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

 

    # ======= DB server 2 ======= #
    echo "</table><h2> DB Server2 </h2>
    <table border='1'>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>email</th>
    </tr>";
4
    foreach($rows2 as $row) {
        echo "<tr>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "</tr>";

        //printf("{$row['firstname']} {$row['secondname']} {$row['email']}\n");
    }
 
} catch(PDOException $ex) {
	echo $ex->getMessage();
}

echo "</table>";


?>

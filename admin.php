<?php
header('Content-Type: application/json');

$user= 'root';
$pass='';
$db='antrenor';

$con = new mysqli ('localhost', $user, $pass, $db) or die("Conectare nereusita");

session_start();


$sql="INSERT INTO clienti(nume, prenume, kg, inaltime,varsta) VALUES(?, ?,?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param('sssss', $_POST['nume'], $_POST['prenume'], $_POST['kg'], $_POST['cm'], $_POST['varsta']);
$stmt->execute();

$sql="SELECT id_client FROM clienti WHERE nume = ? AND prenume = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('ss', $_POST['nume'], $_POST['prenume']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


$sql1="INSERT INTO evolutie(cm, id_client,kg, data) VALUES(?,?,?,?)";

$stmt1 = $con->prepare($sql1);

$stmt1->bind_param('ssss', $_POST['cm'], $row['id_client'], $_POST['kg'], $_POST['data_intrare']);

$stmt1->execute();

echo $row['id_client'];

$stmt1->close();


?>

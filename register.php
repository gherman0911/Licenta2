<?php

$user= 'root';
$pass='';
$db='antrenor';

$con= new mysqli ('localhost', $user, $pass, $db) or die("Conectare nereusita");

session_start();



if ( !isset($_POST['username'], $_POST['password']) ) {

	exit('Please fill both the username and password fields!');
}
$sql="INSERT INTO login(nume, prenume, username, password) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param('ssss', $_POST['name'], $_POST['firstname'], $_POST['username'], $_POST['password']);
$stmt->execute();

$sql="SELECT id FROM login WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


$sql="INSERT INTO user_roles(user_id, role_id) VALUES (?, 1)";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $row["id"]);
$stmt->execute();
$stmt->close();

?>

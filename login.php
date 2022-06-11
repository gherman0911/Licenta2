<?php

$user= 'root';
$pass='';
$db='antrenor';

$con= new mysqli ('localhost', $user, $pass, $db) or die("Conectare nereusita");

session_start();



if ( !isset($_POST['username'], $_POST['password']) ) {

	exit('Please fill both the username and password fields!');
}

$sql="SELECT id, nume, prenume, username, password FROM login WHERE username = ?";

$stmt = $con->prepare($sql); //pregateste valorile din sql si baza de date le stocheaza fara a le executa
$stmt->bind_param('s', $_POST['username']);
$stmt->execute(); //se executa instructiunea
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$password=$row['password'];
$nume=$row['nume'];
$prenume=$row['prenume'];

if ($_POST['password'] == $password) {
	$sql_role="SELECT r.id as id, r.role as role FROM roles r JOIN user_roles ur ON ur.role_id = r.id WHERE ur.user_id = ?";
	$stmt = $con->prepare($sql_role);
	$stmt->bind_param('s', $row['id']);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	echo $row['role']."_".$nume."_".$prenume;

} else {
	echo 'Parola si/sau username gresite!';
}

	$stmt->close();

?>

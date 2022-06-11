<?php
$user= 'root';
$pass='';
$db='antrenor';

$con= new mysqli ('localhost', $user, $pass, $db) or die("Conectare nereusita");
session_start();

$username= $_POST['username'];
$sql = "SELECT c.id_client, c.nume, c.prenume, c.varsta, c.kg, c.inaltime, e.data, e.kg, e.cm
         FROM clienti c
         JOIN evolutie e
         ON c.id_client = e.id_client
         WHERE c.nume = ? OR c.prenume = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('ss', $_POST['username'],  $_POST['username']);
$stmt->execute();
$result = $stmt->get_result();
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<table border='2' align='center'><tr><th>nume</th><th>prenume</th><th>varsta</th><th>kg(+/-)</th><th>cm(+/-)</th><th>data</th></tr>";
foreach ($data as $row) {

    echo "<tr><td>".$row["nume"]."</td><td>".$row["prenume"].
    " </td><td>".$row["varsta"]."</td><td>".$row["kg"]."</td><td>".$row["cm"]."</td><td>".$row["data"]."</td>

    </tr>";
}
  echo "</table>";

$con->close();

?>

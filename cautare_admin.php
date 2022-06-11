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

echo "<table border='2' align='center'><tr><th>nume</th><th>prenume</th><th>varsta</th><th>kg(+/-)</th><th>cm(+/-)</th><th>data</th><th>Actiuni</th></tr>";
foreach ($data as $row) {

    echo "<tr><td>".$row["nume"]."</td><td>".$row["prenume"].
    " </td><td>".$row["varsta"]."</td><td>".$row["kg"]."</td><td>".$row["cm"]."</td><td>".$row["data"]."</td>
    <td><button class='program' id=".$row["id_client"]."_".$row["nume"]."_".$row["prenume"].
    " data-toggle='modal' data-target='#addEvolutie'>Adauga evolutie</button></td>
    </tr>";
}
  echo "</table>";

$con->close();

?>
<!-- Modal -->
<div class="modal fade" id="addEvolutie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adauga Evolutie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="nume" placeholder="nume"/>
        <input type="text" name="prenume" placeholder="prenume"/>
        <!-- <input type="text" name="varsta" placeholder="varsta"/> -->
        <input type="text" name="kg" placeholder="kilograme"/>
        <input type="text" name="cm" placeholder="cm"/>
        <input type="text" name="data_intrare" placeholder="data"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="save" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

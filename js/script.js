(function() {

function addEventListeners() {
  if(document.getElementById("add")) document.getElementById("add").addEventListener("click", addClient);
  if(document.getElementById("save")) document.getElementById("save").addEventListener("click", addEvolutie);

  const btnsProgramare = Array.from(document.getElementsByClassName("program"));

  btnsProgramare.forEach(btnProgramare => {

     btnProgramare.addEventListener('click', function handleClick(event) {

      adaugaEvolutie(event.target.getAttribute("id"));
    });
  });
}
function adaugaEvolutie(data) {
  const dataArr = data.split("_");

  const nume = document.querySelectorAll('[name="nume"]')[0];
  const prenume = document.querySelectorAll('[name="prenume"]')[0];

  nume.value = dataArr[1];
  prenume.value = dataArr[2];

}
function addClient() {
  const nume = document.querySelectorAll('[name="nume"]')[0];
  const prenume = document.querySelectorAll('[name="prenume"]')[0];
  const kg = document.querySelectorAll('[name="kg"]')[0];
  const cm = document.querySelectorAll('[name="cm"]')[0];
  const varsta = document.querySelectorAll('[name="varsta"]')[0];
  $.ajax({
    type: "POST",
    url: 'http://localhost/admin.php',
    dataType: 'json',
    data: {nume: nume.value, prenume: prenume.value, kg: kg.value, cm: cm.value, varsta: varsta.value, data_intrare: "", entity: 'add'},
    complete: function() {
      nume.value = "";
      prenume.value = "";
      kg.value = "";
      cm.value = "";
      varsta.value = "";
    }
  });
}
function addEvolutie() {
  const nume = document.querySelectorAll('[name="nume"]')[0].value;
  const prenume = document.querySelectorAll('[name="prenume"]')[0].value;
  const kg = document.querySelectorAll('[name="kg"]')[0].value;
  const cm = document.querySelectorAll('[name="cm"]')[0].value;
  // const varsta = document.querySelectorAll('[name="varsta"]')[0].value;
  const data_intrare = document.querySelectorAll('[name="data_intrare"]')[0].value;

  $.ajax({
    type: "POST",
    url: 'http://localhost/admin.php',
    dataType: 'json',
    data: {nume, prenume, kg, cm, data_intrare, entity: 'add'},
    complete: function() {
      nume = "";
      prenume = "";
      kg = "";
      cm = "";
      // varsta = "";
      data_intrare = "";
    }
  });

  $('#addEvolutie').modal('toggle');
  location.reload();
}

addEventListeners();



})()

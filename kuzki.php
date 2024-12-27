<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kužki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="CSS/Stil.css" rel="stylesheet">
</head>
<body>
<?php
      include("Includes/navigacija.php");
?>

<?php
session_start(); 

if (!isset($_SESSION['uporabnik_id'])) {
    header("Location: prijava.php");
    exit;
}
echo "Dobrodošli, " . htmlspecialchars($_SESSION['ime']) . "!";
echo "<br><a href='odjava.php'>Odjava</a>";
?>

<div class="container ozadje_diva pisava_glavna">
    <div class="row">
        <h1 class="naslovTeme" align="left"><b>Naši kužki</b></h1><br><br>
        <div class="col-6">
<?php

$conn = mysqli_connect("localhost", "root", "", "sprehajalecpsov");

if ($conn->connect_error) {
    die("Povezava ni uspela: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['odstrani_psa'])) {
    $IzbrisanPes = $_POST['odstrani_psa'];
    $deleteSql = "DELETE FROM KUZA WHERE id_kuza = $IzbrisanPes";

    if ($conn->query($deleteSql) === TRUE) {
        echo "<div class='alert alert-success'>Kužek je bil uspešno odstranjen!</div>";
    } else {
        echo "<div class='alert alert-danger'>Napaka pri odstranjevanju kužka: " . $conn->error . "</div>";
    }
}

function PodatkiPsov($conn) {
    $sql = "
        SELECT 
            k.id_kuza,
            k.ime AS ime_pes,
            k.datumRojstva AS rojstvo_pes,
            k.barva,
            k.stCipa,
            p.pasma,
            s.kolicinaSprehodov,
            s.casPrvegaSprehoda,
            h.imeHrane,
            h.stObrokov,
            post.vrstaPosteljice,
            soba.stSobe
        FROM 
            KUZA k
        JOIN PASMA p ON k.TK_pasma = p.id_pasma
        JOIN SPREHOD s ON k.TK_sprehod = s.id_sprehod
        JOIN HRANJENJE h ON k.TK_hranjenje = h.id_hranjenje
        JOIN POSTELJICA post ON k.TK_posteljica = post.id_posteljica
        JOIN SOBA soba ON post.TK_soba = soba.id_soba
    ";

    $result = $conn->query($sql);
    $PesPodatki = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $PesPodatki[] = $row;
        }
    }

    return $PesPodatki;
}

$psi = PodatkiPsov($conn);

function IzpisPsov($pesPodatek) {
    echo "<div class='p-3 mb-3'>";
    echo "<strong>Podatki o psu:</strong><br>";
    echo "ID: " . $pesPodatek["id_kuza"] . "<br>";
    echo "Ime: " . $pesPodatek["ime_pes"] . "<br>";
    echo "Datum rojstva: " . $pesPodatek["rojstvo_pes"] . "<br>";
    echo "Barva: " . $pesPodatek["barva"] . "<br>";
    echo "Številka čipa: " . $pesPodatek["stCipa"] . "<br>";
    echo "Pasma: " . $pesPodatek["pasma"] . "<br>";
    echo "Sprehodi na dan: " . $pesPodatek["kolicinaSprehodov"] . "<br>";
    echo "Čas prvega sprehoda: " . $pesPodatek["casPrvegaSprehoda"] . "<br>";
    echo "Hrana: " . $pesPodatek["imeHrane"] . "<br>";
    echo "Število obrokov: " . $pesPodatek["stObrokov"] . "<br>";
    echo "Vrsta posteljice: " . $pesPodatek["vrstaPosteljice"] . "<br>";
    echo "Številka sobe: " . $pesPodatek["stSobe"] . "<br>";

    if (isset($_SESSION['vloga']) && $_SESSION['vloga'] === 'admin') {
        echo "
            <form method='POST' action='' id='deleteForm_".$pesPodatek["id_kuza"]."' class='d-inline'>
                <input type='hidden' name='odstrani_psa' value='" . htmlspecialchars($pesPodatek["id_kuza"]) . "'>
                <button type='button' class='btn btn-danger mt-2 deleteButton' data-pesid='".$pesPodatek["id_kuza"]."'>Odstrani</button>
            </form>
        ";
    }

    echo "<form method='POST' action='prenesi_pdf.php'>
        <input type='hidden' name='id_kuza' value='" . htmlspecialchars($pesPodatek["id_kuza"]) . "'>
        <button type='submit' class='btn btn-primary mt-2'>Prenesi PDF</button>
    </form>";
    echo "</div>";
}

if (!empty($psi)) {
    foreach ($psi as $pes) {
        IzpisPsov($pes);
    }
} else {
    echo "<strong>V bazi ni podatkov o psih.</strong>";
}
?>

    </div>

    <a align="center" href="dodajanje.php" target="_blank"><button type="button" class="dodajanje">Dodaj Kužka</button></a>
    <div class="col-6">
    
    </div>
  </div>
</div>


<div class="modal" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Potrditev brisanja</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Ste prepričani, da želite izbrisati tega kužka?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Izbriši</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {

        $('.deleteButton').click(function() {
            var pesId = $(this).data('pesid');
            $('#confirmationModal').modal('show'); 

         
            $('#confirmDelete').click(function() {
                
                $('#deleteForm_' + pesId).submit();
            });
        });
    });
</script>

</body>
</html>

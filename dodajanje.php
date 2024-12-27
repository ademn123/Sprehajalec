<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Kužka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/Stil.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
</head>
<body>

<?php
      include("Includes/navigacija.php");
    ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Dodaj Kužka</h1>
    <?php
  
    $conn = new mysqli("localhost", "root", "", "sprehajalecpsov");

    if ($conn->connect_error) {
        die("Povezava ni uspela: " . $conn->connect_error);
    }

   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ime = $_POST['ime'];
        $datumRojstva = $_POST['datumRojstva'];
        $barva = $_POST['barva'];
        $stCipa = $_POST['stCipa'];
        $pasma = $_POST['pasma'];
        $posteljica = $_POST['posteljica'];
        $sprehajalec = $_POST['sprehajalec'];
        $sprehod = $_POST['sprehod'];
        $hranjenje = $_POST['hranjenje'];

    
        $sql = "INSERT INTO KUZA (ime, datumRojstva, barva, stCipa, TK_pasma, TK_posteljica, TK_sprehajalec, TK_sprehod, TK_hranjenje)
                VALUES ('$ime', '$datumRojstva', '$barva', '$stCipa', '$pasma', '$posteljica', '$sprehajalec', '$sprehod', '$hranjenje')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Kuža je bil uspešno dodan!</div>";
        } else {
            echo "<div class='alert alert-danger'>Napaka pri dodajanju kužka: " . $conn->error . "</div>";
        }
    }


    function vecOpcij($conn, $table, $idPolje, $ime) {
        $sql = "SELECT $idPolje, $ime FROM $table";
        $result = $conn->query($sql);
        $opcije = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $opcije[] = $row;
            }
        }
        return $opcije;
    }

    $OpcijePasem = vecOpcij($conn, "PASMA", "id_pasma", "pasma");
    $OpcijePosteljic = vecOpcij($conn, "POSTELJICA", "id_posteljica", "vrstaPosteljice");
    $OpcijeSprehajalcev = vecOpcij($conn, "SPREHAJALEC", "id_sprehajalec", "ime");
    $OpcijeHrane = vecOpcij($conn, "HRANJENJE", "id_hranjenje", "imeHrane");
    $OpcijeSprehodov = vecOpcij($conn, "SPREHOD", "id_sprehod", "kolicinaSprehodov");
    ?>

    <form method="POST" action="">
     
        <div class="mb-3">
            <label for="ime" class="form-label">Ime:</label>
            <input type="text" class="form-control" id="ime" name="ime" required>
        </div>
        <div class="mb-3">
            <label for="datumRojstva" class="form-label">Datum rojstva:</label>
            <input type="date" class="form-control" id="datumRojstva" name="datumRojstva" required>
        </div>
        <div class="mb-3">
            <label for="barva" class="form-label">Barva:</label>
            <input type="text" class="form-control" id="barva" name="barva" required>
        </div>
        <div class="mb-3">
            <label for="stCipa" class="form-label">Številka čipa:</label>
            <input type="number" class="form-control" id="stCipa" name="stCipa" required>
        </div>

        
        <div class="mb-3">
            <label for="pasma" class="form-label">Pasma:</label>
            <select class="form-select" id="pasma" name="pasma" required>
                <?php foreach ($OpcijePasem as $option) {
                    echo "<option value='{$option['id_pasma']}'>{$option['pasma']}</option>";
                } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="posteljica" class="form-label">Posteljica:</label>
            <select class="form-select" id="posteljica" name="posteljica" required>
                <?php foreach ($OpcijePosteljic as $option) {
                    echo "<option value='{$option['id_posteljica']}'>{$option['vrstaPosteljice']}</option>";
                } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="sprehajalec" class="form-label">Sprehajalec:</label>
            <select class="form-select" id="sprehajalec" name="sprehajalec" required>
                <?php foreach ($OpcijeSprehajalcev as $option) {
                    echo "<option value='{$option['id_sprehajalec']}'>{$option['ime']}</option>";
                } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="sprehod" class="form-label">Sprehod:</label>
            <select class="form-select" id="sprehod" name="sprehod" required>
                <?php foreach ($OpcijeSprehodov as $option) {
                    echo "<option value='{$option['id_sprehod']}'>{$option['kolicinaSprehodov']}</option>";
                } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="hranjenje" class="form-label">Hranjenje:</label>
            <select class="form-select" id="hranjenje" name="hranjenje" required>
                <?php foreach ($OpcijeHrane as $option) {
                    echo "<option value='{$option['id_hranjenje']}'>{$option['imeHrane']}</option>";
                } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj kužka</button>
    </form>
    <br><br><br>
</div>
</body>
</html>

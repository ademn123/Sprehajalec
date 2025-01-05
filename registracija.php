<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="CSS/Stil.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 600px;
        }
        .registracijski-obrazec {
            background: #fcf2c5;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .registracijski-obrazec h1 {
            font-size: 25px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
      include("Includes/navigacija.php");
    ?>

<div class="center-container">
    <div class="registracijski-obrazec">
        <h1>Registracija</h1>
        <form action="registracija.php" method="POST" onsubmit="return preveriGesli()">
            <div class="mb-3">
                <label class="form-label">Ime</label>
                <input type="text" class="form-control" id="ime" name="ime" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email naslov</label>
                <input type="email" class="form-control" id="e-posta" name="e_posta" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Geslo</label>
                <input type="password" class="form-control" id="geslo" name="geslo" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Potrdi geslo</label>
                <input type="password" class="form-control" id="potrdi-geslo" name="potrdi_geslo" required>
            </div>
            <button type="submit" class="btn dodajanje w-100">Registriraj se</button>
        </form>
    </div>
</div>

<script>
    function preveriGesli() {
        const geslo = document.getElementById('geslo').value;
        const potrdiGeslo = document.getElementById('potrdi-geslo').value;
        const gesloVzorec = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;

        if (!gesloVzorec.test(geslo)) {
            alert('Geslo mora vsebovati najmanj 8 znakov, eno veliko črko, eno številko in en poseben znak.');
            return false;
        }

        if (geslo !== potrdiGeslo) {
            alert('Gesli se ne ujemata. Prosimo, poskusite znova.');
            return false;
        }

        return true;
    }
</script>


<?php
$host = "localhost"; 
$dbname = "sprehajalecpsov"; 
$username = "root";  
$password = "";       


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Napaka pri povezovanju z bazo: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ime = trim($_POST["ime"]);
    $email = trim($_POST["e_posta"]);
    $geslo = trim($_POST["geslo"]);
    $potrdiGeslo = trim($_POST["potrdi_geslo"]);


    if ($geslo !== $potrdiGeslo) {
        die("Gesli se ne ujemata. Poskusite znova.");
    }


    $hashedGeslo = password_hash($geslo, PASSWORD_BCRYPT);


    try {
        $sql = "INSERT INTO UPORABNIKI (ime,email, geslo) VALUES (:ime, :email, :geslo)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":ime", $ime);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":geslo", $hashedGeslo);
        $stmt->execute();

        echo "Registracija uspešna! Sedaj se lahko <a href='prijava.php'>prijavite</a>.";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "Email naslov je že registriran. Poskusite znova z drugim emailom.";
        } else {
            echo "Napaka pri registraciji: " . $e->getMessage();
        }
    }
}
?>

</body>
</html>

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
        .registracija-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }
        .registracija-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
      include("Includes/navigacija.php");
    ?>

<div class="center-container">
    <div class="registracijski-obrazec">
        <h1>Prijava</h1>
        <form action="prijava.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Email naslov</label>
                <input type="email" class="form-control" id="e-posta" name="e_posta" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Geslo</label>
                <input type="password" class="form-control" id="geslo" name="geslo" required>
            </div>

            <button type="submit" class="btn dodajanje w-100">Prijavi se</button>
        </form>
     
        <a href="registracija.php" class="registracija-link">Še nimate računa? Registrirajte se.</a>
    </div>
</div>
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
    $email = trim($_POST["e_posta"]);
    $geslo = trim($_POST["geslo"]);

    try {
        $sql = "SELECT id, email, geslo, ime, vloga FROM UPORABNIKI WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $uporabnik = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($uporabnik && password_verify($geslo, $uporabnik['geslo'])) {
            session_start();
            $_SESSION['uporabnik_id'] = $uporabnik['id'];
            $_SESSION['email'] = $uporabnik['email'];
            $_SESSION['ime'] = $uporabnik['ime'];
            $_SESSION['vloga'] = $uporabnik['vloga'];

            // Izpis pozdrava glede na vlogo
            echo "Prijava uspešna! Dobrodošli, " . htmlspecialchars($uporabnik['ime']) . ".";
            if ($uporabnik['vloga'] === 'admin') {
                echo " Imate administratorske pravice.";
            }
            echo "<br><a href='index.php'>Pojdi na začetno stran</a>";
        } else {
            echo "Napačen email ali geslo. Poskusite znova.";
        }
    } catch (PDOException $e) {
        echo "Napaka pri prijavi: " . $e->getMessage();
    }
}

?>

</body>
</html>

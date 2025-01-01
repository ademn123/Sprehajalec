<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="CSS/Stil.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
    session_start();

    if (!isset($_SESSION['uporabnik_id'])) {
        header("Location: prijava.php");
        exit;
    }

    include("Includes/navigacija.php");
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h1 class="display-4">Pozdravljeni, <?php echo htmlspecialchars($_SESSION['ime']); ?>!</h1>
            <p class="lead mt-4">Dobrodošli na vaši profilni strani.</p>
            <div class="mt-4">
                <a href="odjava.php" class="btn btn-danger btn-lg">Odjava</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>

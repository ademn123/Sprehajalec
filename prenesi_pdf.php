<?php
$conn = mysqli_connect("localhost", "root", "", "sprehajalecpsov");

if ($conn->connect_error) {
    die("Povezava ni uspela: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_kuza'])) {
    $idKuza = intval($_POST['id_kuza']);

    $sql = "SELECT * FROM KUZA WHERE id_kuza = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idKuza);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pesPodatek = $result->fetch_assoc();
        generatePDF($pesPodatek);
    } else {
        echo "Kužek z ID-jem $idKuza ne obstaja.";
    }
} else {
    echo "Neveljavna zahteva.";
}
?>

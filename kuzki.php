<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kužki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="CSS/Stil.css" rel="stylesheet">
</head>
<body>
<?php include("Includes/navigacija.php"); ?>

<?php
session_start();

if (!isset($_SESSION['uporabnik_id'])) {
    header("Location: prijava.php");
    exit;
}

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

function PodatkiPsov($conn, $sprehajalec = '') {
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
            soba.stSobe,
            sp.ime AS ime_sprehajalec,
            sp.priimek AS priimek_sprehajalec
        FROM 
            KUZA k
        JOIN PASMA p ON k.TK_pasma = p.id_pasma
        JOIN SPREHOD s ON k.TK_sprehod = s.id_sprehod
        JOIN HRANJENJE h ON k.TK_hranjenje = h.id_hranjenje
        JOIN POSTELJICA post ON k.TK_posteljica = post.id_posteljica
        JOIN SOBA soba ON post.TK_soba = soba.id_soba
        JOIN SPREHAJALEC sp ON k.TK_sprehajalec = sp.id_sprehajalec
    ";

    if ($sprehajalec) {
        $sql .= " WHERE k.TK_sprehajalec = '" . $conn->real_escape_string($sprehajalec) . "'";
    }

    $result = $conn->query($sql);
    $PesPodatki = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $PesPodatki[] = $row;
        }
    }

    return $PesPodatki;
}

$sprehajalec = isset($_POST['sprehajalec']) ? $_POST['sprehajalec'] : '';
$psi = PodatkiPsov($conn, $sprehajalec);

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
    echo "Sprehajalec: " . $pesPodatek["ime_sprehajalec"] . " " . $pesPodatek["priimek_sprehajalec"] . "<br>";

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

$sprehajalci = $conn->query("SELECT id_sprehajalec, ime, priimek FROM SPREHAJALEC");
?>

<div class="container ozadje_diva pisava_glavna">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="" class="mb-4">
                <label for="sprehajalec" class="form-label">Filtriraj po sprehajalcu:</label>
                <select name="sprehajalec" id="sprehajalec" class="form-select" onchange="this.form.submit()">
                    <option value="">Vsi sprehajalci</option>
                    <?php while ($row = $sprehajalci->fetch_assoc()): ?>
                        <option value="<?php echo $row['id_sprehajalec']; ?>" <?php echo $sprehajalec == $row['id_sprehajalec'] ? 'selected' : ''; ?>>
                            <?php echo $row['ime'] . " " . $row['priimek']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </form>
        </div>

        <h1 class="naslovTeme" align="left"><b>Naši kužki</b></h1><br><br>
        <div class="col-6">
            <?php
            if (!empty($psi)) {
                foreach ($psi as $pes) {
                    IzpisPsov($pes);
                }
            } else {
                echo "<strong>V bazi ni podatkov o psih.</strong>";
            }
            ?>
        </div>
        <div class="d-flex justify-content-center mt-4">
    <a href="dodajanje.php" target="_blank">
        <button type="button" class="dodajanje">Dodaj Kužka</button>
    </a>
</div>

    </div>
    
</div>

<!-- Modal za potrditev -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Potrditev izbrisa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Ali ste prepričani, da želite izbrisati tega kužka?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Potrdi</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let currentFormId;

        $('.deleteButton').click(function() {
            currentFormId = $(this).data('pesid');
            $('#confirmationModal').modal('show');
        });

        $('#confirmDelete').click(function() {
            if (currentFormId) {
                $('#deleteForm_' + currentFormId).submit();
                currentFormId = null;
            }
        });
    });
</script>
</body>
</html>

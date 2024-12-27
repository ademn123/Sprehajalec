<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="CSS/Stil.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
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
      <article>

      <div class="container ozadje_diva pisava_glavna">
      <div class="row">
        <h1 class="naslovTeme" align="left"><b>Pozdravljeni!</b></h1><br><br>
        <div class="col-6">
        Dobrodošli na naši spletni strani za ljubitelje psov in sprehajalce! 🐾
        <br><br><br>
Z veseljem vas pozdravljamo na platformi, ki je namenjena vsem, ki si želijo še boljše izkušnje pri sprehajanju psov in skrbi za svoje štirinožne prijatelje. Naša spletna stran je zasnovana z mislijo na vas in vašega psa, da bi olajšali organizacijo in povečali užitek pri vsakodnevnih sprehodih.
<br>
Na tej strani lahko vsak pasji lastnik in sprehajalec:
🐕 Pregleda informacije o psu – Vse pomembne podatke o vašem psu, kot so navade, najljubše poti, prehranske potrebe ali posebnosti pri vedenju, lahko enostavno vnesete in spremljate na enem mestu. To omogoča, da vsak sprehajalec popolnoma razume vašega psa in mu zagotovi najboljšo možno nego med sprehodom.
<br>
📋 Organizira sprehode – Če svojega psa zaupate profesionalnim sprehajalcem ali prijateljem, se lahko prepričate, da so vse informacije dostopne in jasne. Na ta način bo vsak sprehod potekal brezskrbno in v skladu s potrebami vašega ljubljenčka.
<br>
🌟 Deli svoje izkušnje – Sprehajalci lahko pustijo povratne informacije o tem, kako je potekal sprehod, kaj je psa posebej razveselilo, ali pa delijo prisrčne trenutke v obliki fotografij ali opomb.
<br>
💼 Vzpostavi stik z drugimi sprehajalci – Naša stran omogoča tudi povezovanje s skupnostjo. Poiščite izkušene sprehajalce v bližini ali postanite del mreže, kjer si lahko med seboj izmenjujete nasvete in priporočila.
<br>
Verjamemo, da je vsak pes edinstven in si zasluži posebno pozornost. Naša platforma je tukaj, da omogoči še boljše razumevanje med lastniki, sprehajalci in psi, hkrati pa gradi varno in prijazno okolje za vse udeležence.
<br>
Hvala, da ste z nami – skupaj bomo poskrbeli za srečne sprehode in zadovoljne pasje tačke! 🐾
Če imate kakršna koli vprašanja ali potrebujete pomoč pri uporabi strani, nas lahko vedno kontaktirate.
        </div>
        <div class="col-6">
          <img src="Images/korgi.jpg" class="slika_racunalnik" alt="SlikaRacunalnika">
        </div>
      </div>
    </div>
    </article>


    
</body>
</html>

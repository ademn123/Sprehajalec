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

?>
      <article>

      <div class="container ozadje_diva pisava_glavna">
      <div class="row">
        <h1 class="naslovTeme" align="left"><b>Pozdravljeni!</b></h1><br><br>
        <div class="col-12">
        <p>Dobrodošli v zavetišču za kužke, kjer je vsak pes ljubljen in oskrbljen kot del naše družine!</p>

<p>Naše zavetišče je edinstveno zato, ker zagotavljamo topel, varen in ljubeč prostor za pse, ki iščejo svoj nov dom. Nahajamo se na mirni lokaciji na obrobju mesta, kjer so naši štirinožni prijatelji obkroženi z naravo, svežim zrakom in prostornimi ograjenimi dvorišči, kjer se lahko sprostijo, igrajo in uživajo v svojih dnevnih aktivnostih.</p>

<p>Naš cilj je, da vsak pes, ki vstopi v naše zavetišče, prejme vse, kar potrebuje, da se počuti ljubljenega in varnega. S pomočjo našega usposobljenega osebja zagotavljamo, da so vsi psi deležni visoke ravni skrbi in pozornosti. Vsak pes je edinstven, zato prilagodimo naš pristop glede na njihove specifične potrebe in značilnosti.</p>

<p><strong>Prostor, ki ga ponujamo našim kužkom, je prostoren in udoben.</strong> Zavetišče je opremljeno z različnimi nastanitvami, ki so prilagojene potrebam psov različnih velikosti in temperamentov. Imamo posebej oblikovane boksove za manjše pse, kot tudi večje prostore za srednje in velike pse, ki potrebujejo več prostora za gibanje. Vsak prostor je opremljen s toplo posteljo, svežo vodo in dostopom do zunanjega prostora, kjer se lahko igrajo in raziskujejo.</p>

<p><strong>Zdravje naših kužkov je naša prednostna naloga.</strong> Naša veterinarska ekipa natančno spremlja zdravje vseh psov in skrbi za redne preglede, cepljenja, razglistenje in splošno zdravstveno oskrbo. Prav tako imamo posebne programe, ki pomagajo tistim psom, ki so preživeli travme ali so imeli težave z adaptacijo v preteklosti. Naš cilj je, da vsak pes v zavetišču postane bolj samozavesten in srečen, preden najde svoj nov dom.</p>

<p>Poleg osnovne oskrbe, kot so prehrana in zdravje, se naši kužki vsakodnevno ukvarjajo s številnimi dejavnostmi, ki jim pomagajo razvijati svoje socialne veščine in fizično kondicijo. Našim psom omogočamo redne sprehode po slikovitih poteh v okolici zavetišča, kjer se lahko srečajo z drugimi psi in spoznavajo nove vonjave in okolje. Na voljo so jim tudi različne igre in zabavni treningi, ki jim pomagajo krepiti svojo telesno pripravljenost in izboljšati njihovo obnašanje.</p>

<p><strong>V našem zavetišču ne gre le za oskrbo psov, ampak tudi za iskanje trajnega doma za vsakogar izmed njih.</strong> Naš tim skrbnikov in prostovoljcev vsakodnevno išče najboljše rešitve za vsakega psa, bodisi da gre za posvojitev, bodisi za morebitne začasne rešitve, kot je začasna oskrba, dokler ne najdemo pravega posvojitelja. Naša ekipa se zelo trudi pri usklajevanju posvojitev, saj želimo, da vsak pes najde ljubeč dom, kjer bo preživel srečno življenje.</p>

<p><strong>Naše poslanstvo je tudi izobraževanje javnosti o odgovornem lastništvu psov in podpori zavetiščem.</strong> Organiziramo različne dogodke, kjer ozaveščamo o pomenu sterilizacije, cepljenja, in zagotavljanja oskrbe za živali v stiski. Verjamemo, da vsak pes zasluži dostojno življenje, ne glede na to, ali je bil najden na ulici ali je bil zavržen zaradi različnih razlogov.</p>

<p><strong>Lokacija našega zavetišča je prav tako ključna za naš uspeh.</strong> Naši prostori so zasnovani tako, da so vsakodnevne naloge enostavne in učinkovite, hkrati pa omogočajo vsakemu psu, da dobi potrebno pozornost. Imamo številne odprte površine, kjer se naši kužki lahko prosto gibajo, obenem pa so vsi prostori varni in zaščiteni z ograjami, ki preprečujejo pobeg in zagotavljajo varnost vseh živali.</p>

<p><strong>Zakaj izbrati naše zavetišče?</strong><br>
- Imamo več kot 10-letne izkušnje pri oskrbi psov, tako mladičev kot odraslih psov.<br>
- Naša ekipa je usposobljena in strastna do svojega dela, kar omogoča najboljšo možno oskrbo za vse pse.<br>
- Naš prostor je zasnovan z mislijo na dobrobit psov – ponujamo prostrane in udobne nastanitve.<br>
- Ponosni smo na svoje rezultate pri iskanju novih domov za naše kužke in se trudimo, da vsak pes najde ljubeč dom.<br>
- Naše zavetišče je odprto za obiskovalce, ki želijo spoznati naše pse in morda celo posvojiti svojega novega najboljšega prijatelja.</p>

<p><strong>Obiščite nas in spoznajte naše pse.</strong> Kljub temu, da smo zavetišče, verjamemo, da so vsi naši kužki edinstveni in zaslužijo ljubezen in pozornost, ki jim pripada. Pridružite se naši misiji in pomagajte nam, da bo svet bolj prijazen za pse v stiski!</p>

        </div>
        <div class="col-12">
          <img src="Images/banner.jpg">
        </div>
      </div>
    </div>
    </article>


    
</body>
</html>

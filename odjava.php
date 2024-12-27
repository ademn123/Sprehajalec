<?php
session_start(); // Začnemo sejo
session_unset(); // Počistimo vse podatke v seji
session_destroy(); // Uniči sejo
header("Location: prijava.php"); // Preusmerimo nazaj na prijavo
exit;
?>

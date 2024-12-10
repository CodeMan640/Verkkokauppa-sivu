<?php
require 'session_start.php';
$_SESSION['logout_success'] = true; // Aseta istuntomuuttuja uloskirjautumisilmoitusta varten


session_start(); // Aloita uusi istunto
session_unset(); // Poista kaikki istuntomuuttujat
session_destroy(); // Tuhoa istunto

session_start(); // Aloittaa uuden istunnon uudelleen säilyttääkseen ilmoituksen
$_SESSION['logout_success'] = true; // Asettaa viestin uudelleen uudessa istunnossa
header("Location: index.php"); // Uudelleenohjaus index.php-sivulle
exit();
?>

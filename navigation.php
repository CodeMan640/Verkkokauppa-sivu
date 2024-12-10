<?php
require 'session_start.php'; // Ensure session is started properly

function setActive($page) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page == $page ? 'active' : '';
}
?>
<div class="topnav">
    <div class="left-links">
        <a class="<?php echo setActive('index.php'); ?>" href="index.php">Etusivu</a>
        <a class="<?php echo setActive('Verkkokauppa.php'); ?>" href="Verkkokauppa.php">Verkkokauppa</a>
    </div>
    
    <?php if(isset($_SESSION['email'])): ?>
        <a class="<?php echo setActive('logout.php'); ?>" href="logout.php">Kirjaudu ulos</a>
    <?php else: ?>
        <a class="<?php echo setActive('login.php'); ?>" href="login.php">Kirjaudu sisään</a>
    <?php endif; ?>
    
    <a href="ostoskori.php" class="<?php echo setActive('ostoskori.php'); ?> cart-link">
        <img src="assets/icon.png" alt="Ostoskori" class="cart-icon">
    </a>
</div>

<section>
    <a href="index.php">Katalog</a><br/>
    <a href="kosik.php">Kosik</a><br/>
    <a href="objednavky.php">Objednavky</a><br/>    
    <?php
    if (isset($_SESSION['isLoged']) && $_SESSION['isLoged']) {
        echo '<a href="phpFiles/odhlaseni.php">Odhlaseni</a>';
    }
    
    ?>
</section>
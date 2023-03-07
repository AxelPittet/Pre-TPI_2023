<?php
ob_start();
?>



        <h2 id="titre_1">
            Bienvenue sur ce restaurant
        </h2>


<?php
$content = ob_get_clean();
require "gabarit.php";
?>
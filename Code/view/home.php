<?php
ob_start();
?>


    <div class="place-content-center bg-cover bg-center h-screen text-center content-center"
         style="background-image: url(view/img/pates.jpg)">
        <div class="hero min-h-screen">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <a href="index.php?action=showPlates">
                        <button class="btn btn-primary">Show plates</button>
                    </a>
                </div>
            </div>
        </div>
    </div>


<?php
$content = ob_get_clean();
require "gabarit.php";
?>
<?php
ob_start();
?>


    <div class="place-content-center bg-cover bg-center h-screen text-center content-center" style="background-image: url(view/img/pates.jpg)">
        <div class="">
            <a href="index.php?action=showPlates">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 cent">Show Plates</button>
            </a>
        </div>
    </div>



<?php
$content = ob_get_clean();
require "gabarit.php";
?>
<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 28.03.2023
 */

ob_start();
?>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
            <div class="w-screen">
                <h1 class="text-5xl font-bold">Admin functions</h1>
                <div class="divider"></div>
                <a href="index.php?action=admin&adminFunction=users&usersFunction=add">
                    <button class="btn btn-primary">Add user</button>
                </a>
                <div class="divider-vertical"></div>
                <a href="index.php?action=admin&adminFunction=users&usersFunction=modify">
                    <button class="btn btn-primary">Modify user</button>
                </a>
                <div class="divider-vertical"></div>
                <a href="index.php?action=admin&adminFunction=users&usersFunction=delete">
                    <button class="btn btn-primary">Delete user</button>
                </a>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
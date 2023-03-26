<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 21.03.2023
 */

session_start();
require "controller/controller.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            home();
            break;
        case 'register' :
            register($_POST);
            break;
        case 'login' :
            login($_POST);
            break;
        case 'logout' :
            logout();
            break;
        case 'intolerances' :
            intolerances($_POST);
            break;
        case 'showPlate' :
            showPlate();
            break;
        case 'cart' :
            cart();
            break;
        case 'addToCart' :
            addToCart($_POST);
            break;
        case 'removeFromCart' :
            removeFromCart();
            break;
        default :
            home();
    }
} else {
    home();
}
<?php

session_start();
require "controller/controller.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            home();
            break;
        case 'showPlates' :
            showPlates();
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
        default :
            home();
    }
} else {
    home();
}
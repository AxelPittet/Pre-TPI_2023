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
        default :
            home();
    }
} else {
    home();
}
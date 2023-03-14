<?php

function getIntolerances()
{
    $sql = "SELECT * FROM intolerances";
    require_once "model/dbconnector.php";
    $intolerances = executeQuerySelect($sql);
    return $intolerances;
}
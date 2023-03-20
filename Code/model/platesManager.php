<?php

function getPlates()
{
    $getIntolerancesQuery = "SELECT * FROM plates";
    require_once "model/dbconnector.php";
    $intolerances = executeQuerySelect($getIntolerancesQuery);
    return $intolerances;
}
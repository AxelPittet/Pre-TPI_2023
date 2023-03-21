<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 21.03.2023
 */


/**
 * This function is designed to return the values of the table plates in the database in an array
 * @return array|null : get the values of the query result
 */
function getPlates()
{
    $getIntolerancesQuery = "SELECT * FROM plates";
    require_once "model/dbconnector.php";
    $intolerances = executeQuerySelect($getIntolerancesQuery);
    return $intolerances;
}
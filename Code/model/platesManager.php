<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 26.03.2023
 */


/**
 * This function is designed to return the values of the table plates in the database in an array
 * @return array|null : get the values of the query result
 */
function getPlates()
{
    $getPlatesQuery = "SELECT * FROM plates";
    require_once "model/dbconnector.php";
    $plates = executeQuerySelect($getPlatesQuery);
    return $plates;
}


function getSpecificPlate($plateId)
{
    $getSpecificPlateId = "SELECT * FROM plates WHERE id = '$plateId'";
    require_once "model/dbconnector.php";
    $specificPlate = executeQuerySelect($getSpecificPlateId);
    return $specificPlate;
}


function getPlatesResearch($plateResearch){
    $getPlatesResearchQuery = "SELECT * FROM plates WHERE name LIKE '%$plateResearch%'";
    require_once "model/dbconnector.php";
    $platesResearch = executeQuerySelect($getPlatesResearchQuery);
    return $platesResearch;
}
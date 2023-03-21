<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 21.03.2023
 */


/**
 * This function is designed to return the values of the intolerances table in the database in an array
 * @return array|null : get the values of the query result
 */
function getIntolerances()
{
    $getIntolerancesQuery = "SELECT * FROM intolerances";
    require_once "model/dbconnector.php";
    $intolerances = executeQuerySelect($getIntolerancesQuery);
    return $intolerances;
}

/**
 * This function is designed to return the values of the user_select_intolerances table in the database which where saved by the connected user, in an array.
 * @param $userId : must contain the id of the user which is currently logged in
 * @return array|null : get the values of the query result
 */
function getUserIntolerances($userId){
    $getUserIntolerancesQuery = "SELECT * FROM users_select_intolerances WHERE user_id = '$userId'";
    require_once "model/dbconnector.php";
    $userIntolerances = executeQuerySelect($getUserIntolerancesQuery);
    return $userIntolerances;
}

/**
 * This function is designed to save a user intolerance choice in the database
 * @param $userId : must contain the id of the user which is currently logged in
 * @param $intoleranceId : must contain the id of the intolerance which is going to be saved
 * @return bool|null
 */
function saveUserIntolerance($userId, $intoleranceId){
    $saveUserIntolerance = "INSERT INTO users_select_intolerances (user_id, intolerance_id) VALUES ('$userId', '$intoleranceId')";
    require_once 'model/dbconnector.php';
    $saveUserIntoleranceResult = executeQueryIUD($saveUserIntolerance);
    return $saveUserIntoleranceResult;
}


/**
 * This function is designed to delete a user intolerance choice in the database
 * @param $userId : must contain the id of the user which is currently logged in
 * @param $intoleranceId : must contain the id of the intolerance which is going to be deleted
 * @return bool|null
 */
function deleteUserIntolerance ($userId, $intoleranceId){
    $deleteUserIntolerance = "DELETE FROM users_select_intolerances WHERE user_id = '$userId' AND intolerance_id='$intoleranceId'";
    require_once 'model/dbconnector.php';
    $deleteUserIntoleranceResult = executeQueryIUD($deleteUserIntolerance);
    return $deleteUserIntoleranceResult;
}


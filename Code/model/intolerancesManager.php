<?php

function getIntolerances()
{
    $getIntolerancesQuery = "SELECT * FROM intolerances";
    require_once "model/dbconnector.php";
    $intolerances = executeQuerySelect($getIntolerancesQuery);
    return $intolerances;
}

function getUserIntolerances($userId){
    $getUserIntolerancesQuery = "SELECT * FROM users_select_intolerances WHERE user_id = '$userId'";
    require_once "model/dbconnector.php";
    $userIntolerances = executeQuerySelect($getUserIntolerancesQuery);
    return $userIntolerances;
}

function saveUserIntolerance($userId, $intoleranceId){
    $saveUserIntolerance = "INSERT INTO users_select_intolerances (user_id, intolerance_id) VALUES ('$userId', '$intoleranceId')";
    require_once 'model/dbconnector.php';
    $saveUserIntoleranceResult = executeQueryIUD($saveUserIntolerance);
    return $saveUserIntoleranceResult;
}

function deleteUserIntolerance ($userId, $intoleranceId){
    $deleteUserIntolerance = "DELETE FROM users_select_intolerances WHERE user_id = '$userId' AND intolerance_id='$intoleranceId'";
    require_once 'model/dbconnector.php';
    $deleteUserIntoleranceResult = executeQueryIUD($deleteUserIntolerance);
    return $deleteUserIntoleranceResult;
}


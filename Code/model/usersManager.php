<?php

/**
 * @param $userEmailAddress
 * @param $userPsw
 * @param $userFirstName
 * @param $userLastName
 * @param $userPhoneNumber
 * @return bool|null
 */
function registerNewAccount($userEmailAddress, $userPsw, $userFirstName, $userLastName, $userPhoneNumber)
{

    $userPswHash = password_hash($userPsw, PASSWORD_DEFAULT);
    $register = "INSERT INTO users (lastname, firstname, email, phonenumber, password, usertype) VALUES ('$userLastName', '$userFirstName', '$userEmailAddress', '$userPhoneNumber', '$userPswHash', 1)";

    require_once 'model/dbconnector.php';
    $registerResult = executeQueryIUD($register);

    return $registerResult;
}


/**
 * @param $userEmailAddress
 * @return int|mixed
 */
function getUserType($userEmailAddress) {
    $result = 1;

    $strSeparator = '\'';
    $getUserTypeQuery = 'SELECT usertype FROM users WHERE email =' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbconnector.php';
    $queryResult = executeQuerySelect($getUserTypeQuery);
    //echo $getUserTypeQuery;

    if (count($queryResult) == 1) {
        $result = $queryResult[0]['userType'];
    }

    return $result;
}
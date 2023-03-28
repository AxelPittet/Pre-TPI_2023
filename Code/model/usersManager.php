<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 21.03.2023
 */


/**
 * This function is designed to register a new user account in the database
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
 * This function is designed to return the type of the user which is currently logged in
 * @param $userEmailAddress
 * @return int|mixed : get the values of the query result
 */
function getUserType($userEmailAddress) {
    $result = 1;

    $strSeparator = '\'';
    $getUserTypeQuery = 'SELECT usertype FROM users WHERE email =' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbconnector.php';
    $queryResult = executeQuerySelect($getUserTypeQuery);

    if (count($queryResult) == 1) {
        $result = $queryResult[0]['userType'];
    }

    return $result;
}

/**
 * This function is designed to check if the values of the login form are matching with an exisiting user
 * @param $userEmailAddress
 * @param $userPsw
 * @return bool
 */
function isLoginCorrect($userEmailAddress, $userPsw)
{
    $result = false;

    $strSeparator = '\'';
    $loginQuery = 'SELECT * FROM users WHERE email = ' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuerySelect($loginQuery);

    if (count($queryResult) == 1) {
        $userHashPsw = $queryResult[0]['password'];
        if (password_verify($userPsw, $userHashPsw) == true) {
            $result = true;
        } else {
            $result = false;
        }
    } else {
        $result = false;
    }

    return $result;
}

/**
 * This function is designed to return the id of the user which is currently logged in.
 * @param $userEmailAddress
 * @return int|mixed : get the values of the query result
 */
function getUserId($userEmailAddress) {
    $result = 1;

    $strSeparator = '\'';
    $getUserIdQuery = 'SELECT id FROM users WHERE email =' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbconnector.php';
    $queryResult = executeQuerySelect($getUserIdQuery);

    if (count($queryResult) == 1) {
        $result = $queryResult[0]['id'];
    }

    return $result;
}

/**
 * This function is designed to return the values of the users table in the database in an array
 * @return array|null : get the values of the query result
 */
function getUsers(){
    $getUsersQuery = 'SELECT * FROM users';
    require_once "model/dbconnector.php";
    $users = executeQuerySelect($getUsersQuery);
    return $users;
}
    return $result;
}
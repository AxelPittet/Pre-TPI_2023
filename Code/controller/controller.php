<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 21.03.2023
 */


/**
 * This function is designed to display the "home" view
 * @return void
 */
function home()
{
    require_once "model/platesManager.php";
    $plates = getPlates();
    require "view/home.php";
}

function showPlates()
{
    home();
}

/**
 * This function is designed to register a new user.
 * @param $registerRequest : all values must be set and both passwords must be the same for the register to work. If passwords are not the same or the email is already exisiting, it will display an error message. If the values aren't all set, it will display the register form.
 * @return void
 */
function register($registerRequest)
{
//if a register request was submitted
    if (isset($registerRequest['inputUserEmailAddress']) && isset($registerRequest['inputUserPsw']) && isset($registerRequest['inputUserConfirmPsw'])
        && isset($registerRequest['inputUserFirstName']) && isset($registerRequest['inputUserLastName']) && isset($registerRequest['inputUserPhoneNumber'])) {

        $userFirstName = $registerRequest ['inputUserFirstName'];
        $userLastName = $registerRequest ['inputUserLastName'];
        $userPhoneNumber = $registerRequest ['inputUserPhoneNumber'];
        $userEmailAddress = $registerRequest['inputUserEmailAddress'];
        $userPsw = $registerRequest['inputUserPsw'];
        $userConfirmPsw = $registerRequest['inputUserConfirmPsw'];

        if ($userPsw == $userConfirmPsw) {
            require_once "model/usersManager.php";
            if (registerNewAccount($userEmailAddress, $userPsw, $userFirstName, $userLastName, $userPhoneNumber)) {
                $userType = getUserType($userEmailAddress);
                createSession($userEmailAddress, $userType);
                $registerErrorMessage = null;
                home();
            } else {
                $registerErrorMessage = "L'inscription n'est pas possible avec les valeurs saisies !";
                require "view/register.php";
            }
        } else {
            $registerErrorMessage = "Les mots de passe ne sont pas similaires !";
            require "view/register.php";
        }
    } else {
        $registerErrorMessage = null;
        require "view/register.php";
    }
}

/**
 * This function is designed to log in an exisiting user.
 * @param $loginRequest : all values must be set and must match with a user in the database for the user to be logged in. If it does not match, it will display an error message. If all the values aren't set, it will display the login form.
 * @return void
 */
function login($loginRequest)
{
//if a login request was submitted
    if (isset($loginRequest['inputUserEmailAddress']) && isset($loginRequest['inputUserPsw'])) {
        //extract login parameters
        $userEmailAddress = $loginRequest['inputUserEmailAddress'];
        $userPsw = $loginRequest['inputUserPsw'];
        //try to check if user/psw are matching with the database
        require_once "model/usersManager.php";
        if (isLoginCorrect($userEmailAddress, $userPsw)) {
            $userType = getUserType($userEmailAddress);
            createSession($userEmailAddress, $userType);
            $_GET['loginError'] = false;
            home();
        } else { //if the user/psw does not match, login form appears again
            $_GET['loginError'] = true;
            require "view/login.php";
        }
    } else { //the user does not yet fill the form
        require "view/login.php";
    }
}

/**
 * This function is designed to log out a user by resetting the $_SESSION variable
 * @return void
 */
function logout()
{
    session_destroy();
    header('LOCATION:/home');
}

/**
 * This function is designed create a session for a user after a login or register
 * @param $userEmailAddress : must contain the email that was used to log in or register
 * @param $userType : must contain an int which is equal to 1 if this is a normal user or 2 if this is an admin
 * @return void
 */
function createSession($userEmailAddress, $userType)
{
    $_SESSION['userEmailAddress'] = $userEmailAddress;
    $_SESSION['userType'] = $userType;
}

/**
 * This function is designed to save the intolerances choices of the user.
 * @param $intolerancesRequest : must be set for the choices of the user to be save. If the parameter is not set, it will display the intolerances form.
 * @return void
 */
function intolerances($intolerancesRequest)
{

    if (!empty($intolerancesRequest)) {
        foreach ($intolerancesRequest as $intoleranceRequest) {
            require_once "model/usersManager.php";
            $userId = getUserId($_SESSION['userEmailAddress']);
            require_once "model/intolerancesManager.php";
            deleteUserIntolerance($userId, $intoleranceRequest[0]);
            if (isset($intoleranceRequest[1])) {
                saveUserIntolerance($userId, $intoleranceRequest[0]);
            }
        }
        home();

    } else {
        require_once "model/usersManager.php";
        $userId = getUserId($_SESSION['userEmailAddress']);
        require_once "model/intolerancesManager.php";
        $intolerances = getIntolerances();
        $userIntolerances = getUserIntolerances($userId);
        require "view/intolerances.php";
    }

}
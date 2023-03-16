<?php

// Fonction qui permet d'afficher la page "home"
function home()
{
    require "view/home.php";
}

function showPlates()
{
    require "view/home.php";
}

// Fonction qui permet de créer un nouvel utilisateur
/**
 * @param array $registerRequest
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
                require "view/home.php";
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

// Fonction qui permet de connecter avec un les informations d'un utilisateurs déjà créé
/**
 * @param array $loginRequest
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
            require "view/home.php";
        } else { //if the user/psw does not match, login form appears again
            $_GET['loginError'] = true;
            require "view/login.php";
        }
    } else { //the user does not yet fill the form
        require "view/login.php";
    }
}

// Fonction qui permet de se déconnecter de la session ouverte
function logout()
{
    session_destroy();
    header('LOCATION:/home');
}

// Fonction qui permet de créer une nouvelle session
function createSession($userEmailAddress, $userType)
{
    $_SESSION['userEmailAddress'] = $userEmailAddress;
    $_SESSION['userType'] = $userType;
}

function intolerances($intolerancesRequest)
{

    if (!empty($intolerancesRequest)) {
        foreach ($intolerancesRequest as $intoleranceRequest) {
            require_once "model/usersManager.php";
            $userId = getUserId($_SESSION['userEmailAddress']);
            require_once "model/intolerancesManager.php";

            if ($intoleranceRequest[1] == 'on'){
                if (saveUserIntolerance($userId,$intoleranceRequest[0])){
                    require "view/home.php";
                }
            } else {
                if (deleteUserIntolerance($userId,$intoleranceRequest[0])){
                    require "view/home.php";
                }
            }
            require "view/home.php";
        }

    } else {
        require_once "model/usersManager.php";
        $userId = getUserId($_SESSION['userEmailAddress']);
        require_once "model/intolerancesManager.php";
        $intolerances = getIntolerances();
        $userIntolerances = getUserIntolerances($userId);
        require "view/intolerances.php";
    }

}
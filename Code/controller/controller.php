<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 27.03.2023
 */


/**
 * This function is designed to display the "home" view
 * @return void
 */
function home()
{
    require_once "model/usersManager.php";
    if (isset($_SESSION['userEmailAddress'])) {
        $userId = getUserId($_SESSION['userEmailAddress']);
    }
    require_once "model/platesManager.php";
    $plates = getPlates();
    require_once "model/intolerancesManager.php";
    $userIntolerances = getUserIntolerances($userId);
    $platesIntolerances = getPlatesIntolerances();

    require "view/home.php";
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

/**
 * This function is designed to display the information of the plate that the user clicked on it
 * @return void
 */
function showPlate()
{
    $plateId = $_GET['plateId'];
    require_once "model/platesManager.php";
    $plates = getPlates();
    require_once "model/intolerancesManager.php";
    $intolerances = getIntolerances();
    $platesIntolerances = getPlatesIntolerances();

    require "view/plate.php";
}

/**
 * This function is designed to display the cart of the user
 * @return void
 */
function cart()
{
    require "view/cart.php";
}

/**
 * This function is designed to add a specific plate to the cart of the user
 * @param $addToCartRequest : must contain the quantity of the plate that the user want to add to the cart
 * @return void
 */
function addToCart($addToCartRequest)
{
    if (!empty($addToCartRequest['plateQuantity'])) {
        require_once "model/platesManager.php";
        $specificPlate = getSpecificPlate($_GET['plateId']);
        $specificPlateArray = array($specificPlate[0]['name'] => array('id' => $specificPlate[0]['id'], 'name' => $specificPlate[0]['name'], 'quantity' => $addToCartRequest['plateQuantity'], 'price' => $specificPlate[0]['price']));

        if (!empty($_SESSION['cartItem'])) {
            if (in_array($specificPlate[0]['name'], array_keys($_SESSION['cartItem']))) {
                foreach ($_SESSION['cartItem'] as $k => $v) {
                    if ($specificPlate[0]['name'] == $k) {
                        if (empty($_SESSION['cartItem'][$k]['quantity'])) {
                            $_SESSION['cartItem'][$k]['quantity'] = 0;
                        }
                        $_SESSION['cartItem'][$k]['quantity'] += $addToCartRequest['plateQuantity'];
                    }
                }
            } else {
                $_SESSION['cartItem'] = array_merge($_SESSION['cartItem'], $specificPlateArray);
            }
        } else {
            $_SESSION['cartItem'] = $specificPlateArray;
        }
        cart();
    }
}

/**
 * This function is designed to remove a specific plate from the cart of the user
 * @return void
 */
function removeFromCart()
{
    if (!empty($_SESSION['cartItem'])) {
        foreach ($_SESSION['cartItem'] as $k => $v) {
            if ($_GET['plateName'] == $k)
                unset($_SESSION['cartItem'][$k]);
            if (empty($_SESSION['cartItem']))
                unset($_SESSION['cartItem']);
        }
        cart();
    }
}

/**
 * This function is designed to confirm an order of a user by saving it in the DB and sending a confirmation mail
 * @return void
 */
function confirmOrder(){
    require_once "model/usersManager.php";
    $userId = getUserId($_SESSION['userEmailAddress']);
    require_once "model/ordersManager.php";
    $orderId = saveOrder($userId);

    foreach ($_SESSION['cartItem'] as $k => $v) {
        saveOrderContent($_SESSION['cartItem'][$k]['quantity'], $_SESSION['cartItem'][$k]['id'], $orderId);
    }

    $msg = "First line of text\nSecond line of text";

    $msg = wordwrap($msg,70);

    mail($_SESSION['userEmailAddress'],"Confirmation de commande n°$orderId",$msg);

    unset($_SESSION['cartItem']);
    precedentsOrders();
}

/**
 * This function is designed to display the precedents orders the user has done
 * @return void
 */
function precedentsOrders(){
    if (empty($_GET['orderId'])) {
        require_once "model/usersManager.php";
        $userId = getUserId($_SESSION['userEmailAddress']);
        require_once "model/ordersManager.php";
        $ordersId = getUserOrdersId($userId);

        require "view/precedentsOrders.php";
    } else {

    }
}
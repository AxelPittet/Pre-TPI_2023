<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 27.03.2023
 */

/**
 * This function is designed to save the id and the user_id of the order in the database
 * @param $userId : must contain the id of the user which is currently logged in
 * @return mixed : get the id of the new order which was saved
 */
function saveOrder($userId){
    $saveOrderQuery = "INSERT INTO orders (user_id) VALUES ('$userId')";
    $getOrderIdQuery = "SELECT MAX(id) FROM orders WHERE user_id = '$userId'";

    require_once "dbconnector.php";
    executeQueryIUD($saveOrderQuery);
    $getOrderIdResult = executeQuerySelect($getOrderIdQuery);
    $orderId = $getOrderIdResult[0][0];

    return $orderId;
}

/**
 * This function is designed to save the content of a new order in the database
 * @param $quantity : must contain the number of times a plate was ordered
 * @param $plateId : must contain the id of a plate which is ordered
 * @param $orderId : must contain the id of the order which the content is being saved
 * @return bool|null
 */
function saveOrderContent($quantity, $plateId, $orderId){
    $saveOrderContentQuery = "INSERT INTO plates_contain_orders (quantity, plate_id, order_id) VALUES ('$quantity', '$plateId', '$orderId')";
    require_once "dbconnector.php";
    $saveOrderContentResult = executeQueryIUD($saveOrderContentQuery);
    return $saveOrderContentResult;
}

/**
 * This function is designed to return the ids of the orders the user done
 * @param $userId : must contain the id of the user which is currently logged in
 * @return array|null : get the ids of the orders done by the user which is currently logged in
 */
function getUserOrdersId($userId){
    $getUserOrdersIdQuery = "SELECT id FROM orders WHERE user_id = '$userId'";
    require_once "dbconnector.php";
    $getUserOrdersIdResult = executeQuerySelect($getUserOrdersIdQuery);
    return $getUserOrdersIdResult;
}

/**
 * This function is designed to return the items values of a specific order
 * @param $orderId : must contain the id of an order
 * @return array|null : get the items values of a specific order
 */
function getOrderItems($orderId){
    $getOrderItemsQuery = "SELECT * FROM plates_contain_orders WHERE order_id = '$orderId'";
    require_once "dbconnector.php";
    $getOrderItemsResult = executeQuerySelect($getOrderItemsQuery);
    return $getOrderItemsResult;
}
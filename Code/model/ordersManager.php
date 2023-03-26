<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 26.03.2023
 */


function saveOrder($userId){
    $saveOrderQuery = "INSERT INTO orders (user_id) VALUES ('$userId')";
    $saveOrderResult = executeQueryIUD($saveOrderQuery);
    return $saveOrderResult;
}
<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 27.03.2023
 */

ob_start();
?>


    <div class="min-h-screen bg-base-200">
    <div class="toast toast-start toast-middle">
        <ul class="menu bg-base-100 w-56 rounded-box">
            <li><a href="index.php?action=intolerances">Intolerances</a></li>
            <li class="bordered"><a href="index.php?action=precedentsOrders">Precedents orders</a></li>
            <li class="bg-error-content"><a href="index.php?action=logout">Logout</a></li>
        </ul>
    </div>
    <div class="divider-vertical"></div>
    <div class="divider-vertical"></div>
    <div class="divider-vertical"></div>
    <div class="divider-vertical"></div>

    <div class="hero min-h-screen bg-base-200 text-center">
        <div class="w-1/2">
            <h1 class="text-5xl font-bold">Precedents Orders</h1>
            <div class="divider"></div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                    <tr>
                        <th>Order id</th>
                        <th>Total Price</th>
                        <th>Show</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($ordersId as $orderId) :
                        $orderPrice = 0;
                        require_once "model/ordersManager.php";
                        $orderItems = getOrderItems($orderId['id']);
                        foreach ($orderItems as $orderItem) {
                            foreach ($plates as $plate) {
                                if ($plate['id'] == $orderItem['plate_id']) {
                                    $orderPrice += ($plate['price'] * $orderItem['quantity']);
                                }
                            }
                        }
                        ?>
                        <tr>
                            <th><?= $orderItem['order_id'] ?></th>
                            <td><?= $orderPrice ?></td>
                            <td><a href="index.php?action=precedentsOrders&orderId=<?= $orderItem['order_id'] ?>"
                                   class="btn btn-circle bg-base-100"><img src="view/img/search.png"
                                                                           alt="deleteImg"></a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="divider-vertical"></div>
    <div class="divider-vertical"></div>
    <div class="divider-vertical"></div>
    <div class="divider-vertical"></div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 28.03.2023
 */

ob_start();
?>

    <div class="hero min-h-screen bg-base-200">
        <div class="divider-vertical"></div>
        <div class="divider-vertical"></div>
        <div class="divider-vertical"></div>
        <div class="divider-vertical"></div>
        <div class="hero-content text-center">
            <div class="w-screen">
                <h1 class="text-5xl font-bold">Order <?= $_GET['orderId'] ?></h1>
                <div class="divider"></div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $orderPrice = 0;
                        foreach ($orderItems as $orderItem) :
                            foreach ($plates as $plate) :
                                $platePrice = 0;
                                if ($plate['id'] == $orderItem['plate_id']) :
                                    $platePrice += ($plate['price'] * $orderItem['quantity']);
                                    $orderPrice += ($plate['price'] * $orderItem['quantity']);
                                    ?>
                                    <tr>
                                        <th><?= $plate['name'] ?></th>
                                        <td><?= $plate['price'] . " CHF" ?></td>
                                        <td><?= $orderItem['quantity'] ?></td>
                                        <td><?= number_format($platePrice, 2) . " CHF" ?></td>
                                    </tr>
                                <?php
                                endif;
                            endforeach;
                        endforeach;
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total Price</th>
                            <td></td>
                            <td></td>
                            <th><?= number_format($orderPrice, 2) . " CHF" ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="divider-vertical"></div>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
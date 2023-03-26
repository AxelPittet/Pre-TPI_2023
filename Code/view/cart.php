<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 23.03.2023
 */

ob_start();
?>

<div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
        <div class="w-screen">
            <h1 class="text-5xl font-bold">Cart</h1>
            <div class="divider"></div>
            <div class="overflow-x-auto">
                <?php
                if (isset($_SESSION['cartItem'])):
                    $totalPrice = 0;
                    ?>
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total price</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($_SESSION['cartItem'] as $plate):
                            $platePrice = $plate['quantity'] * $plate['price'];
                            ?>
                            <tr>
                                <th><?= $plate['name'] ?></th>
                                <td><?= $plate['price'] . " CHF" ?></td>
                                <td><?= $plate['quantity'] ?></td>
                                <td><?= number_format($platePrice, 2) . " CHF" ?></td>
                                <td><a href="index.php?action=removeFromCart&plateId=<?= $plate['id'] ?>"
                                       class="btn btn-circle bg-base-100"><img src="view/img/delete.png"
                                                                               alt="deleteImg"></a></td>
                            </tr>
                            <?php
                            $totalPrice += ($plate['quantity'] * $plate['price']);
                        endforeach;
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total Price</th>
                            <td></td>
                            <td></td>
                            <th><?= number_format($totalPrice, 2) . " CHF" ?></th>
                        </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>
            <div class="divider-vertical"></div>
            <a>
                <button class="btn btn-primary">Order</button>
            </a>


        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
require "gabarit.php";
?>

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
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                    <tr>
                        <th>Plate 1</th>
                        <td>20</td>
                        <td>1</td>
                        <td>20</td>
                    </tr>
                    <!-- row 2 -->
                    <tr>
                        <th>Plate 2</th>
                        <td>15</td>
                        <td>2</td>
                        <td>30</td>
                    </tr>
                    <!-- row 3 -->
                    <tr>
                        <th>Plate 3</th>
                        <td>22</td>
                        <td>1</td>
                        <td>22</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Final Price</th>
                        <td></td>
                        <td></td>
                        <th>72 CHF</th>
                    </tr>
                    </tfoot>
                </table>
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

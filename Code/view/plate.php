<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 21.03.2023
 */

ob_start();
?>

<?php
foreach ($plates as $plate) :
    if ($plate['id'] == $plateId) :
        ?>
        <div class="hero min-h-screen bg-base-200">
            <div class="hero-content text-center">
                <div class="w-screen">
                    <h1 class="text-5xl font-bold"><?= $plate['name'] ?></h1>
                    <div class="divider"></div>
                    <div class="flex w-full">
                        <img src="<?= $plate['image'] ?>" alt="<?= $plate['name'] ?>" class="max-w-screen-sm rounded-lg shadow-2xl"/>
                        <div class="divider-horizontal"></div>
                        <div>
                            <p class="py-6"><?= $plate['description'] ?></p>
                            <div class="divider divider-vertical"></div>
                            <h6>Probables intolerances</h6>
                            <p class="py-4">Soja / produits laitiers / etc....</p>
                            <div class="divider divider-vertical"></div>
                            <div class="flex w-full">
                                <input class="input" type="number" min="1" max="999" step="1" value="1">
                                <div class="divider-horizontal"></div>
                                <?php
                                if (isset($_SESSION['userEmailAddress'])) :
                                    ?>
                                    <a>
                                        <button class="btn btn-primary">Add to the order</button>
                                    </a>
                                <?php
                                else:
                                    ?>
                                    <a href="index.php?action=register">
                                        <button class="btn btn-primary">Register to order</button>
                                    </a>
                                <?php
                                endif;
                                ?>
                                <div class="divider-horizontal"></div>
                                <label class="text-2xl font-bold"><?= $plate['price'] ?> CHF</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endif;
endforeach;
?>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
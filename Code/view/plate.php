<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 26.03.2023
 */

ob_start();
?>

<?php
foreach ($plates as $plate) :
    if ($plate['id'] == $plateId) :

        ?>
        <div class="hero min-h-screen bg-base-200">
            <form action="index.php?action=addToCart&plateId=<?= $plate['id'] ?>" method="post" class="hero-content text-center">
                <div class="w-screen">
                    <h1 class="text-5xl font-bold"><?= $plate['name'] ?></h1>
                    <div class="divider"></div>
                    <div class="flex w-full">
                        <img src="<?= $plate['image'] ?>" alt="<?= $plate['name'] ?>"
                             class="max-w-screen-sm rounded-lg shadow-2xl"/>
                        <div class="divider-horizontal"></div>
                        <div>
                            <p class="py-6"><?= $plate['description'] ?></p>
                            <div class="divider divider-vertical"></div>
                            <h6>Probables intolerances</h6>
                            <p class="py-4">
                                <?php
                                foreach ($platesIntolerances as $plateIntolerances) :
                                    if ($plate['id'] == $plateIntolerances['plate_id']) :
                                        foreach ($intolerances as $intolerance) :
                                            if ($intolerance['id'] == $plateIntolerances['intolerance_id']) :
                                                echo $intolerance['name'];
                                            endif;
                                        endforeach;
                                    endif;
                                endforeach;
                                ?>
                            </p>
                            <div class="divider divider-vertical"></div>
                            <div class="flex w-full">
                                <input name="plateQuantity" class="input" type="number" min="1" max="999" step="1" value="1">
                                <div class="divider-horizontal"></div>
                                <?php
                                if (isset($_SESSION['userEmailAddress'])) :
                                    ?>
                                        <button type="submit" class="btn btn-primary">Add to the order</button>
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
            </form>
        </div>
    <?php
    endif;
endforeach;
?>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
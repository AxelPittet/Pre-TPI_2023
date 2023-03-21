<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 21.03.2023
 */

ob_start();
?>

    <div class="place-content-center bg-cover bg-center h-screen text-center content-center"
         style="background-image: url(view/img/pates.jpg)">
        <div class="hero min-h-screen">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <a href="index.php?action=showPlates">
                        <button class="btn btn-primary">Show plates</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
            <div class="w-screen">
                <h1 class="text-5xl font-bold">Plates</h1>
                <div class="divider"></div>
                <?php
                $count = 0;

                foreach ($plates as $plate) :
                    $count += 1;
                    if ($count == 1) :
                        ?>
                        <div class="flex w-full">
                    <?php
                    endif;
                    ?>
                    <div class="card card-compact w-full bg-base-100 shadow-xl">
                        <figure><img src="<?= $plate['image'] ?>" alt="<?= $plate['name'] ?>" class=""/></figure>
                        <div class="card-body">
                            <h2 class="card-title"><?= $plate['name'] ?></h2>
                            <p><?= $plate['description'] ?></p>
                            <div class="card-actions justify-end">
                                <button class="btn btn-primary">Order Now !</button>
                            </div>
                        </div>
                    </div>
                    <div class="divider-horizontal"></div>
                    <?php
                    if ($count == 3) :
                        $count = 0;
                        ?>
                        </div>
                        <div class="divider-vertical"></div>
                    <?php endif;


                endforeach;
                if ($count != 0) : ?>
            </div>
            <?php endif; ?>
            <div class="divider-vertical"></div>
            <div class="divider-vertical"></div>
            <div class="divider-vertical"></div>
        </div>
    </div>


<?php
$content = ob_get_clean();
require "gabarit.php";
?>
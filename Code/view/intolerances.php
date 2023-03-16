<?php
ob_start();
?>

<div class="min-h-screen bg-base-200">
    <div class="toast toast-start toast-middle">
        <ul class="menu bg-base-100 w-56 rounded-box">
            <li class="bordered"><a href="index.php?action=intolerances">Intolerances</a></li>
            <li><a href="index.php?action=precedentsOrders">Precedents orders</a></li>
            <li class="bg-error-content"><a href="index.php?action=logout">Logout</a></li>
        </ul>
    </div>

    <div class="hero min-h-screen bg-base-200">
        <form action="index.php?action=intolerances" method="post" class="hero-content text-center">
            <div class="w-screen">
                <h1 class="text-5xl font-bold">Intolerances</h1>
                <div class="divider"></div>
                <?php
                $count = 0;

                foreach ($intolerances

                         as $intolerance) :


                    $count += 1;
                    if ($count == 1) :
                        ?>
                        <div class="flex w-full">
                    <?php
                    endif;
                    ?>
                    <div class="grid h-10 w-full card bg-base-300 rounded-box">
                        <label class="label cursor-pointer">
                            <span class="label-text"><?= $intolerance['name'] ?></span>
                            <input type="checkbox" class="checkbox checkbox-primary"
                                   name="inputIntolerance<?= $intolerance['id'] ?>"
                                   <?php foreach ($userIntolerances

                                   as $userIntolerance) : if ($userIntolerance['intolerance_id'] == $intolerance['id']) : ?>value="on" checked<?php else: ?> content="off" onsubmit=""
                            <?php endif;
                            endforeach;
                            ?>/>
                        </label>
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
            <div class="divider-vertical"></div>
            <?php endif; ?>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>

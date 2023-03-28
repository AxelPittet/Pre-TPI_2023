<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 28.03.2023
 */

ob_start();
?>

<div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
        <div class="w-screen">
            <h1 class="text-5xl font-bold">Modify user</h1>
            <div class="divider"></div>
            <div class="card-body">
                <form action="index.php?action=admin&adminFunction=users&usersFunction=modify" method="post">
                    <div class="form-control">
                        <label class="label" for="userEmail">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" placeholder="user@domain.com" class="input input-bordered"
                               name="inputUserEmailAddress" list="userEmailAdresses" required/>
                        <datalist id="userEmailAdresses">
                            <?php
                            foreach ($users as $user):
                                ?>
                                <option value="<?= $user['email'] ?>">
                            <?php
                            endforeach;
                            ?>
                        </datalist>
                    </div>
                    <div class="form-control mt-6">
                        <input type="submit" value="Modify the user" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>

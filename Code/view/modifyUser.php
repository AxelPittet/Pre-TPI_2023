<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 28.03.2023
 */

ob_start();
?>

<?php foreach ($user as $userInformations) :
    ?>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
            <div class="w-screen">
                <h1 class="text-5xl font-bold">Modify user : <?= $userInformations['email'] ?></h1>
                <div class="divider"></div>
                <div class="card-body">
                    <form action="index.php?action=admin&adminFunction=users&usersFunction=modify" method="post">
                        <input type="hidden" name="inputUserId" value="<?= $userInformations['id'] ?>">
                        <div class="form-control">
                            <label class="label" for="userFirstName">
                                <span class="label-text">First name</span>
                            </label>
                            <input type="text" placeholder="First name" class="input input-bordered"
                                   name="inputUserFirstName" value="<?= $userInformations['firstname'] ?>" required/>
                        </div>
                        <div class="form-control">
                            <label class="label" for="userLastName">
                                <span class="label-text">Last name</span>
                            </label>
                            <input type="text" placeholder="Last name" class="input input-bordered"
                                   name="inputUserLastName" value="<?= $userInformations['lastname'] ?>" required/>
                        </div>
                        <div class="form-control">
                            <label class="label" for="userPhoneNumber">
                                <span class="label-text">Phone number</span>
                            </label>
                            <input type="tel" placeholder="079 ... .. .." class="input input-bordered"
                                   name="inputUserPhoneNumber" value="<?= $userInformations['phonenumber'] ?>" required/>
                        </div>
                        <div class="form-control">
                            <label class="label" for="userEmail">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" placeholder="user@domain.com" class="input input-bordered"
                                   name="inputUserEmailAddress" value="<?= $userInformations['email'] ?>" required/>
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
endforeach;
?>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>

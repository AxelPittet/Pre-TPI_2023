<?php
/**
 * author : Axel Pittet
 * project : Pre-TPI 2023 - Res'Tolerances
 * date : 28.03.2023
 */

ob_start();
?>

<?php if (isset($loginErrorMessage)) : ?>
    <div class="alert alert-warning shadow-lg absolute h-6 w-1/2">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span><?= $loginErrorMessage ?></span>
        </div>
    </div>
<?php endif; ?>
<div class="hero min-h-screen bg-base-200">

    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold">Login</h1>
            <p class="py-6">If you do not have an account please click below.</p>
            <a href="index.php?action=register"><p class="">Register here !</p></a>
        </div>
        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="index.php?action=login" method="post">
                    <div class="form-control">
                        <label class="label" for="userEmail">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" placeholder="Email" class="input input-bordered"
                               name="inputUserEmailAddress" required/>
                    </div>
                    <div class="form-control">
                        <label class="label" for="userPsw">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" placeholder="Password" class="input input-bordered" name="inputUserPsw"
                               required/>
                    </div>
                    <div class="form-control mt-6">
                        <input type="submit" value="Login" class="btn btn-primary"/>
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

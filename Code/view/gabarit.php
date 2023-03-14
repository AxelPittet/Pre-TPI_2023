<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/view/css/output.css" rel="stylesheet">
    <title>Restaurant</title>
</head>

<body>

<!-- main-menu Start -->
<header>
    <div class="absolute navbar bg-base-100">
        <div class="flex-1">
            <a href="index.php?action=home" class="btn btn-ghost normal-case text-xl">Res'Tolerances</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <?php if (isset($_SESSION['userEmailAddress'])) : ?>
                <li>
                    <div class="form-control">
                        <input type="text" placeholder="Search" class="input input-bordered"/>
                    </div>
                </li>
                <li tabindex="1">
                    <a>
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="view/img/Default_pfp.png"/>
                            </div>
                        </label>
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                        </svg>
                    </a>
                    <ul class="p-2 bg-base-100">
                        <li><a>Intolerances</a></li>
                        <li><a>Precedent orders</a></li>
                        <li><a>Logout</a></li>
                        <li><a href="index.php?action=logout">Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="index.php?action=login">Login</a></li>
                <li><a href="index.php?action=register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header><!-- /.top-area-->

<!-- main-menu End -->
<div class="content">
    <?= $content; ?>
</div>

<!-- footer-copyright start -->
<footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="index.php?action=home"
                                                                                    class="hover:underline">Restaurant™</a>. All Rights Reserved.
    </span>
</footer>
<!-- footer-copyright end -->

</body>
</html>
<?php
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
            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                <figure><img src="view/img/Search.png" alt="Shoes"/></figure>
                <div class="card-body">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="divider-horizontal"></div>
            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                <figure><img src="view/img/Search.png" alt="Shoes"/></figure>
                <div class="card-body">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="divider-horizontal"></div>
            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                <figure><img src="view/img/Search.png" alt="Shoes"/></figure>
                <div class="card-body">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/home.css"> <!-- home style-->
    <link rel="stylesheet" href="styles/navbar.css"> <!-- navbar style -->
    <title>Document</title>
</head>
<body>
    <section class="container" id="cont1">
        <script src="script.js"></script>
        <div class="slogan-cont">
            <h1 id="slogan">TEA <span>GOODNESS</span> IN A CUP</h1>
            <img src="styles/img/nihon.svg" alt="text" id="hiragana-txt">
            <button id="selections" onclick="scrollToSelections()">Explore our Selections</button>
        </div>
    </section>
    <section class="container" id="about">
        <article>
            <h1>I Love Milk Tea, where passion meets refreshment!</h1>
            <p>Beyond the beverages, I Love Milk Tea is a community—a gathering place for friends, family, and tea lovers alike. Our cozy and welcoming spaces are designed to create memorable moments and foster connections over a shared love for the perfect cup of tea.</p>
            <h2>Visit I❤️Milktea store near you and grab your refreshing authentic pearl milktea today!</h2>
            <p>Like us on<a href="https://www.facebook.com/ilovemilkteasilang">facebook</a>and keep watching out for our exciting new flavors.</p>
        </article>
        <div class="bg"></div>
    </section>
    <section class="container" id="cont2">
        <div class="products">
            <div class="image-cont">
                <h1>Our Products</h1>
                <hr>
                <h2>I Love Milktea offers an extensive selection of delightful beverages.</h2>
                <div class="flavor-cont">
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/milktea.png">
                        <h3>Milktea</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/rock salt cheese.png" alt="product-img">
                        <h3>RockSalt Cheese</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/cream puff.png" alt="product-img">
                        <h3>Cream Puff</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/choco puff.png" alt="product-img">
                        <h3>Choco Puff</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/brown sugar.png" alt="product-img">
                        <h3>Brown Sugar</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/cheesecake.png" alt="product-img">
                        <h3>Cheesecake</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/hot drinks.png" alt="product-img">
                        <h3>Hot Drinks</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/fruit tea.png" alt="product-img">
                        <h3>Fruit Tea</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/yogurt tea.png" alt="product-img">
                        <h3>Popping Yogurt Tea</h3>
                    </div>
                    <div class="flavor" id="f1">
                        <img src="styles/img/products/frappe.png" alt="product-img">
                        <h3>Frappe</h3>
                    </div>
                </div>
                <div class="bttn-cont">
                    <button type="button" id="order-now" onclick="goToMenu()">View our Full Menu</button>
                </div>
            </div>
        </div>
        <div class="slideshow-cont">
            <div class="slides-cont">
                <img src="styles/img/posters/1.jpg" alt="" class="slides">
                <img src="styles/img/posters/2.jpg" alt="" class="slides">
                <img src="styles/img/posters/3.png" alt="" class="slides">
                <img src="styles/img/posters/4.jpg" alt="" class="slides">
                <img src="styles/img/posters/5.jpg" alt="" class="slides">
                <img src="styles/img/posters/6.png" alt="" class="slides">
                <img src="styles/img/posters/7.png" alt="" class="slides">
                <img src="styles/img/posters/8.jpg" alt="" class="slides">
                <img src="styles/img/posters/9.png" alt="" class="slides">
                <img src="styles/img/posters/10.jpg" alt="" class="slides">
                <img src="styles/img/posters/11.jpg" alt="" class="slides">
                <img src="styles/img/posters/12.jpg" alt="" class="slides">
                <img src="styles/img/posters/13.jpg" alt="" class="slides">
                <img src="styles/img/posters/14.jpg" alt="" class="slides">
            </div>
        </div>
    </section>
    <section class="container" id="cont4">
        <div class="cont-img">
            <img src="styles/img/ilovemilktea logo.png" alt="ilovemilktealogo" id="logo">
            <h1>There's nothing better than Milk Tea</h1>
            <img src="styles/img//melkti and prends.png" alt="img" id="melkti_prends">
            <h1>while you enjoy with your friends!</h1>
        </div>
        <div class="cont1">
            <form action="send.php" method="post">
                <h1>We'd love to hear from you</h1>
                <p>Fields marked with an <span>*</span> are required</p>
                <input type="text" name="name" id="name" required placeholder="*Name">
                <input type="email" name="email" id="email" required placeholder="*Email">
                <textarea name="message" id="message" cols="30" rows="10"  required placeholder="*Message"></textarea>
                <button type="submit" id="btn" name="feedback">SUBMIT</button>
            </form>
        </div>
    </section>
    <script>
        var myIndex = 0;
        carousel();
    
        function carousel() {
            var i;
            var x = document.getElementsByClassName("slides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1;
            }
            // Get the currently displayed image
            var currentImage = x[myIndex - 1];
            // Access the alt attribute of the currently displayed image
            var altText = currentImage.alt;
            let container2 = document.getElementById('cont2');
            let img_cont = document.getElementById('img-cont');
            let bg = "url('img/Milktea\ Wallpaper\ 3.jpg')";
            x[myIndex-1].style.display = "block";
            console.log("Alt Attribute for the currently displayed image: " + altText);
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }
        function scrollToSelections(){
            document.getElementById('cont2').scrollIntoView({
                behavior: 'smooth'
            });
        }
        function goToMenu(){
            window.location.href = "allmenu.php";
        }
    </script>
</body>
</html>
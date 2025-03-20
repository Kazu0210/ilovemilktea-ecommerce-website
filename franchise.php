<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Angkor&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/stylefranchise.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <title>Franchise Inquiry</title>
</head>
<body>
    <section class="container" id="cont1">
        <script src="script.js"></script>
        <h1 id="title">Franchise Opportunities</h1>
            <div class="cont2">
                <div class="img-cont">
                    <img src="styles/img/franchise.png" alt="franchies opportunities img">
                </div>
                
                <form action="send.php" method="post">
                    <h1>Inquire About Franchising</h1>
                    <p>Fields marked with an <span>*</span> are required</p>
                    <input type="text" name="name" id="name" placeholder="*Name">
                    <input type="text" name="phone" id="phone" placeholder="*Phone">
                    <input type="email" name="email" id="email" placeholder="*Email">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="*Message"></textarea>
                    <button type="submit" name="inquire">Inquire</button>
                </form>
            </div>
    </section>

</body>
</html>
document.addEventListener("DOMContentLoaded", function() {

    function createNavItem(text, href) {
        let li = document.createElement('li');
        let a = document.createElement('a');

        a.href = href;
        a.textContent = text;
        li.appendChild(a);
        return li;
    }

    function createNavItemWithImage(href, imgSrc, altText) {
        let li = document.createElement('li');
        let a = document.createElement('a');
        let img = document.createElement('img');

        a.href = href;
        img.src = imgSrc;
        img.alt = altText;
        img.className = "icon";
        a.appendChild(img);
        li.appendChild(a);

        return li;
    }

    function createImage(src) {
        let img = document.createElement('img');
        img.src = src;
        return img;
    }

    let cont1 = document.getElementById('cont1');
    let navbar = document.createElement('div');
    let nav = document.createElement('nav');
    let ul1 = document.createElement('ul');
    let homeLink = createNavItem('Home', 'home.php');
    let menuLink = createNavItem('Menu', 'allmenu.php');
    let franchiseLink = createNavItem('Franchise', 'franchise.php');
    let aboutLink = createNavItem('About', '#');
    let iLoveMilkteaLogo = createImage('styles/img/ilovemilktea logo.png');
    iLoveMilkteaLogo.id = "logo";
    iLoveMilkteaLogo.alt = "ilovemilktealogo";
    let ul2 = document.createElement('ul');

    let userIcon = document.createElement('button'); // user-icon button type
    userIcon.style.backgroundImage = 'styles/img/user.png';
    
    //let user = createNavItemWithImage('checklogin.php', 'styles/img/user.png', 'user-icon'); // user icon
    let bag = createNavItemWithImage('order.php', 'styles/img/bag.png', 'bag-icon'); // bag icon

    aboutLink.addEventListener('click', function() {
        
        if(window.location.pathname !== '/home.php'){
            window.location.href = "home.php";
            document.getElementById('about').scrollIntoView({
                behavior: 'smooth'
            });
        }

    });

    // Add classes and attributes
    navbar.className = "navbar";
    navbar.id = "navbar";

    // Append elements to the document
    navbar.appendChild(nav);
    nav.appendChild(ul1);
    ul1.appendChild(homeLink);
    ul1.appendChild(menuLink);
    ul1.appendChild(franchiseLink);
    ul1.appendChild(aboutLink);
    navbar.appendChild(iLoveMilkteaLogo);
    navbar.appendChild(ul2);
    ul2.appendChild(user);
    ul2.appendChild(bag);

    cont1.appendChild(navbar);
});
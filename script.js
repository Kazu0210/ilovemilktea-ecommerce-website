function createNavbar() {
    function createImage(imageSource) {
        let img = document.createElement('img');
        img.src = imageSource;
        return img;
    }

    function createNavItem(text, href) {
        let listItem = document.createElement('li');
        let a = document.createElement('a');

        a.href = href;
        a.textContent = text;
        listItem.appendChild(a);
        return listItem;
    }

    function createIconWithImage(id, imageSrc) {
        let list = document.createElement('li');
        let optionsCont = document.createElement('div');
        optionsCont.id = 'optionsCont';
        let button = document.createElement('button');
    
        button.id = id;
        button.style.width = '1.25rem';
        button.style.height = '1.25rem';
        button.style.backgroundSize = 'cover';
        button.style.backgroundImage = `url('${imageSrc}')`;
        button.style.border = 'none';
        button.style.cursor = 'pointer';
        button.style.backgroundColor = 'rgba(255, 255, 255, 0)';
    
        list.appendChild(optionsCont);
        optionsCont.appendChild(button);
    
        return list;
    }

    function createImageButton(imageSrc, buttonId) {
        let button = document.createElement('button');
        button.id = buttonId;
        button.style.width = '1.25rem';
        button.style.height = '1.25rem';
        button.style.backgroundSize = 'cover';
        button.style.backgroundImage = `url('${imageSrc}')`;
        button.style.border = 'none';
        button.style.cursor = 'pointer';
        button.style.backgroundColor = 'rgba(255, 255, 255, 0)';
        return button;
    }

    function createNavbarLink(text, href, id) {
        let link = createNavItem(text, href);
        link.id = id;
        links.appendChild(link);
    }

    // container1
    let cont1 = document.getElementById('cont1');
    // Create and append the navbar
    const navbar = document.createElement('div');
    navbar.id = "navbar";
    cont1.appendChild(navbar);
    // create ilovemilktea logo
    let logo = createImage('styles/img/ilovemilktea logo.png');
    logo.id = 'logo';
    logo.alt = 'ilovemilktea logo';
    navbar.appendChild(logo);
    // create nav
    let nav = document.createElement('nav');
    navbar.appendChild(nav);
    // create link container
    let links = document.createElement('ul');
    nav.appendChild(links);
    // create links
    createNavbarLink('Home', 'home.php');
    createNavbarLink('Menu', 'menu.php');
    createNavbarLink('Franchise', 'franchise.php');
    createNavbarLink('About', '#', 'aboutLink');

    let aboutLink = document.getElementById('aboutLink');
    aboutLink.addEventListener('click', function(){
        let page = window.location.pathname;
        let pathInfo = page.split('/').pop();
        let fileNameWithoutExtension = pathInfo.split('.').slice(0, -1).join('.');
        let Capitalized_Title = fileNameWithoutExtension.charAt(0).toUpperCase() + fileNameWithoutExtension.slice(1);
        let pageName = Capitalized_Title.replace(/-/g, ' ');

        if (pageName !== 'Home') {
            // Redirect to 'home.php'
            window.location.href = 'home.php';
        } else {
            // Scroll to the 'about' element smoothly
            document.getElementById('about').scrollIntoView({
                behavior: 'smooth'
            });
        }


    });

    // user options container
    let userOptions = document.createElement('div');
    userOptions.id = 'userOptions';
    navbar.appendChild(userOptions);

    let accountButton = createImageButton('styles/img/user.png', 'account-bttn'); // account button
    accountButton.className = 'icons';

    let bagButton = createImageButton('styles/img/bag.png', 'bag-bttn'); // bag button
    bagButton.className = 'icons';

    userOptions.appendChild(accountButton);
    userOptions.appendChild(bagButton);

    function createCustomElement(elementType, elementID, elementClass){
        let div = document.createElement(elementType)
        div.id = elementID;
        div.className = elementClass;

        return div;
    }

    // create bag
    let bagContainer = createCustomElement('div', 'bagContainer');
    let bag = createCustomElement('div', 'bag');
    let bagTitle = createCustomElement('h1', 'bagTitle');
    let ProductList = createCustomElement('ul', 'bag-items');
    let titlePrice = createCustomElement('p');
    let price = createCustomElement('span', 'totalPrice');
    let itemsContainer = createCustomElement('div', 'itemsContainer');
    let menuButtonContainer = createCustomElement('div', 'menuButtonContainer');
    let menuButton = createCustomElement('button', 'menuButton');

    // bagTitle.textContent = "Recently Added Products";

    navbar.appendChild(bagContainer); // append bagContainer to navbar
    bagContainer.appendChild(bagTitle); // append bagTitle to bagContainer
    bagContainer.appendChild(itemsContainer); // append items Container to bagContainer


    // create user options (userdashboard & logout)
    let optionsContainer = createCustomElement('div', 'userOptionsContainer');
    let optionsList = createCustomElement('ul', 'optionsList');
    let accountLink = createNavItem('Account', 'account.php');
    let logout = createNavItem('Logout', 'logout.php');
    let loginLink = createNavItem('Login', 'login.php');
    let signupLink = createNavItem('Signup', 'signup.php');

    navbar.appendChild(optionsContainer); // append options Container to navbar
    optionsContainer.appendChild(optionsList); // append options list to options container

    // Get data from database
    fetch('getData.php')
        .then(response => response.json())
        .then(data => {
        let bag = document.getElementById('itemsContainer');
    
        data.forEach(item => {
            let productItem = createCustomElement('div', 'product');

            let productNameContainer = createCustomElement('div', 'productNameCont');
            let productName = createCustomElement('p', 'productName');

            let productFlavorContainer = createCustomElement('div', 'productFlavorCont');
            let productFlavor = createCustomElement('p', 'productFlavor');

            let productPriceContainer = createCustomElement('div', 'productPriceContainer');
            let productPrice = createCustomElement('p', 'productPrice');

            productName.textContent = item.product_name;
            productFlavor.textContent = item.flavor;
            productPrice.textContent = "₱" + item.price;
            menuButton.textContent = 'View Menu and Bag';
            // menuButton.href = 'menu.php';
            menuButton.addEventListener('click', function(){
                window.location.href = "menu.php";
            })
            
            itemsContainer.appendChild(productItem);
            productItem.appendChild(productNameContainer);
            productItem.appendChild(productFlavorContainer);
            productNameContainer.appendChild(productName);
            productFlavorContainer.appendChild(productFlavor);
            productItem.appendChild(productPriceContainer);
            productPriceContainer.appendChild(productPrice);
        });
        })
        .catch(error => console.error('Error:', error));

    // check if bag icon is clicked
    bagButton.addEventListener('click', function(){
        // Get data from database
        fetch('isLoggedin.php')
        .then(response => response.json())
        .then(data => {
            let userID = data.user_id;
            let username = data.username;
            let bagTitle = document.getElementById('bagTitle');
        
            if(userID && username){
                // set bag title to "You are not logged in text".
                bagTitle.textContent = "Recently Added Products";

                bagContainer.appendChild(menuButtonContainer); // append menuButtonContainer to bagContainer
                menuButtonContainer.appendChild(menuButton); // menuButton to menuButtonContainer
            }
            else if(userID === '' && username === ''){
                bagTitle.textContent = "You are not Logged in.";
                bagContainer.style.height = 'fit-content';
            }
        })
        .catch(error => console.error('Error:', error));

        let bagContainer = document.getElementById('bagContainer');

        // get display value of bagContainer
        let computedStyle = window.getComputedStyle(bagContainer);
        let displayValue = computedStyle.getPropertyValue('display');

        if(displayValue === 'none'){
            bagContainer.style.display = 'flex';
        }
        else{
            bagContainer.style.display = 'none';
        }
    })
    // check if the account icon is not clicked
    document.addEventListener('click', function(event){
        // get display value of AccountContainer
        let userOptionsContainer = document.getElementById('userOptionsContainer');
        let computedStyle = window.getComputedStyle(userOptionsContainer);
        let displayValue = computedStyle.getPropertyValue('display');
        // get display value of bagContainer
        let bagContainer = document.getElementById('bagContainer');
        let computedStyle2 = window.getComputedStyle(bagContainer);
        let displayValue2 = computedStyle2.getPropertyValue('display');

        if(!accountButton.contains(event.target) && displayValue === 'flex'){
            console.log("Outside of account button is clicked, Closing account button");
            userOptionsContainer.style.display = 'none';
        }
        if(!bagButton.contains(event.target) && displayValue2 === 'flex'){
            console.log("Outside of bag button is clicked, closing bag button")
            bagContainer.style.display = 'none';
        }
    })
    // check if account icon is clicked
    accountButton.addEventListener('click', function(){
        let userOptionsContainer = document.getElementById('userOptionsContainer');

            // Get data from database
        fetch('isLoggedin.php')
        .then(response => response.json())
        .then(data => {
            let userID = data.user_id;
            let username = data.username;
        
            if(userID && username){
                optionsList.appendChild(accountLink);
                optionsList.appendChild(logout);
            }
            else if(userID === '' && username === ''){
                optionsList.appendChild(loginLink);
                optionsList.appendChild(signupLink);
            }
        })
        .catch(error => console.error('Error:', error));

            // get display value of bagContainer
        let computedStyle = window.getComputedStyle(userOptionsContainer);
        let displayValue = computedStyle.getPropertyValue('display');

        if(displayValue === 'none'){
            userOptionsContainer.style.display = 'flex';
        }
        else{
            userOptionsContainer.style.display = 'none';
        }
    })

  
}
function setPageName(){
    let filePath = window.location.pathname;

    let pathInfo = filePath.split('/').pop();
    let fileNameWithoutExtension = pathInfo.split('.').slice(0, -1).join('.');
    let Capitalized_Title = fileNameWithoutExtension.charAt(0).toUpperCase() + fileNameWithoutExtension.slice(1);
    let updatedString = Capitalized_Title.replace(/-/g, ' ');

    document.title = updatedString + " |  I ❤️ Milktea";

    // change color of the current page in the navbar
    // if(updatedString === 'Home'){
    //     let
    // }
}

function floating(){
    let cont1 = document.getElementById('cont1');

    let bgContainer = document.createElement('div');
    bgContainer.className = 'bg-cont';

    cont1.appendChild(bgContainer);

    for (let i = 0; i <= 6; i++) {
        let imgContainer = document.createElement('div');
        imgContainer.className = 'img-cont';

        let image = document.createElement('img');
        let randomImage = getRandomItem([
            'styles/img/melkti1.png',
            'styles/img/melkti2.png',
            'styles/img/melkti3.png'
        ]);
        image.src = randomImage;
        image.alt = 'milkteaImage';

        let imageShadow = document.createElement('span');

        bgContainer.appendChild(imgContainer);
        imgContainer.appendChild(image);
        imgContainer.appendChild(imageShadow);
    }

    function getRandomItem(array) {
        let randomIndex = Math.floor(Math.random() * array.length);
        return array[randomIndex];
    }

    let background = document.createElement('img');
    background.src = 'styles/img/Milktea Wallpaper 2.jpg';
    background.id = 'bg';
    bgContainer.appendChild(background);
}


// check the current page
let page = window.location.pathname;
let pathInfo = page.split('/').pop();
let fileNameWithoutExtension = pathInfo.split('.').slice(0, -1).join('.');
let Capitalized_Title = fileNameWithoutExtension.charAt(0).toUpperCase() + fileNameWithoutExtension.slice(1);
let pageName = Capitalized_Title.replace(/-/g, ' ');



if(pageName == 'Home'){
    console.log('Current page: '+pageName);
    createNavbar();
    setPageName();
    floating();
}
else if(pageName == 'Franchise'){
    console.log('Current page: '+pageName);
    createNavbar();

    let nav = document.getElementById('navbar');
    nav.style.position = 'static';
}
else if(pageName == 'Login'){
    console.log("Current page: "+pageName);
    setPageName();
}
else if(pageName == 'Allmenu'){
    console.log('Current page: '+pageName);
    createNavbar();

    let nav = document.getElementById('navbar');
    nav.style.position = 'static';

    document.title = "Our Menu";
}
else if(pageName == 'Menu'){
    console.log("Current page: "+pageName);
    createNavbar();
    setPageName();
}
else if(pageName == 'Checkout'){
    // console.log("Current page: "+pageName);
    // createNavbar();
    // setPageName();
}else if(pageName == 'Account'){
    createNavbar();
    setPageName();
}
else{
    console.log("Page unknown.");
}
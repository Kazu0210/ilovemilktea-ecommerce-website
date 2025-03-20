<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Add to Cart</title>
  <style>
    /* Some basic styling for better presentation */
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .product {
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 10px;
    }
    button {
      padding: 5px 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div id="products-container">
  <!-- Sample products with "Add to Cart" buttons -->
  <div class="product" data-product-id="1">
    <h3>Product 1</h3>
    <p>Price: $10.00</p>
    <button onclick="addToCart(1, 'Product 1', 10.00)">Add to Cart</button>
  </div>

  <div class="product" data-product-id="2">
    <h3>Product 2</h3>
    <p>Price: $20.00</p>
    <button onclick="addToCart(2, 'Product 2', 20.00)">Add to Cart</button>
  </div>
</div>

<div id="cart">
  <h2>Shopping Cart</h2>
  <ul id="cart-items"></ul>
  <p>Total: $<span id="cart-total">0.00</span></p>
</div>

<script>
  // Cart data
  let cart = [];
  let total = 0;

  // Function to add a product to the cart
  function addToCart(productId, productName, productPrice) {
    // Check if the product is already in the cart
    const existingProduct = cart.find(item => item.id === productId);

    if (existingProduct) {
      // If the product is already in the cart, update the quantity
      existingProduct.quantity++;
    } else {
      // If the product is not in the cart, add it with quantity 1
      cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
    }

    // Update the cart display
    updateCartDisplay();
  }

  // Function to update the cart display
  function updateCartDisplay() {
    const cartItemsElement = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');

    // Clear previous cart items
    cartItemsElement.innerHTML = '';

    // Update cart items and calculate total
    total = 0;
    cart.forEach(item => {
      const li = document.createElement('li');
      li.textContent = `${item.name} x${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`;
      cartItemsElement.appendChild(li);
      total += item.price * item.quantity;
    });

    // Update total
    cartTotalElement.textContent = total.toFixed(2);
  }
</script>

</body>
</html>

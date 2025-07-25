// DOM Elements
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const toggleSidebar = document.getElementById('toggleSidebar');
const closeSidebar = document.getElementById('closeSidebar');
const mainContent = document.getElementById('mainContent');
const cartItems = document.getElementById('cartItems');
const emptyCart = document.getElementById('emptyCart');
const cartTotalSection = document.getElementById('cartTotalSection');
const cartTotal = document.getElementById('cartTotal');
const checkoutBtn = document.getElementById('checkoutBtn');
const addToCartButtons = document.querySelectorAll('.add-to-cart');

// Cart state
let cart = [];

// Toggle sidebar
function toggleSidebarFunc() {
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
    document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : 'auto';
    
    if (sidebar.classList.contains('active')) {
        mainContent.classList.add('shifted');
    } else {
        mainContent.classList.remove('shifted');
    }
}

// Add to cart
function addToCart(id, name, price) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id,
            name,
            price,
            quantity: 1
        });
    }
    
    updateCart();
    
    // Show notification
    const notification = document.createElement('div');
    notification.style.position = 'fixed';
    notification.style.bottom = '20px';
    notification.style.right = '20px';
    notification.style.backgroundColor = '#27ae60';
    notification.style.color = 'white';
    notification.style.padding = '15px 20px';
    notification.style.borderRadius = '5px';
    notification.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
    notification.style.zIndex = '2000';
    notification.style.display = 'flex';
    notification.style.alignItems = 'center';
    notification.style.gap = '10px';
    notification.innerHTML = `<i class="fas fa-check-circle"></i> ${name} added to cart`;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 500);
    }, 3000);
}

// Remove from cart
function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    updateCart();
}

// Update quantity
function updateQuantity(id, change) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
    let total = 0;
    cartItems.forEach(item => {
        total += item.price * item.quantity;
    });
    // Update the cart total display
    document.getElementById('cartTotal').textContent = 'RM' + total.toFixed(2);
    // Optionally, update cart items display here as well
    const item = cart.find(item => item.id === id);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(id);
        } else {
            updateCart();
        }
    }
}

// Update cart display
function updateCart() {
    if (cart.length === 0) {
        emptyCart.style.display = 'block';
        cartTotalSection.style.display = 'none';
        checkoutBtn.style.display = 'none';
        return;
    }
    
    emptyCart.style.display = 'none';
    cartTotalSection.style.display = 'flex';
    checkoutBtn.style.display = 'block';
    
    let cartHTML = '';
    let total = 0;
    
    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        cartHTML += `
            <div class="cart-item">
                <img src="https://picsum.photos/seed/${item.name.toLowerCase().replace(/\s+/g, '')}/50/50.jpg" alt="${item.name}" class="cart-item-img">
                <div class="cart-item-details">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">RM${item.price.toFixed(2)}</div>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn" onclick="updateQuantity('${item.id}', -1)">-</button>
                        <span class="quantity-value">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity('${item.id}', 1)">+</button>
                        <button class="cart-item-remove" onclick="removeFromCart('${item.id}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    cartItems.innerHTML = cartHTML;
    cartTotal.textContent = `RM${total.toFixed(2)}`;

    // Always save the cart to localStorage here:
    localStorage.setItem('cartItems', JSON.stringify(cart));
}


// Event Listeners
toggleSidebar.addEventListener('click', toggleSidebarFunc);
closeSidebar.addEventListener('click', toggleSidebarFunc);
overlay.addEventListener('click', toggleSidebarFunc);

addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = parseFloat(button.dataset.price);
        addToCart(id, name, price);
    });
});

// Initialize cart
updateCart();

// Add this script after your pizza cards or in app.js
document.querySelectorAll('.add-to-cart').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const id = btn.getAttribute('data-id');
        const name = btn.getAttribute('data-name');
        const price = parseFloat(btn.getAttribute('data-price'));
        let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
        let found = cartItems.find(item => item.id == id);
        if (found) {
            found.quantity += 1;
        } else {
            cartItems.push({id, name, price, quantity: 1});
        }
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        alert(name + " added to cart!");
        updateCart(); // <-- Add this line
    });
});


if (!userLoggedIn) {
  document.getElementById('discount-offer').style.display = 'none';
}
// Show login or signup form


function showAllContent(show = true) {
  const allContent = document.querySelectorAll('.content');
  allContent.forEach(el => el.style.display = show ? 'block' : 'none');

  // Always hide login/signup forms if showing main content
  if (show) {
    document.getElementById('login').style.display = 'none';
    document.getElementById('signup').style.display = 'none';
  }

  // 🔒 Never hide the sidebar toggle button
  const toggleSidebarBtn = document.getElementById('toggleSidebar');
  if (toggleSidebarBtn) {
    toggleSidebarBtn.style.display = 'block';
  }
}
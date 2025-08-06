<div class="offcanvas offcanvas-end" tabindex="-2" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-secondary fw-bold text-shadow-sm" id="offcanvasCartLabel">Your Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cart-items">
            <!-- Cart items will be dynamically populated here -->
        </div>
        <hr>

        <div class="cart-summary">
            <div class="d-flex justify-content-between">
                <span class="text-secondary">Total Items:</span>
                <span id="cart-total-items">0</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-secondary">Total Price:</span>
                <span id="cart-total-price">$0.00</span>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('shop.checkout') }}" class="btn btn-primary w-100">Proceed To Checkout</a>
        </div>
    </div>
</div>

<script>
    function debounce(fn, delay) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    const routeURL = `{{ route('products.search') }}`;

    function handleSearch(inputElement, resultsElement) {
        const query = inputElement.value.trim();

        if (!query) {
            resultsElement.innerHTML = "";
            return;
        }

        fetch(`${routeURL}?q=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (!Array.isArray(data) || data.length === 0) {
                    resultsElement.innerHTML = `<div class="text-muted text-center">No products found.</div>`;
                    return;
                }

                const resultsHTML = data.map(product => `
                    <a href="${product.url}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <img src="${product.image || '/assets/images/no_img.png'}" alt="${product.name}" class="img-thumbnail me-3" style="width: 50px; height: 50px;">
                        <span>${product.name}</span>
                    </a>
                `).join('');

                resultsElement.innerHTML = resultsHTML;
            })
            .catch(error => {
                console.error("Search error:", error);
                resultsElement.innerHTML = `<div class="text-danger text-center">Search failed. Try again.</div>`;
            });
    }

    document.addEventListener("DOMContentLoaded", () => {
        const searchPairs = [
            { inputId: "searchInput", resultsId: "searchResults" },
            { inputId: "searchInputMobile", resultsId: "searchResultsMobile" }
        ];

        searchPairs.forEach(({ inputId, resultsId }) => {
            const inputEl = document.getElementById(inputId);
            const resultsEl = document.getElementById(resultsId);

            if (inputEl && resultsEl) {
                inputEl.addEventListener("input", debounce(() => handleSearch(inputEl, resultsEl), 300));

                inputEl.addEventListener("keydown", function (e) {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        const query = inputEl.value.trim();
                        if (query) {
                            window.location.href = `{{ route('shop') }}?q=${encodeURIComponent(query)}`;
                        }
                    }
                });
            }
        });
    });

    const cartButton = document.getElementById('cartButton');
    cartButton.addEventListener('click', function () {
        const cart = document.cookie
            .split('; ')
            .find(row => row.startsWith('cart='))
            ?.split('=')[1];
        const cartData = cart ? JSON.parse(decodeURIComponent(cart)) : [];

        const cartItemsContainer = document.getElementById('cart-items');
        const totalItemsElement = document.getElementById('cart-total-items');
        const totalPriceElement = document.getElementById('cart-total-price');

        let totalItems = 0;
        let totalPrice = 0;

        cartItemsContainer.innerHTML = '';
        cartData.forEach((item, index) => {
            totalItems += item.quantity;
            totalPrice += item.price * item.quantity;

            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item', 'd-flex', 'align-items-center', 'mb-3');

            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="img-fluid rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                <div class="flex-grow-1">
                    <h6 class="mb-0">${item.name}</h6>
                    <small class="text-muted">Price: $${item.price} | Quantity: ${item.quantity}</small>
                </div>
                <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">Remove</button>
            `;

            cartItemsContainer.appendChild(cartItem);
        });

        totalItemsElement.textContent = totalItems;
        totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
    });

    function removeFromCart(index) {
        const cart = document.cookie
            .split('; ')
            .find(row => row.startsWith('cart='))
            ?.split('=')[1];
        const cartData = cart ? JSON.parse(decodeURIComponent(cart)) : [];

        if (index >= 0 && index < cartData.length) {
            cartData.splice(index, 1);
            document.cookie = `cart=${encodeURIComponent(JSON.stringify(cartData))}; path=/`;
            location.reload();
        }
    }
</script>
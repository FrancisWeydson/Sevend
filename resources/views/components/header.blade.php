<header>
    <div class="menu-toggle" id="mobile-menu">
        <div class="hamburger"></div>
        <div class="hamburger"></div>
        <div class="hamburger"></div>
    </div>
    
    <div class="logo">
        <img src="{{url('img/LOGO.png')}}" class="img-logo" alt="Padaria dos Três">
    </div>

    <div class="icons">
        <div class="search-container">
            <form action="/pesquisa" method="GET" class="search-form">
                <input type="text" placeholder="Pesquisar..." name="q" class="search-input">
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        <div class="perfil-icon"> 
            <a href="#" id="profileDropdownTrigger">
                <i class="fa-solid fa-user"></i>
            </a>
            <div class="dropdown-menu" id="profileDropdown">
                <a href="/login">Login</a>
                <a href="/register">Registrar</a>
            </div>
        </div>
    </div>
</header>

<!-- Modal do Carrinho -->
<div class="cart-modal" id="cartModal">
    <div class="cart-modal-content">
        <div class="cart-modal-header">
            <h3>Seu Carrinho</h3>
            <span class="close-cart">&times;</span>
        </div>
        <div class="cart-modal-body">
            <div class="cart-items">
                <!-- Itens do carrinho serão adicionados aqui dinamicamente -->
                <p class="empty-cart-message">Seu carrinho está vazio</p>
            </div>
        </div>
        <div class="cart-modal-footer">
            <div class="cart-total">
                <strong>Total: R$ <span class="total-amount">0,00</span></strong>
            </div>
            <button class="checkout-btn">Finalizar Compra</button>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dropdown do perfil
        const dropdownTrigger = document.getElementById('profileDropdownTrigger');
        const dropdownMenu = document.getElementById('profileDropdown');
        
        dropdownTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });
        
        // Fechar o dropdown quando clicar fora
        document.addEventListener('click', function(e) {
            if (!dropdownTrigger.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });

        // Modal do carrinho
        const cartTrigger = document.getElementById('cartTrigger');
        const cartModal = document.getElementById('cartModal');
        const closeCart = document.querySelector('.close-cart');

        cartTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            cartModal.style.display = 'block';
        });

        closeCart.addEventListener('click', function() {
            cartModal.style.display = 'none';
        });

        // Fechar o modal quando clicar fora
        window.addEventListener('click', function(e) {
            if (e.target === cartModal) {
                cartModal.style.display = 'none';
            }
        });

        // Aqui você pode adicionar a lógica para adicionar itens ao carrinho
        // Exemplo básico:
        function addToCart(productName, price) {
            const cartItems = document.querySelector('.cart-items');
            const emptyMessage = document.querySelector('.empty-cart-message');
            
            if (emptyMessage) {
                cartItems.removeChild(emptyMessage);
            }
            
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <div class="item-name">${productName}</div>
                <div class="item-price">R$ ${price.toFixed(2)}</div>
            `;
            cartItems.appendChild(cartItem);
            
            // Atualizar total
            updateCartTotal(price);
            
            // Atualizar contador
            updateCartCount(1);
        }
        
        function updateCartTotal(amountToAdd) {
            const totalElement = document.querySelector('.total-amount');
            let total = parseFloat(totalElement.textContent.replace(',', '.')) || 0;
            total += amountToAdd;
            totalElement.textContent = total.toFixed(2).replace('.', ',');
        }
        
        function updateCartCount(countToAdd) {
            const countElement = document.querySelector('.cart-count');
            let count = parseInt(countElement.textContent) || 0;
            count += countToAdd;
            countElement.textContent = count;
        }
        
        // Exemplo de uso:
        // addToCart('Pão Francês', 2.50);
    });
</script>
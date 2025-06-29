<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
</head>

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
        <div class="cart-icon">
            <a href="#" id="cartTrigger">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>


        <div class="perfil-icon">
            <input type="hidden" id="idCliente" value="{{ Auth::guard('web')->user()->id_cliente }}">
            @php
                $cliente = Auth::user(); 
            @endphp

            @if($cliente)

                <a class="posi" href="#" id="profileDropdownTrigger">

                    <div class="profile-photo">

                        @if($cliente->foto_perfil_cliente)
                            <img class="imgphoto" src="{{ asset($cliente->foto_perfil_cliente) }}" alt="Foto Usuario">
                        @else
                            <img class="imgphoto" src="{{ asset('img/perfi.png') }}" alt="Foto Padrão">
                        @endif
            @endif

                </div>
                <span class="username">Olá, {{ Auth::guard('web')->user()->nome_cliente }}</span>

            </a>


            <div class="dropdown-menu" id="profileDropdown">
                <a href="{{ route('sevend.perfil.edit', Auth::guard('web')->user()->id_cliente) }}">Meu Perfil</a>
                <a href="{{ route('sevend.pedido.index', Auth::guard('web')->user()->id_cliente) }}">Meus Pedidos</a>
                <a href="{{ route('sevend.logout') }}">Sair</a>
            </div>
        </div>
    </div>

    <div class="cart-modal" id="cartModal">
        <div class="cart-modal-content">
            <div class="cart-modal-header">
                <h3>Seu Carrinho</h3>
                <span class="close-cart">&times;</span>
            </div>
            <div class="cart-modal-body">
                <div class="cart-items">
                    <!-- Itens do carrinho serão adicionados aqui dinamicamente -->
                    <div id="lista-produtos"></div>
                </div>
            </div>
            <div class="cart-modal-footer">
                <div class="cart-total">
                    <strong>Total: R$ <span class="total-amount">0,00</span></strong>
                </div>
                <form action="{{ route('sevend.carrinho.index', Auth::guard('web')->user()->id_cliente) }}" method="get">
                    <button type="submit" class="checkout-btn">Finalizar Compra</button>
                </form>
                
            </div>
        </div>
    </div>
    

</header>

<style>
    .perfil-icon {
        position: relative;
        display: inline-block;
    }

    .username {
        margin-left: 5px;
        font-size: 14px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: #fff;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        border-radius: 4px;
        padding: 10px 0;
    }

    .dropdown-menu a {
        color: #333;
        padding: 8px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .dropdown-menu a:hover {
        background-color: #f5f5f5;
    }

    .perfil-icon:hover .dropdown-menu {
        display: block;
    }

    #mobile-menu {
        user-select: none;
    }

    .produto {
        position: relative;
    display: flex;
    align-items: center;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin: 10px 0;
    padding: 10px 16px;
    gap: 16px;
    transition: transform 0.2s ease;
}

.produto:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.produto-img {
    flex-shrink: 0;
}

.imgPro {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
}

.produto-dados {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.qnt, .preco {
    font-size: 14px;
    color: #555;
    margin: 0;
}
.maiss-btn, .menoss-btn {
    width: 25px;
    height: 25px;
    border: none;
    background-color: #28a745; 
    color: white;
    border-radius: 5px;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    user-select: none;
    margin: 0 6px;
}

.maiss-btn:hover, .menoss-btn:hover {
    background-color: #218838; 
}

.maiss-btn i, .menoss-btn i {
    pointer-events: none; 
}
.excluir {
    position: absolute;
    top: 8px;
    right: 8px;
    background: none;
    border: none;
    color: #ff4d4d;
    cursor: pointer;
    font-size: 18px;
    padding: 4px;
    transition: color 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.excluir:hover {
    color: #e60000; 
}
.icons{
    display: flex;
    justify-content: left;
    align-items: flex-start;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownTrigger = document.getElementById('profileDropdownTrigger');
        const dropdownMenu = document.getElementById('profileDropdown');

        dropdownTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Fechar o dropdown quando clicar fora
        document.addEventListener('click', function (e) {
            if (!dropdownTrigger.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    });

    const cartTrigger = document.getElementById('cartTrigger');
    const cartModal = document.getElementById('cartModal');
    const closeCart = document.querySelector('.close-cart');

    cartTrigger.addEventListener('click', function (e) {
        e.preventDefault();
        cartModal.style.display = 'block';
    });

    closeCart.addEventListener('click', function () {
        cartModal.style.display = 'none';
    });

    // Fechar o modal quando clicar fora
    window.addEventListener('click', function (e) {
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
$("#cartTrigger").click(function () {
    let cliente = $("#idCliente").val();

    $.ajax({
        url: `/api/carrinho/index/${cliente}`,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            const carrinho = response.carrinhoCliente; // array de itens
            console.log("Itens do carrinho:", carrinho);

            let html = '';
            let total = 0; // variável para somar total

            if (Array.isArray(carrinho) && carrinho.length > 0) {
                carrinho.forEach(function (item) {
                    // soma o valor total desse item (preco_total_carrinho)
                    total += parseFloat(item.preco_total_carrinho);

                    html += `
                        <div class="produto">
                            <input type="hidden" name="id_carrinho" class="id_carrinho" value="${item.id_carrinho}">
                            <input type="hidden" name="id_prod" class="id_prod" value="${item.id_produto}">
                            <div class="produto-img">
                                <img src="{{ asset('${item.img_produto}') }}" class="imgPro">
                            </div>
                            <div class="produto-dados">
                                <h2 class="name">${item.nome_produto}</h2>
                                <p class="qnt">Qntd: <button class="menoss-btn"><i class="fas fa-minus"> </i></button> <span class="qtd-number">${item.qntd_carrinho}</span>  <button class="maiss-btn"> <i class="fas fa-plus"></i></button></p>
                                <p class="preco">Preço: R$ ${parseFloat(item.preco_total_carrinho).toFixed(2).replace('.', ',')}</p>
                            </div>

                            <div class="icons">
                                <button class="excluir"><i class="fas fa-trash"> </i></button>
                            </div>
                        </div>
                    `;
                });
            } else {
                html = '<p>Nenhum item no carrinho.</p>';
            }

            $("#lista-produtos").html(html);

            // Atualiza o total formatado com vírgula
            $(".total-amount").text(total.toFixed(2).replace('.', ','));
        },
        error: function (xhr) {
            console.error('Erro ao carregar produtos:', xhr.responseText);
        }
    });
});

</script>

    <script>
        $(document).on("click", ".excluir", function() {
            let prod = $(this).closest(".produto").find("input[name='id_carrinho']").val();

            $.ajax({
                url: `/api/carrinho/delete/${prod}`,
                method: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert('Produto removido do carrinho.');
                    $("#cartTrigger").click(); // Recarrega o carrinho
                },
                error: function (xhr, status, error) {
                    console.error('Erro:', xhr.responseText);
                    alert('Erro ao adicionar o produto ao carrinho. Verifique o console para mais detalhes.');
                }
            });
        });
    </script>
    <script>
        $(document).on("click", ".maiss-btn", function() {
            let prod = $(this).closest(".produto").find("input[name='id_carrinho']").val();
            let produto = $(this).closest(".produto").find("input[name='id_prod']").val();
            let produtoDiv = $(this).closest(".produto");
            let cliente = $("#idCliente").val();

            let qtdAtual = parseInt(produtoDiv.find(".qtd-number").text());
            let novaQtd = qtdAtual + 1;

            $.ajax({
                url: `/api/carrinho/edit/${prod}`,
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    idCliente: cliente,
                    idProduto: produto,
                    qntdCarrinho: novaQtd
                },
                success: function(response) {
                    $("#cartTrigger").click(); // Recarrega o carrinho
                },
                error: function (xhr, status, error) {
                    console.error('Erro:', xhr.responseText);
                    alert('Erro ao adicionar o produto ao carrinho. Verifique o console para mais detalhes.');
                }
            });
        });
    </script>
    <script>
        $(document).on("click", ".menoss-btn", function() {
            let prod = $(this).closest(".produto").find("input[name='id_carrinho']").val();
            let produto = $(this).closest(".produto").find("input[name='id_prod']").val();
            let produtoDiv = $(this).closest(".produto");
            let cliente = $("#idCliente").val();

            let qtdAtual = parseInt(produtoDiv.find(".qtd-number").text());
            if (qtdAtual <= 1) {
                return; 
            }

            let novaQtd = qtdAtual - 1;

            $.ajax({
                url: `/api/carrinho/edit/${prod}`,
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    idCliente: cliente,
                    idProduto: produto,
                    qntdCarrinho: novaQtd
                },
                success: function(response) {
                    $("#cartTrigger").click(); // Recarrega o carrinho
                },
                error: function (xhr, status, error) {
                    console.error('Erro:', xhr.responseText);
                    alert('Erro ao adicionar o produto ao carrinho. Verifique o console para mais detalhes.');
                }
            });
        });
    </script>
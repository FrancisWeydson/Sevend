<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Pesquisa - Padaria dos Três</title>
    <link rel="stylesheet" href="{{url('css/styless.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    @if(Auth::guard('web')->check())
        @include('components.headerLogin')
    @else
        @include('components.header')
    @endif

    <!-- Menu Lateral -->
    <nav id="nav-menu">
        <ul>
            <li><a href="{{ route('sevend.home') }}"><i class="fas fa-home"></i> Início</a></li>
            <li><a href="{{ route('sevend.sobre') }}"><i class="fas fa-info-circle"></i> Sobre Nós</a></li>
            <li><a href="{{ route('sevend.produto') }}"><i class="fas fa-utensils"></i> Produtos</a></li>
        </ul>
    </nav>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Conteúdo da Página de Pesquisa -->
    <section id="search-results" class="search-page">
        <div class="container">
            <h1 class="search-title">Resultados para: <span>"{{ $pesquisa }}"</span></h1>

            <div class="search-filters">
                <div class="filter-group">
                    <label for="category">Categoria:</label>
                    <select id="category" class="filter-select" name="categoria">
                        <option value="">Selecione</option>
                        <option value="">Todas</option>
                        @foreach ($cats as $categoria)
                        <option value="{{ $categoria->nome_categoria }}">{{ $categoria->nome_categoria }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="sort">Ordenar por:</label>
                    <select id="sort" class="filter-select" name="sort">
                        <option value="">Selecione</option>
                        <option value="relevance">Relevância</option>
                        <option value="price-asc">Preço: menor para maior</option>
                        <option value="price-desc">Preço: maior para maior</option>
                    </select>
                </div>
            </div>

            <div class="results-grid">
                <!-- Item de resultado 1 -->
                @foreach($produtos as $result)
                <div class="result-item">
                    <div class="result-image">
                        <img src="{{ asset($result->img_produto) }}" alt="Pão Francês">
                    </div>
                    <div class="result-info">
                        <input type="hidden" class="idProduto" value="{{ $result->id_produto }}">
                        <input type="hidden" class="precoUnitario" value="{{ $result->valor_produto }}">
                        <h3>{{ $result->nome_produto }}</h3>
                        <p class="result-description">{{ $result->desc_produto }}</p>
                        <p>R$ {{ number_format($result->valor_produto, 2, ',', '.') }} por unidade</p>

                        <div class="quantidade-container">
                            <button class="menos-btn"><i class="fas fa-minus"></i></button>
                            <input type="number" class="qntdProduto" value="1" min="1">
                            <button class="mais-btn"><i class="fas fa-plus"></i></button>
                        </div>
                        <button class="add-to-cart" id="add-to-cart">Adicionar ao Carrinho</button>


                    </div>

                </div>
                @endforeach

            </div>

            {{ $produtos->appends(request()->query())->links('vendor.pagination.custom') }}

            <div class="no-results" style="display: none;">
                <i class="fas fa-search-minus"></i>
                <h3>Nenhum resultado encontrado</h3>
                <p>Experimente usar termos diferentes ou verifique a ortografia.</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="contact-info">
            <p>Endereço: Rua Alegre, 123 - São Paulo, SP</p>
            <p>Telefone: (11) 1234-5678</p>
            <p>Email: contato@padariadostres.com.br</p>
        </div>
        <div class="social-media">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
        </div>
        <div class="legal-links">
            <a href="#">Política de Privacidade</a>
            <a href="#">Termos de Serviço</a>
            <a href="{{ route('login') }}">Admin</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>    document.querySelectorAll('.result-item').forEach(produto => {
  const btnMais = produto.querySelector('.mais-btn');
  const btnMenos = produto.querySelector('.menos-btn');
  const inputQntd = produto.querySelector('.qntdProduto');

  btnMais.addEventListener('click', () => {
    inputQntd.value = parseInt(inputQntd.value) + 1;
  });

  btnMenos.addEventListener('click', () => {
    if (parseInt(inputQntd.value) > 1) {
      inputQntd.value = parseInt(inputQntd.value) - 1;
    }
  });
});

        $(document).ready(function () {
            // Menu Hamburguer
            const menuToggle = $('#mobile-menu');
            const toggle = $('.menu-toggle');
            const navMenu = $('#nav-menu');
            const overlay = $('#overlay');

            // Abrir/Fechar menu
            toggle.click(function () {
                navMenu.toggleClass('active');
                overlay.toggleClass('active');
                $('body').toggleClass('no-scroll');
            });

            menuToggle.click(function () {
                navMenu.toggleClass('active');
                overlay.toggleClass('active');
                $('body').toggleClass('no-scroll');
            });

            // Fechar menu ao clicar no overlay
            overlay.click(function () {
                navMenu.removeClass('active');
                overlay.removeClass('active');
                $('body').removeClass('no-scroll');
            });

            // Fechar menu ao clicar em um link (opcional)
            $('#nav-menu ul li a').click(function () {
                navMenu.removeClass('active');
                overlay.removeClass('active');
                $('body').removeClass('no-scroll');
            });

            // Contador do carrinho
            let cartItems = 0;
            $('.add-to-cart').click(function () {
                cartItems++;
                $('.cart-count').text(cartItems);

                // Animação do carrinho
                $('.cart-count').css({ 'transform': 'scale(1.5)' });
                setTimeout(function () {
                    $('.cart-count').css({ 'transform': 'scale(1)' });
                }, 300);
            });

            // Carousel (se necessário)
            $('.carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });</script>
    <script>
        $(document).ready(function() {
            // Menu Hamburguer
            const menuToggle = $('#mobile-menu');
            const navMenu = $('#nav-menu');
            const overlay = $('#overlay');

            // Abrir/Fechar menu
            menuToggle.click(function() {
                navMenu.toggleClass('active');
                overlay.toggleClass('active');
                $('body').toggleClass('no-scroll');
            });

            // Fechar menu ao clicar no overlay
            overlay.click(function() {
                navMenu.removeClass('active');
                overlay.removeClass('active');
                $('body').removeClass('no-scroll');
            });

            // Fechar menu ao clicar em um link (opcional)
            $('#nav-menu ul li a').click(function() {
                navMenu.removeClass('active');
                overlay.removeClass('active');
                $('body').removeClass('no-scroll');
            });

            // Contador do carrinho
            let cartItems = 0;
            $('.add-to-cart').click(function() {
                cartItems++;
                $('.cart-count').text(cartItems);

                // Animação do carrinho
                $('.cart-count').css({
                    'transform': 'scale(1.5)'
                });
                setTimeout(function() {
                    $('.cart-count').css({
                        'transform': 'scale(1)'
                    });
                }, 300);
            });

            // Carousel (se necessário)
            $('.carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        document.getElementById('category').addEventListener('change', function() {
            const selectedCategory = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set('categoria', selectedCategory);
            window.location.href = url.toString();
        });

        document.getElementById('sort').addEventListener('change', function() {
            const selectedSort = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set('sort', selectedSort);
            window.location.href = url.toString();
        });

        document.querySelectorAll('.product').forEach(produto => {
        const btnMais = produto.querySelector('.mais-btn');
        const btnMenos = produto.querySelector('.menos-btn');
        const inputQntd = produto.querySelector('.qntdProduto');

        btnMais.addEventListener('click', () => {
            inputQntd.value = parseInt(inputQntd.value) + 1;
        });

        btnMenos.addEventListener('click', () => {
            if (parseInt(inputQntd.value) > 1) {
            inputQntd.value = parseInt(inputQntd.value) - 1;
            }
        });
        });
    </script>
    <script>
        $(".add-to-cart").click(function () {
            let parent = $(this).closest('.result-item');
            let produto = parent.find('.idProduto').val();
            let precoUnitario = parent.find('.precoUnitario').val();
            let quantidade = parent.find('.qntdProduto').val();
            let cliente = $("#idCliente").val();

            $.ajax({
                url: '/api/carrinho/store',
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    idCliente: cliente,
                    idProduto: produto,
                    qntdCarrinho: quantidade,
                    precoUnitarioCarrinho: precoUnitario
                },
                success: function (response) {
                    alert('Produto adicionado ao carrinho.');
                },
                error: function (xhr, status, error) {
                    console.error('Erro:', xhr.responseText);
                    alert('Erro ao adicionar o produto ao carrinho. Verifique o console para mais detalhes.');
                }
            });
        });
    </script>


</body>

</html>
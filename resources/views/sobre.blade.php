<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padaria dos Três</title>
    <link rel="stylesheet" href="{{url('css/styless.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
  
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
            <li><a class="{{ Request::is('home') ? 'navbarAtivado' : '' }}" href="{{ route('sevend.home') }}"><i class="fas fa-home"></i> Início</a></li>
            <li><a class="{{ Request::is('sobre') ? 'navbarAtivado' : '' }}" href="{{ route('sevend.sobre') }}"><i class="fas fa-info-circle"></i> Sobre Nós</a></li>
            <li><a class="{{ Request::is('produtos') ? 'navbarAtivado' : '' }}" href="{{ route('sevend.produto') }}"><i class="fas fa-utensils"></i> Produtos</a></li>
        </ul>
    </nav>
    
    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Conteúdo da Página -->
   

    <section id="about" class="about-section">
    <div class="about-container">
        <div class="about-content">
            <div class="about-text">
                <h2 class="section-title">Nossa História</h2>
                <p class="about-description">Nossa jornada começou com o sonho de criar doces caseiros que conectam as pessoas. Usando os melhores ingredientes, preparamos pães, bolos e pastelaria com amor e cuidado, tornando cada momento especial.</p>
                
                <div class="about-values">
                    <div class="value-item">
                        <i class="fas fa-heart"></i>
                        <h3>Paixão</h3>
                        <p>Amor em cada receita, tradição em cada sabor</p>
                    </div>
                    <div class="value-item">
                        <i class="fas fa-seedling"></i>
                        <h3>Qualidade</h3>
                        <p>Ingredientes selecionados para o melhor resultado</p>
                    </div>
                    <div class="value-item">
                        <i class="fas fa-home"></i>
                        <h3>Tradição</h3>
                        <p>Receitas caseiras que aquecem o coração</p>
                    </div>
                </div>
                <div class="bt">
                <a href="#contact" class="about-button">Fale Conosco</a>
                </div>
            </div>
            
            <div class="about-image">
                <img src="{{url('img/paofrances.jpg')}}" >
                <div class="image-overlay"></div>
            </div>
        </div>
    </div>
</section>

    <footer>
        <div class="contact-info">
            <p>Endereço: Rua Alegre, 123 - São Paulo, SP</p>
            <p>Telefone: (11) 1234-5678</p>
            <p>Email: contato@sevend4.com.br</p>
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            // Menu Hamburguer
            const menuToggle = $('#mobile-menu');
            const navMenu = $('#nav-menu');
            const overlay = $('#overlay');
            
            // Abrir/Fechar menu
            menuToggle.click(function(){
                navMenu.toggleClass('active');
                overlay.toggleClass('active');
                $('body').toggleClass('no-scroll');
            });
            
            // Fechar menu ao clicar no overlay
            overlay.click(function(){
                navMenu.removeClass('active');
                overlay.removeClass('active');
                $('body').removeClass('no-scroll');
            });
            
            // Fechar menu ao clicar em um link (opcional)
            $('#nav-menu ul li a').click(function(){
                navMenu.removeClass('active');
                overlay.removeClass('active');
                $('body').removeClass('no-scroll');
            });
            
            // Contador do carrinho
            let cartItems = 0;
            $('.add-to-cart').click(function(){
                cartItems++;
                $('.cart-count').text(cartItems);
                
                // Animação do carrinho
                $('.cart-count').css({'transform': 'scale(1.5)'});
                setTimeout(function(){
                    $('.cart-count').css({'transform': 'scale(1)'});
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
        });
    </script>
</body>
</html>
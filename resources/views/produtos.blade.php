<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padaria dos Três</title>
    <link rel="stylesheet" href="{{url('css/styles7.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
</head>
<body>
<header>
        <div class="menu-toggle" id="mobile-menu">
            <div class="hamburger"></div>
            <div class="hamburger"></div>
            <div class="hamburger"></div>
        </div>
     
        
<div class="logo">
            <img src="{{url('img/LOGO.png')}}" class="img-logo" alt="Padaria dos Três">
        </div>
    
    <!-- Menu Lateral -->
    
       

        <div class="icons">

        <div class="cart-icon">
                <a href="#">
                
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
            
            <div class="perfil-icon"> 
            <a href="#">
            <i class="fa-solid fa-user"></i>
            </a>
            </div>

            
        </div>
    </header>   

    
    <!-- Menu Lateral -->
    <nav id="nav-menu">
    <ul>
            <li><a class="{{ Request::is('') ? 'navbarAtivado' : '' }}" href="{{ route('home') }}"><i class="fas fa-home"></i> Início</a></li>
            <li><a class="{{ Request::is('sobre') ? 'navbarAtivado' : '' }}" href="{{ route('sobre') }}"><i class="fas fa-info-circle"></i> Sobre Nós</a></li>
            <li><a class="{{ Request::is('produtos') ? 'navbarAtivado' : '' }}" href="{{ route('produto') }}"><i class="fas fa-utensils"></i> Produtos</a></li>
            <li><a class="{{ Request::is('') ? 'navbarAtivado' : '' }}" href="#contact"><i class="fas fa-envelope"></i> Contato</a></li>
            <li><a href="{{ route('clienteLogin') }}"><i class="fas fa-user"></i> Login/Registrar</a></li>
        </ul>
    </nav>
    
    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Conteúdo da Página -->
   

    <section id="highlights">
        
        <h2>Produtos</h2>
        <div class="products">
            <div class="product">
                <img src="{{url('img/paofrances.jpg')}}" alt="Pão Francês">
                <h3>Pão Francês</h3>
                <p>R$ 1,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/cro.jpg')}}" alt="Croissant">
                <h3>Croissant</h3>
                <p>R$ 6,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>

            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
        </div>
    </section>
    <section id="highlights">
        <div class="products">
            <div class="product">
                <img src="{{url('img/paofrances.jpg')}}" alt="Pão Francês">
                <h3>Pão Francês</h3>
                <p>R$ 1,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/cro.jpg')}}" alt="Croissant">
                <h3>Croissant</h3>
                <p>R$ 6,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
        </div>
    </section>
    <section id="highlights">
        <div class="products">
            <div class="product">
                <img src="{{url('img/paofrances.jpg')}}" alt="Pão Francês">
                <h3>Pão Francês</h3>
                <p>R$ 1,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/cro.jpg')}}" alt="Croissant">
                <h3>Croissant</h3>
                <p>R$ 6,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
        </div>
    </section>


    <section id="highlights">
        <div class="products">
            <div class="product">
                <img src="{{url('img/paofrances.jpg')}}" alt="Pão Francês">
                <h3>Pão Francês</h3>
                <p>R$ 1,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/cro.jpg')}}" alt="Croissant">
                <h3>Croissant</h3>
                <p>R$ 6,00 por unidade</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product">
                <img src="{{url('img/fuba.jpg')}}" alt="Bolo">
                <h3>Bolo de Fubá</h3>
                <p>R$ 20,00 o kilo</p>
                <button class="add-to-cart">Adicionar ao Carrinho</button>
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
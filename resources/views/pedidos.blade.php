<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Minhas Compras</title>
  <link rel="stylesheet" href="{{url('css/pedidos.css')}}">
  <link rel="stylesheet" href="{{url('css/styless.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body>
    @include('components.headerLogin')

    <nav id="nav-menu">
        <ul>
            <li><a class="{{ Request::is('home') ? 'navbarAtivado' : '' }}" href="{{ route('sevend.home') }}"><i class="fas fa-home"></i> Início</a></li>
            <li><a class="{{ Request::is('sobre') ? 'navbarAtivado' : '' }}" href="{{ route('sevend.sobre') }}"><i class="fas fa-info-circle"></i> Sobre Nós</a></li>
            <li><a class="{{ Request::is('produtos') ? 'navbarAtivado' : '' }}" href="{{ route('sevend.produto') }}"><i class="fas fa-utensils"></i> Produtos</a></li>
        </ul>
    </nav>

  <main class="content">
    <div class="tabs">
        <a href="{{ route('sevend.pedido.index', ['id' => Auth::guard('web')->user()->id_cliente]) }}" class="{{ request('status') === null ? 'active' : '' }}">Tudo</a>
        <a href="{{ route('sevend.pedido.index', ['id' => Auth::guard('web')->user()->id_cliente, 'status' => 'Em Andamento']) }}" class="{{ request('status') === 'Em Andamento' ? 'active' : '' }}">Em Andamento</a>
        <a href="{{ route('sevend.pedido.index', ['id' => Auth::guard('web')->user()->id_cliente, 'status' => 'Finalizado']) }}" class="{{ request('status') === 'Finalizado' ? 'active' : '' }}">Finalizado</a>
        <a href="{{ route('sevend.pedido.index', ['id' => Auth::guard('web')->user()->id_cliente, 'status' => 'Cancelado']) }}" class="{{ request('status') === 'Cancelado' ? 'active' : '' }}">Cancelado</a>
    </div>

    @foreach($pedidos as $pedido)
        <div class="order-card">
            <div class="order-header">
                <div>{{ strtoupper($pedido->status_pedido) }}</div>
            </div>
            @foreach($pedido->itens as $item)
                <div class="product-info">
                    <img src="{{ asset($item->produto?->img_produto) }}" alt="Produto">
                    <div class="product-details">
                        <div>{{ $item->produto?->nome_produto }}</div>
                        <div>Qntd: {{ $item->qtd_itens_pedido }}</div>
                        <div>Preço: R${{ $item->preco_unitario }}</div>
                    </div>
                </div>
            @endforeach
            <div class="order-total">Total do Pedido: R${{ number_format($pedido->valor_total_pedido, 2, ',', '.') }}</div>
        </div>
    @endforeach

  </main>

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

        // Preview da imagem de perfil
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('image-preview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Clicar na imagem para selecionar arquivo
        document.getElementById('image-preview').addEventListener('click', function() {
            document.getElementById('image-upload').click();
        });

        // Validação do formulário
        document.querySelector('.profile-form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            if (newPassword && newPassword !== confirmPassword) {
                e.preventDefault();
                alert('As senhas não coincidem!');
                document.getElementById('confirm-password').focus();
            }
        });

        // Busca automática de CEP
        document.addEventListener('DOMContentLoaded', function() {
            const cepField = document.getElementById('cep');
            
            if (cepField) {
                cepField.addEventListener('blur', function() {
                    const cep = this.value.replace(/\D/g, '');
                    
                    if (cep.length === 8) {
                        this.classList.add('loading');
                        
                        fetch(`https://viacep.com.br/ws/${cep}/json/`)
                            .then(response => {
                                if (!response.ok) throw new Error('Erro na requisição');
                                return response.json();
                            })
                            .then(data => {
                                if (!data.erro) {
                                    document.getElementById('address').value = data.logradouro || '';
                                    // Descomente para preencher mais campos se necessário:
                                    // document.getElementById('bairro').value = data.bairro || '';
                                    // document.getElementById('cidade').value = data.localidade || '';
                                    // document.getElementById('estado').value = data.uf || '';
                                } else {
                                    alert('CEP não encontrado!');
                                }
                            })
                            .catch(error => {
                                console.error('Erro ao buscar CEP:', error);
                                alert('Erro ao buscar CEP. Verifique o CEP digitado e tente novamente.');
                            })
                            .finally(() => {
                                this.classList.remove('loading');
                            });
                    }
                });
            }
        });

        document.querySelector('.delete-btn').addEventListener('click', function() {
    document.getElementById('deleteModal').style.display = 'flex';
});

document.querySelector('.cancel-btn').addEventListener('click', function() {
    document.getElementById('deleteModal').style.display = 'none';
});

    </script>

</body>
</html>

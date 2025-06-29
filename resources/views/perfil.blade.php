<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padaria dos Três</title>
    <link rel="stylesheet" href="{{url('css/styless.css')}}">
    <link rel="stylesheet" href="{{url('css/perfil.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
         /* Estilos dos modais */
         .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Garante que o modal fique acima de outros elementos */
            display: flex; /* Garante que o conteúdo será centralizado */
        }

        /* Modal content */
        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            /* Organiza os elementos verticalmente */
        }

        .modal-content h2{
            color: #892222;
        }

        .modal-content ul {
            list-style: none;
            padding: 0;
        }

    </style>
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
    
    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>
    <div class="container">
        <div class="profile-header">
            <h1><i class="fas fa-user-circle"></i> Meu Perfil</h1>
        </div>

        <div class="profile-container">
            <div class="profile-content">
                <div class="profile-section">
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="profile-form" method="POST" action="{{ route('sevend.perfil.update', Auth::guard('web')->user()->id_cliente)  }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-section">
                            <h2><i class="fas fa-user-edit"></i> Informações Pessoais</h2>
                            
                            <div class="photo-and-info">
                                <div class="profile-picture">

                                
                                    <div class="image-preview-container">

                                        <img id="image-preview" 
                                            src="{{ $cliente->foto_perfil_cliente ? asset($cliente->foto_perfil_cliente) : asset('img/perfi.png') }}"  
                                            alt="Foto do perfil" 
                                            class="img-preve">
                                        <i class="fas fa-camera"></i> Alterar Foto
                                        <input type="file" id="image-upload" name="foto_perfil_cliente" accept=".jpg, .png, .jpeg" style="display: none;">
                                    </div>
                                </div>
                                
                                <div class="basic-info">
                                    <div class="form-group">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" id="name" name="nome_cliente" value="{{ $cliente->nome_cliente }}">
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email_cliente" value="{{ $cliente->email_cliente }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Telefone</label>
                                            <input type="tel" id="phone" name="tell_cliente" value="{{ $cliente->tell_cliente }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" id="cpf" name="cpf_cliente" value="{{ $cliente->cpf_cliente }}">
                                </div>
                                <div class="form-group">
                                    <label for="rg">Rg</label>
                                    <input type="text" id="rg" name="rg_cliente" value="{{ $cliente->rg_cliente }}">
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Data de Nascimento</label>
                                    <input type="date" id="birthdate" name="data_nasc_cliente" value="{{ $cliente->data_nasc_cliente }}">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Seção de Endereço -->
                        <div class="form-section">
                            <h2><i class="fas fa-map-marker-alt"></i> Endereço Principal</h2>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="cep_cliente">CEP</label>
                                    <input type="text" id="cep_cliente" name="cep_cliente" value="{{ $cliente->cep_cliente }}" placeholder="Digite seu CEP..." required data-mask="00000-000" maxlength="9" onblur="pesquisacep(this.value);">
                                    <input type="hidden" name="bairro_cliente" class="input" id="bairro_cliente" value="{{ $cliente->bairro_cliente }}">
                                    <input type="hidden" name="cidade_cliente" class="input" id="cidade_cliente" value="{{ $cliente->cidade_cliente }}">
                                    <input type="hidden" name="uf_cliente" class="input" id="uf_cliente" value="{{ $cliente->uf_cliente }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="logra_cliente">Endereço</label>
                                    <input type="text" id="logra_cliente" name="logra_cliente" value="{{ $cliente->logra_cliente }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h2><i class="fas fa-map-marker-alt"></i> Complemento de Endereço</h2>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input type="text" id="number" name="numLogra_cliente" value="{{ $cliente->numLogra_cliente }}">
                                </div>
                                <div class="form-group">
                                    <label for="com">Complemento</label>
                                    <input type="text" id="com" name="complemento_cliente" value="{{ $cliente->complemento_cliente }}">
                                </div>
                            </div>
                        </div>
                       

  
    

    <div class="form-actions">
        <button type="submit" class="save-btn">Salvar Alterações</button>
        <button type="button" id="delete-btn" class="delete-btn"><i class="fas fa-trash" style="color: #8D6E63;"></i>Deletar Conta</button>
    </div>
</form>

<form class="profile-form" method="POST" action="{{ route('sevend.perfil.updateSenha', Auth::guard('web')->user()->id_cliente)  }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Seção de Senha -->
                        <div class="form-section">
                            <h2><i class="fas fa-lock"></i> Alterar Senha</h2>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="senha_atual">Senha Atual</label>
                                    <input type="password" id="senha_atual" name="senha_atual">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="new-password">Nova Senha</label>
                                    <input type="password" id="new-password" name="senha_cliente">
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirmar Nova Senha</label>
                                    <input type="password" id="confirm-password" name="senha_cliente_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="save-btn">Alterar Senha</button>
                        </div>

</form>

<div class="modal" id="errorModal">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Confirmar Deletação</h4>
        </div>
        <div class="modal-body">
            <p>Tem certeza que deseja deletar sua conta? Essa ação não pode ser desfeita.</p>
        </div>
        <div class="modal-footer">
            <button id="cancel-btn" class="cancel-btn2" data-dismiss="modal">Cancelar</button>
            <form action="{{ route('sevend.perfil.delete', Auth::guard('web')->user()->id_cliente ) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="confirm-delete-btn">Deletar Conta</button>
            </form>
        </div>
    </div>
</div>

                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        
        function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('logra_cliente').value=("");
                document.getElementById('bairro_cliente').value=("");
                document.getElementById('cidade_cliente').value=("");
                document.getElementById('uf_cliente').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('logra_cliente').value=(conteudo.logradouro);
                document.getElementById('bairro_cliente').value=(conteudo.bairro);
                document.getElementById('cidade_cliente').value=(conteudo.localidade);
                document.getElementById('uf_cliente').value=(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
            
        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('logra_cliente').value="...";
                    document.getElementById('bairro_cliente').value="...";
                    document.getElementById('cidade_cliente').value="...";
                    document.getElementById('uf_cliente').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    //alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };

    </script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>
        $(document).ready(function() { 
            $('#errorModal').hide();

            $('#delete-btn').click(function() {
                $('#errorModal').fadeIn();
            });

            // Se clicar fora do modal, ele fecha
            $(window).click(function(event) {
                if ($(event.target).hasClass("modal")) {
                    $(".modal").fadeOut(); // Fecha o modal com efeito fadeOut
                }
            });

            $('#cancel-btn').click(function() {
                $(".modal").fadeOut();
            });

        });
    </script>
</body>
</html>
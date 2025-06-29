<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style6.css') }}">
    <title>Cadastro Usuarios</title>
    <style>
        .hidden {
            display: none;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 15px auto;
            padding: 10px;
            background-color: #a18351;
            color:#f8d7a3;
            border-radius: 5px;
            width: 100%;
        }

        .toggle-btn:hover {
            background-color:rgb(145, 116, 68);
        }
    </style>
</head>
<body>

<div class="con">
    <div class="direita">
    
        <div class="titu">
            <h1>Users</h1>
        </div>
        <div class="caixa-lg">
            <div class="tit"> 
                <h2>Cadastrar</h2>
                
            </div>
            <form method="POST" action="{{ route('sevend.register') }}">
                @csrf

                <!-- Primeira etapa -->
                <div id="step-1">


                    <div class="grupo-in">
                        <label for="nome" class="subtitulo">Nome:</label>
                        <input type="text" name="nome" class="input" id="nome" placeholder="Digite seu Nome..." required>
                    </div>    
                    <div class="grupo-in">
                        <label for="email" class="subtitulo">E-mail:</label>
                        <input type="email" name="email" class="input" id="email" placeholder="Digite seu E-mail..." required>
                    </div>
                    <div class="grupo-in">
                        <label for="password" class="subtitulo">Senha:</label>
                        
                        <div style="position: relative; display: flex; align-items: center;">
                       
                        <input type="password" name="password" class="input" id="password" placeholder="Digite sua Senha..." required style="width: 100%; padding-right: 40px;">
                        <span id="togglePassword" class="material-icons" style="cursor: pointer; position: absolute; right: 10px; color: white;">visibility</span>
                        </div>
                    </div>
                </div>

                <!-- Segunda etapa -->
                <div id="step-2" class="hidden">
                    <div class="grupo-in">
                        <label for="telefone" class="subtitulo">Telefone:</label>
                        <input type="text" name="telefone" class="input" id="telefone" placeholder="Digite seu telefone..." required data-mask="(00) 00000-0000">
                    </div>
                    <div class="grupo-in">
                        <label for="dataNasc" class="subtitulo">Data Nasc:</label>
                        <input type="date" name="dataNasc" class="input" id="dataNasc">
                    </div>
                    <div class="grupo-in">
                        <label for="cpf" class="subtitulo">CPF:</label>
                        <input type="text" name="cpf" class="input" id="cpf" placeholder="Digite seu CPF..." required data-mask="000.000.000-00">
                    </div>
                    <div class="grupo-in">
                        <label for="rg" class="subtitulo">RG:</label>
                        <input type="text" name="rg" class="input" id="rg" placeholder="Digite seu RG..." required data-mask="00.000.000-0">
                    </div>
                   
                </div>

                 <!-- Terceira etapa -->
                 <div id="step-3" class="hidden">
                    <div class="grupo-in">
                        <label for="cep" class="subtitulo">CEP:</label>
                        <input type="text" name="cep" class="input" id="cep" placeholder="Digite seu CEP..." required data-mask="00000-000" maxlength="9" onblur="pesquisacep(this.value);">
                        <input type="hidden" name="bairro" class="input" id="bairro">
                        <input type="hidden" name="cidade" class="input" id="cidade">
                        <input type="hidden" name="uf" class="input" id="uf">
                    </div>
                    <div class="grupo-in">
                        <label for="logra" class="subtitulo">Endereço:</label>
                        <input type="text" name="logra" class="input" id="logra" placeholder="Digite Seu Endereço...">
                    
                    </div>
                    <div class="grupo-in">
                        <label for="numLogra" class="subtitulo">Número da Casa:</label>
                        <input type="text" name="numLogra" class="input" id="numLogra" placeholder="Digite o número da sua casa...">
                    </div>
                    <div class="grupo-in">
                        <label for="complemento" class="subtitulo">Complemento:</label>
                        <input type="text" name="complemento" class="input" id="complemento" placeholder="Digite seu complemento...">
                    </div>
                   
                </div>

                @if ($errors->any())
                    <div class="error-message2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Botão de alternância -->
                <button type="button" class="toggle-btn" onclick="toggleStep()">Próximo</button>

                <div class="bt">
                    <button type="submit" class="botao hidden" id="submit-btn">Cadastrar-se</a></button>
                </div>
            </form>
        </div>
    </div>
    <div class="esquerda">
        <img class="img" src="{{ asset('img/LOGO.png') }}" >
    </div>
</div>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script>
        
        function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('logra').value=("");
                document.getElementById('bairro').value=("");
                document.getElementById('cidade').value=("");
                document.getElementById('uf').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('logra').value=(conteudo.logradouro);
                document.getElementById('bairro').value=(conteudo.bairro);
                document.getElementById('cidade').value=(conteudo.localidade);
                document.getElementById('uf').value=(conteudo.uf);
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
                    document.getElementById('logra').value="...";
                    document.getElementById('bairro').value="...";
                    document.getElementById('cidade').value="...";
                    document.getElementById('uf').value="...";

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
    let currentStep = 1;

    function toggleStep() {
        let step1 = document.getElementById('step-1');
        let step2 = document.getElementById('step-2');
        let step3 = document.getElementById('step-3');
        let btn = document.querySelector('.toggle-btn');
        let submitBtn = document.getElementById('submit-btn');

        if (currentStep === 1) {
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            btn.textContent = "Próximo";
            submitBtn.classList.add('hidden');
            currentStep = 2;
        } else if (currentStep === 2) {
            step2.classList.add('hidden');
            step3.classList.remove('hidden');
            btn.textContent = "Voltar";
            submitBtn.classList.remove('hidden');
            currentStep = 3;
        } else {
            step3.classList.add('hidden');
            step1.classList.remove('hidden');
            btn.textContent = "Próximo";
            submitBtn.classList.add('hidden');
            currentStep = 1;
        }
    }
</script>
<script src="{{ asset('js/password.js') }}"></script>

</body>
</html>

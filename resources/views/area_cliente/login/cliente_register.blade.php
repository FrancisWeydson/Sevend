<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            <form method="POST" action="{{ url('sevend.login') }}">
                @csrf

                <!-- Primeira etapa -->
                <div id="step-1">
                    
                    <div class="grupo-in">
                        <label for="email" class="subtitulo">E-mail:</label>
                        <input type="email" name="email" class="input" id="email" placeholder="Digite seu E-mail...">
                    </div>
                    <div class="grupo-in">
                        <label for="password" class="subtitulo">Senha:</label>
                        
                        <div style="position: relative; display: flex; align-items: center;">
                       
                        <input type="password" name="password" class="input" id="password" placeholder="Digite sua Senha..."  style="width: 100%; padding-right: 40px;">
                        <span id="togglePassword" class="material-icons" style="cursor: pointer; position: absolute; right: 10px; color: white;">visibility</span>
                        </div>
                    </div>
                </div>

                <!-- Segunda etapa -->
                <div id="step-2" class="hidden">
                    <div class="grupo-in">
                        <label for="telefone" class="subtitulo">Telefone:</label>
                        <input type="text" name="telefone" class="input" id="telefone" placeholder="Digite seu telefone...">
                    </div>
                    <div class="grupo-in">
                        <label for="cep" class="subtitulo">CEP:</label>
                        <input type="text" name="cep" class="input" id="cep" placeholder="Digite seu CEP...">
                    </div>
                    <div class="grupo-in">
                        <label for="endereco" class="subtitulo">Endereço:</label>
                        <input type="text" name="endereco" class="input" id="endereco" placeholder="Digite seu endereço...">
                    </div>
                   
                </div>

                <!-- Botão de alternância -->
                <button type="button" class="toggle-btn" onclick="toggleStep()">Próximo</button>

                <div class="bt">
                    <button type="submit" class="botao hidden" id="submit-btn"> <a class="a1" href="{{ route('clienteLogin') }}">Cadastrar-se</a></button>
                </div>
            </form>
        </div>
    </div>
    <div class="esquerda">
        <img class="img" src="{{ asset('img/LOGO.png') }}" >
    </div>
</div>

<script>
    let isStep1 = true;

    function toggleStep() {
        let step1 = document.getElementById('step-1');
        let step2 = document.getElementById('step-2');
        let btn = document.querySelector('.toggle-btn');
        let submitBtn = document.getElementById('submit-btn');

        if (isStep1) {
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            btn.textContent = "Voltar";
            submitBtn.classList.remove('hidden');
        } else {
            step1.classList.remove('hidden');
            step2.classList.add('hidden');
            btn.textContent = "Próximo";
            submitBtn.classList.add('hidden');
        }
        isStep1 = !isStep1;
    }
</script>
<script src="{{ asset('js/password.js') }}"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style2.css')}}">
    <title>Login Cliente</title>
</head>
<body>
    
<div class="con">
        <div class="esquerda">
            <img class="img" src="{{ asset('img/LOGO.png') }}" >
        </div>
        <div class="direita">
                    <div class="titu">
                        <h1>Cliente</h1>
                    </div>
                    <div class="caixa-lg">
                        <div class="tit">
                            <h2>Login</h2>
                           
                        
                        </div>
            <form method="POST" action="{{ route('sevend.login') }}">
                    @csrf

                    <div class="grupo-in">
                        <label for="email" class="subtitulo">E-Mail:</label>
                        <input type="email" class="input" name="email" placeholder="Digite seu email..." required placeholder="Digite seu email..." id="email">
                        @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                     
                    

                    <div class="grupo-in">
                        <label for="password" class="subtitulo">Senha:</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="password" class="input" name="password" placeholder="Digite sua Senha..." required placeholder="Digite sua senha... " id="password"  style="width: 100%; padding-right: 40px;">
                            <span id="togglePassword" class="material-icons" style="cursor: pointer; position: absolute; right: 10px; color: white;">visibility</span>
                        </div>
                        @error('senha')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
                   
                    <div class="bt">
                    <button type="submit" class="botao">Login </button>
                    </div>

                        <div class="cadastrar">
                             <p class="subtitulo">Registra-se:</p><a class=" a1" href="{{ route('sevend.register') }}">Clique Aqui</a>
                         </div>

                </form>
            </div>
        </div>
     </div>

    <script src="{{ asset('js/password.js') }}"></script>
</body>
</html>







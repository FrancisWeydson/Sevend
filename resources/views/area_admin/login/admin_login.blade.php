<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
    <link rel="stylesheet" href="{{url('css/adm.css')}}">
</head>
<body>



<div class="con">
        <div class="esquerda">
            <img class="img" src="{{ asset('img/LOGO.png') }}" alt="Dog and Cat">
        </div>
        <div class="direita">
            <div class="titu">
                <h1>Administrador</h1>
            </div>
            <div class="caixa-lg">
                <div class="tit"> 
                    <h2>Login</h2>
                </div>

                <!-- Formulário de Login -->
         
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="grupo-in">
                        <input type="email"  class="input" name="email_admin" placeholder="Email" required>
                    </div>

                    <div class="grupo-in">
                        <input type="password" name="senha_admin" placeholder="Senha"  required>
                    </div>
                    
                    <div class="bt">
                        <button type="submit" class="botao">Login Admin</button>
                    </div>
                    
                </form>
            </div>
        </div>
</div>













   
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/dash.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
</head>
<body>

    @include('area_admin.componentes.navbar-admin')

    <main>
        <h1>Criar Admin</h1>
        <div class="card01">
            <div class="card">
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-cont">
                        <div class="form-group">
                            <label>Foto:</label>
                            <img id="preview" src="{{ url('img/padrao.png') }}" alt="Foto de Perfil" width="150">
                            <input id="foto" type="file" name="foto_perfil_admin" required>
                        </div>
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" name="nome_admin" required>
                        </div>
                        <div class="form-group">
                            <label>Nascimento:</label>
                            <input type="date" name="data_nasc_admin" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" name="email_admin" required>
                        </div>
                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" name="tell_admin" required data-mask="(00) 00000-0000">
                        </div>
                        <div class="form-group">
                            <label>RG:</label>
                            <input type="text" name="rg_admin" required data-mask="00.000.000-0">
                        </div>
                        <div class="form-group">
                            <label>CPF:</label>
                            <input type="text" name="cpf_admin" required data-mask="000.000.000-00">
                        </div>
                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="text" name="senha_admin" required>
                        </div>
                        <div class="form-group">
                            <label>CEP:</label>
                            <input type="text"  id="cep" maxlength="9" name="cep_admin" required data-mask="00000-000">
                        </div>
                        <div class="form-group">
                            <label>Logradouro:</label>
                            <input type="text" id="endereco" maxlength="100" name="logra_admin" required>
                        </div>
                        <div class="form-group">
                            <label>Número:</label>
                            <input type="text" name="numLogra_admin" required>
                        </div>
                        <div class="form-group">
                            <label>Complemento:</label>
                            <input type="text" name="complemento_admin" required>
                        </div>
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input type="text" name="bairro_admin" required>
                        </div>
                       
                        <div class="form-group">
                            <label>Cidade:</label>
                            <input type="text" name="cidade_admin" required>
                        </div>
                        <div class="form-group">
                            <label>UF:</label>
                            <input type="text"  id="uf" name="uf_admin" required>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('admin.index') }}" class="btn-voltar">Voltar</a>
                        <button type="submit" class="btn-salvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="{{url('js/atualizarFoto.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/dark.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/mascara.js') }}"></script>
    <script src="{{ asset('js/img.js') }}"></script>
    <script src="{{ asset('js/adm.js') }}"></script>
    <script src="{{ asset('js/cep.js') }}"></script>
    <script src="{{ asset('js/password.js') }}"></script>
</body>
</html>
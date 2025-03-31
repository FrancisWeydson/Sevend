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



    <h1>Editar Admin</h1>

    <div class="card01">
        <div class="card">
            <form action="{{ route('admin.update', $admin->id_admin) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-cont">
                    <div class="form-group">

                        <label>foto:</label>
                        <img id="preview" src="{{ asset($admin->foto_perfil_admin) }}" alt="Foto de Perfil" width="150">
                        <input id="foto" value="{{ $admin->foto_perfil_admin }}" type="file" name="foto_perfil_admin">
                    </div>
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome_admin" value="{{ $admin->nome_admin }}" required>
                    </div>
                    <div class="form-group">

                        <label>Nascimento:</label>
                        <input type="date" name="data_nasc_admin" value="{{ $admin->data_nasc_admin }}" required>
                    </div>
                    <div class="form-group">

                        <label>Email:</label>
                        <input type="text" name="email_admin" value="{{ $admin->email_admin }}" required>
                    </div>
                    <div class="form-group">

                        <label>Telefone:</label>
                        <input type="text" name="tell_admin" value="{{ $admin->tell_admin }}" required data-mask="(00) 00000-0000">
                    </div>
                    <div class="form-group">

                        <label>RG:</label>
                        <input type="text" name="rg_admin" value="{{ $admin->rg_admin }}" required data-mask="00.000.000-0">
                    </div>
                    <div class="form-group">

                        <label>CPF:</label>
                        <input type="text" name="cpf_admin" value="{{ $admin->cpf_admin }}" required data-mask="000.000.000-00">
                    </div>
                    <div class="form-group">

                        <label>Senha:</label>
                        <input type="text" name="senha_admin" value="{{ $admin->senha_admin }}" required>
                    </div>

                    <div class="form-group">

                        <label>cep:</label>
                        <input type="text" id="cep" maxlength="9" name="cep_admin" value="{{ $admin->cep_admin }}" required data-mask="00000-000">
                        </div>
                    <div class="form-group">

                        <label>Logra:</label>
                        <input type="text"  id="endereco" maxlength="100" name="logra_admin" value="{{ $admin->logra_admin }}" required>
                    </div>
                    <div class="form-group">

                        <label>numLogra:</label>
                        <input type="text" id="num" maxlength="5" name="numLogra_admin" value="{{ $admin->numLogra_admin }}" required>
                    </div>
                    <div class="form-group">

                        <label>Complemento:</label>
                        <input type="text" name="complemento_admin" value="{{ $admin->complemento_admin }}" required>
                    </div>
                    <div class="form-group">

                        <label>bairro:</label>
                        <input type="text" name="bairro_admin" value="{{ $admin->bairro_admin }}" required>
                    </div>
              
                    <div class="form-group">

                        <label>cidade:</label>
                        <input type="text" name="cidade_admin" value="{{ $admin->cidade_admin }}" required>
                    </div>
                    <div class="form-group">

                        <label>uf:</label>
                        <input type="text"  id="uf" name="uf_admin" value="{{ $admin->uf_admin }}" required>
                    </div>
                </div>
                <div class="form-actions">
                        <a href="{{ route('admin.index') }}" class="btn-voltar">Voltar</a>
                        <button type="submit" class="btn-salvar">Atualizar</button>
                    </div>
            </form>
        </div>
    </div>
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
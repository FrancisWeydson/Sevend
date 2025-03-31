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



    <h1>Editar cliente</h1>

    <div class="card01">
        <div class="card">
            <form action="{{ route('cliente.update', $cliente->id_cliente) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-cont">
                    <div class="form-group">

                        <label>foto:</label>
                        <img id="preview" src="{{ asset($cliente->foto_perfil_cliente) }}" alt="Foto de Perfil" width="150">
                        <input id="foto" value="{{ $cliente->foto_perfil_cliente }}" type="file" name="foto_perfil_cliente">
                    </div>
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome_cliente" value="{{ $cliente->nome_cliente }}" required>
                    </div>
                    <div class="form-group">

                        <label>Nascimento:</label>
                        <input type="date" name="data_nasc_cliente" value="{{ $cliente->data_nasc_cliente }}" required>
                    </div>
                    <div class="form-group">

                        <label>Email:</label>
                        <input type="text" name="email_cliente" value="{{ $cliente->email_cliente }}" required>
                    </div>
                    <div class="form-group">

                        <label>Telefone:</label>
                        <input type="text" name="tell_cliente" value="{{ $cliente->tell_cliente }}" required data-mask="(00) 00000-0000">
                    </div>
                    <div class="form-group">

                        <label>RG:</label>
                        <input type="text" name="rg_cliente" value="{{ $cliente->rg_cliente }}" required data-mask="00.000.000-0">
                    </div>
                    <div class="form-group">

                        <label>CPF:</label>
                        <input type="text" name="cpf_cliente" value="{{ $cliente->cpf_cliente }}" required data-mask="000.000.000-00">
                    </div>
                    <div class="form-group">

                        <label>Senha:</label>
                        <input type="text" name="senha_cliente" value="{{ $cliente->senha_cliente }}" required>
                    </div>
                    <div class="form-group">

                    <label>cep:</label>
                    <input type="text" id="cep" name="cep_cliente" value="{{ $cliente->cep_cliente }}" required data-mask="00000-000">
                    </div>
                    <div class="form-group">

                        <label>Logra:</label>
                        <input type="text" id="endereco" name="logra_cliente" value="{{ $cliente->logra_cliente }}" required>
                    </div>
                    <div class="form-group">

                        <label>numLogra:</label>
                        <input type="text" name="numLogra_cliente" value="{{ $cliente->numLogra_cliente }}" required>
                    </div>
                    <div class="form-group">

                        <label>Complemento:</label>
                        <input type="text" name="complemento_cliente" value="{{ $cliente->complemento_cliente }}" required>
                    </div>
                    <div class="form-group">

                        <label>bairro:</label>
                        <input type="text" name="bairro_cliente" value="{{ $cliente->bairro_cliente }}" required>
                    </div>
  
                    <div class="form-group">

                        <label>cidade:</label>
                        <input type="text" name="cidade_cliente" value="{{ $cliente->cidade_cliente }}" required>
                    </div>
                    <div class="form-group">

                        <label>uf:</label>
                        <input type="text" id="uf" name="uf_cliente" value="{{ $cliente->uf_cliente }}" required>
                    </div>
                </div>
                <div class="form-actions">
                        <a href="{{ route('cliente.index') }}" class="btn-voltar">Voltar</a>
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
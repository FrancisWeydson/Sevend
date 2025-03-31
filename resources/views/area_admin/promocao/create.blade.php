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
        <h1>Criar PROMOCAO</h1>
        <div class="card01">
            <div class="card">
                <form action="{{ route('promocao.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-cont">
                        <div class="form-group">
                            <label>Nome Promocao:</label>
                            <input type="text" name="nome_promocao" required>
                        </div>
                        <div class="form-group">
                            <label>Desc Promocao:</label>
                            <input type="text" name="desc_promocao" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo Promocao:</label>
                            <select name="tipo_promocao">
                                <option value="Desconto">Desconto</option>
                                <option value="Combo">Combo</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor:</label>
                            <input type="number" name="valor_promocao" required>
                        </div>
                        <div class="form-group">
                            <label>Data Inicio:</label>
                            <input type="date" name="data_inicio_promocao" required>
                        </div>
                        <div class="form-group">
                            <label>Data FIM:</label>
                            <input type="date" name="data_fim_promocao" required>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('promocao.index') }}" class="btn-voltar">Voltar</a>
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
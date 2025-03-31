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



    <h1>Editar estoque</h1>

    <div class="card01">
        <div class="card">
            <form action="{{ route('estoque.update', $estoque->id_estoque) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-cont">
                       
                        <div class="form-group">
                            <label>Produto:</label>
                            <select name="id_produto">
                                @foreach ($prods as $produto)
                                    <option value="{{ $produto->id_produto }}" {{ ($estoque->id_produto == $produto->id_produto) ? 'selected' : '' }}>{{ $produto->nome_produto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>tipo_movimento_estoque:</label>
                            <select name="tipo_movimento_estoque">
                                <option value="entrada" {{ ($estoque->tipo_movimento_estoque == "entrada") ? 'selected' : '' }}>Entrada</option>
                                <option value="saida" {{ ($estoque->tipo_movimento_estoque == "saida") ? 'selected' : '' }}>Saida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>qtd_movimento_estoque:</label>
                            <input type="text" value="{{ $estoque->qtd_movimento_estoque }}" name="qtd_movimento_estoque" required>
                        </div>
                       
                        
                    </div>
                <div class="form-actions">
                        <a href="{{ route('estoque.index') }}" class="btn-voltar">Voltar</a>
                        <button type="submit" class="btn-salvar">Atualizar</button>
                    </div>
            </form>
        </div>
    </div>
    <script src="{{url('js/atualizarFoto.js')}}"></script>
</body>

</html>
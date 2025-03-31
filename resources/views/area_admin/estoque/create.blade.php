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
        <h1>Criar estoque</h1>
        <div class="card01">
            <div class="card">
                <form action="{{ route('estoque.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-cont">
                       
                        <div class="form-group">
                            <label>Produto:</label>
                            <select name="id_produto">
                                @foreach ($prods as $produto)
                                    <option value="{{$produto->id_produto}}">{{$produto->nome_produto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>tipo_movimento_estoque:</label>
                            <select name="tipo_movimento_estoque">
                                <option value="entrada">Entrada</option>
                                <option value="saida">Saida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>qtd_movimento_estoque:</label>
                            <input type="text" name="qtd_movimento_estoque" required>
                        </div>
                       
                        
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('estoque.index') }}" class="btn-voltar">Voltar</a>
                        <button type="submit" class="btn-salvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="{{url('js/atualizarFoto.js')}}"></script>
</body>
</html>
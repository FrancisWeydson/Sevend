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



    <h1>Editar produto</h1>

    <div class="card01">
        <div class="card">
            <form action="{{ route('produto.update', $produto->id_produto) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-cont">
                    <div class="form-group">

                        <label>foto:</label>
                        <img id="preview" src="{{ asset($produto->img_produto) }}" alt="Foto de Perfil" width="150">
                        <input id="foto" value="{{ $produto->img_produto }}" type="file" name="img_produto">
                    </div>
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome_produto" value="{{ $produto->nome_produto }}" required>
                    </div>
                    <div class="form-group">

                        <label>Descrição:</label>
                        <input type="text" name="desc_produto" value="{{ $produto->desc_produto }}" required>
                    </div>
                    <div class="form-group">

                        <label>Valor:</label>
                        <input type="text" name="valor_produto" value="{{ $produto->valor_produto }}" required>
                    </div>
                    <div class="form-group">

                        <label>Categoria:</label>
                        <select name="id_categoria" >
                            @foreach($cats as $categoria)
                                <option value="{{ $categoria->id_categoria }}" {{ ($produto->id_categoria == $categoria->id_categoria) ? 'selected' : '' }}>{{ $categoria->nome_categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                   
                </div>
                <div class="form-actions">
                        <a href="{{ route('produto.index') }}" class="btn-voltar">Voltar</a>
                        <button type="submit" class="btn-salvar">Atualizar</button>
                    </div>
            </form>
        </div>
    </div>
    <script src="{{url('js/atualizarFoto.js')}}"></script>
</body>

</html>
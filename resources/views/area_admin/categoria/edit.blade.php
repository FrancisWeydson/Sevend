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



    <h1>Editar categoria</h1>

    <div class="card01">
        <div class="card">
            <form action="{{ route('categoria.update', $cat->id_categoria) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-cont">
                    
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome_categoria" value="{{ $cat->nome_categoria }}" required>
                    </div>
                   
                </div>
                <div class="form-actions">
                        <a href="{{ route('categoria.index') }}" class="btn-voltar">Voltar</a>
                        <button type="submit" class="btn-salvar">Atualizar</button>
                    </div>
            </form>
        </div>
    </div>
    <script src="{{url('js/atualizarFoto.js')}}"></script>
</body>

</html>
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
        <h1>Criar PRODUTO PROMOCAO</h1>
        <div class="card01">
            <div class="card">
                <form action="{{ route('produto_promocao.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-cont">
                        <div class="form-group">
                            <label>Produto:</label>
                            <select name="id_produto">
                                @foreach ($produtos as $produto)
                                    <option value="{{$produto->id_produto}}">{{$produto->nome_produto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Promocoes:</label>
                            <select name="id_promocao">
                                @foreach ($promocoes as $promocao)
                                    <option value="{{$promocao->id_promocao}}">{{$promocao->nome_promocao}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('produto_promocao.index') }}" class="btn-voltar">Voltar</a>
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
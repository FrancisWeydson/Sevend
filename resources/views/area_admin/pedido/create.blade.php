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
        <h1>Criar pedido</h1>
        <div class="card01">
            <div class="card">
                <form action="{{ route('pedido.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-cont">
                        
                        <div class="form-group">
                            <label>Cliente:</label>
                            <select name="id_cliente">
                                @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id_cliente}}">{{$cliente->nome_cliente}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data pedido:</label>
                            <input type="date" name="data_pedido" required>
                        </div>
                        <div class="form-group">
                            <label>Data entrega:</label>
                            <input type="date" name="data_entrega_pedido" required>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <select name="status_pedido">
                                <option value="Em Andamento">Em Andamento</option>
                                <option value="Finalizado">Finalizado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor Total:</label>
                            <input type="text" name="valor_total_pedido" required>
                        </div>
                        
                    <div class="form-actions">
                        <a href="{{ route('pedido.index') }}" class="btn-voltar">Voltar</a>
                        <button type="submit" class="btn-salvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="{{url('js/atualizarFoto.js')}}"></script>
</body>
</html>
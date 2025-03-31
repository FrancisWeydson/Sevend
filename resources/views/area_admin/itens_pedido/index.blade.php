<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <link rel="stylesheet" href="{{url('css/dash.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
</head>
<body>

    <h1>Lista de pedidos</h1>
    
    @include('area_admin.componentes.navbar-admin')

    <div class="main-content">
        <a href="{{ route('itens_pedido.create') }}" class="add-button">Adicionar pedido</a>

        
        <table>
            <thead>
                <tr>
                    <th class="col-t-1">ID</th>
                    <th class="col-t-2">Pedido</th>
                    <th class="col-t-3">Produto</th>
                    <th class="col-t-3">QTD</th>
                    <th class="col-t-5">Alterar</th>
                    <th class="col-t-6">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itps as $itpedido)
                    <tr>
                        <td>{{ $itpedido->id_itens_pedido }}</td>
                        <td>{{ $itpedido->id_pedido }}</td>
                        <td>{{ $itpedido->nome_produto }}</td>
                        <td>{{ $itpedido->qtd_itens_pedido }}</td>
                       
                        

                        <td class="text-center">
                           <a class="ig" href="{{ route('itens_pedido.edit', $itpedido->id_itens_pedido) }}">
                           
                            <i class="material-icons-sharp">edit</i>
                             </a>
                        </td>

                        <td class="text-center">
                            <form action="{{ route('itens_pedido.destroy', $itpedido->id_itens_pedido) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ig"> <i class="material-icons-sharp">delete</i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>

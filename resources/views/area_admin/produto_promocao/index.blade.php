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

    <h1>Lista de admins</h1>
    
    @include('area_admin.componentes.navbar-admin')

    <div class="main-content">
        <a href="{{ route('produto_promocao.create') }}" class="add-button">Adicionar Um Produto a Promocao</a>

        
        <table>
            <thead>
                <tr>
                    <th class="col-t-1">ID</th>
                    <th class="col-t-2">Produto</th>
                    <th class="col-t-3">Promocao</th>
                    <th class="col-t-5">Alterar</th>
                    <th class="col-t-6">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prpromos as $prpromo)
                    <tr>
                        <td>{{ $prpromo->id_produto_promocao }}</td>
                        <td>{{ $prpromo->nome_produto }}</td>
                        <td>{{ $prpromo->nome_promocao }}</td>
                       
                        

                        <td class="text-center">
                           <a class="ig" href="{{ route('produto_promocao.edit', $prpromo->id_produto_promocao) }}">
                           
                            <i class="material-icons-sharp">edit</i>
                             </a>
                        </td>

                        <td class="text-center">
                            <form action="{{ route('produto_promocao.destroy', $prpromo->id_produto_promocao) }}" method="POST" style="display:inline;">
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

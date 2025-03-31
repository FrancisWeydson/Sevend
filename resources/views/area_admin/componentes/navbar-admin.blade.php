    <style>
        .navbarAtivadoSeila{
            padding-bottom: 6px;
            border-bottom: 2px solid white;
        }
    </style>
    <aside>
        <div class="sidebar">
            <ul>
                <li>
                    <a class="{{ Request::is('area-admin/dashboard') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/admin') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('admin.index') }}"><i class="fas fa-user"></i> Admin</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/cliente') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('cliente.index') }}"><i class="fas fa-users"></i> Cliente</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/categoria') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('categoria.index') }}"><i class="fas fa-th-large"></i> Categoria</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/produto') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('produto.index') }}"><i class="fas fa-cogs"></i> Produto</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/estoque') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('estoque.index') }}"><i class="fas fa-boxes"></i> Estoque</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/pedido') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('pedido.index') }}"><i class="fas fa-shopping-cart"></i> Pedido</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/itens-pedido') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('itens_pedido.index') }}"><i class="fas fa-list-alt"></i> Itens Pedido</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/promocao') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('promocao.index') }}"><i class="fas fa-gift"></i> Promocao</a>
                </li>
                <li>
                    <a class="{{ Request::is('area-admin/produto-promocao') ? 'navbarAtivadoSeila' : '' }}" href="{{ route('produto_promocao.index') }}"><i class="fas fa-tags"></i> Produto Promocao</a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </aside>
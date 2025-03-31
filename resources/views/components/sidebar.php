<aside>
        <div class="sidebar">
            <ul>
                <li>
                    <a href="{{ route('area_admin.admin.index') }}"><i class="fas fa-user"></i> Admin</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-users"></i> Cliente</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-th-large"></i> Categoria</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-cogs"></i> Produto</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-boxes"></i> Estoque</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-shopping-cart"></i> Pedido</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-list-alt"></i> Itens Pedido</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-gift"></i> Promocao</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-tags"></i> Produto Promocao</a>
                </li>
            </ul>

            <form action="{{ route('area_admin.logout') }}" method="POST">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </aside>
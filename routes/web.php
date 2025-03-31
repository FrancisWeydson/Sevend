<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginClienteController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\{
    adminController,
    categoriaController,
    clienteController,
    estoqueController,
    itensPedidoController,
    pedidoController,
    produtoController,
    produtoPromocaoController,
    promocaoController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('/')->name('sevend.')->group(function () {
    Route::get('/login', [LoginClienteController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginClienteController::class, 'loginCliente']);
    Route::get('/register', [LoginClienteController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginClienteController::class, 'registerCliente']);
    Route::get('/', function () {
        return view('area_cliente.index');
    })->name('index');

    Route::get('', function() {
        return view('index');
    })->name('home');
    Route::middleware('auth:web')->group(function () {
        Route::post('logout', [LoginClienteController::class, 'logoutCliente'])->name('logout');
    });

});

Route::get('/', function () {
    return view('index'); // 
})->name('home');


Route::get('/cliente/login', function () {
    return view('area_cliente.login.cliente_login'); 
})->name(name: 'clienteLogin');

Route::get('/cliente/register', function () {
    return view('area_cliente.login.cliente_register'); 
})->name(name: 'clienteRegister');

Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');

Route::get('/produtos', function () {
    return view('produtos');
})->name('produto');


Route::prefix('area-admin')->group(function () {
    Route::get('/login', [LoginAdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginAdminController::class, 'loginAdmin']);
    
        

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [LoginAdminController::class, 'logoutAdmin'])->name('logout');
        Route::get('/dashboard', function () {
            return view('area_admin.index');
        })->name('dashboard');

        Route::get('/admin', [adminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [adminController::class, 'create'])->name('admin.create');
        Route::post('/admin', [adminController::class, 'store'])->name('admin.store');
        Route::get('/admin/{id}', [adminController::class, 'show'])->name('admin.show');
        Route::get('/admin/{id}/edit', [adminController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/{id}', [adminController::class, 'update'])->name('admin.update');
        Route::delete('/admin/{id}', [adminController::class, 'destroy'])->name('admin.destroy');

        Route::get('/categoria', [categoriaController::class, 'index'])->name('categoria.index');
        Route::get('/categoria/create', [categoriaController::class, 'create'])->name('categoria.create');
        Route::post('/categoria', [categoriaController::class, 'store'])->name('categoria.store');
        Route::get('/categoria/{id}', [categoriaController::class, 'show'])->name('categoria.show');
        Route::get('/categoria/{id}/edit', [categoriaController::class, 'edit'])->name('categoria.edit');
        Route::put('/categoria/{id}', [categoriaController::class, 'update'])->name('categoria.update');
        Route::delete('/categoria/{id}', [categoriaController::class, 'destroy'])->name('categoria.destroy');

        Route::get('/cliente', [clienteController::class, 'index'])->name('cliente.index');
        Route::get('/cliente/create', [clienteController::class, 'create'])->name('cliente.create');
        Route::post('/cliente', [clienteController::class, 'store'])->name('cliente.store');
        Route::get('/cliente/{id}', [clienteController::class, 'show'])->name('cliente.show');
        Route::get('/cliente/{id}/edit', [clienteController::class, 'edit'])->name('cliente.edit');
        Route::put('/cliente/{id}', [clienteController::class, 'update'])->name('cliente.update');
        Route::delete('/cliente/{id}', [clienteController::class, 'destroy'])->name('cliente.destroy');

        Route::get('/estoque', [estoqueController::class, 'index'])->name('estoque.index');
        Route::get('/estoque/create', [estoqueController::class, 'create'])->name('estoque.create');
        Route::post('/estoque', [estoqueController::class, 'store'])->name('estoque.store');
        Route::get('/estoque/{id}', [estoqueController::class, 'show'])->name('estoque.show');
        Route::get('/estoque/{id}/edit', [estoqueController::class, 'edit'])->name('estoque.edit');
        Route::put('/estoque/{id}', [estoqueController::class, 'update'])->name('estoque.update');
        Route::delete('/estoque/{id}', [estoqueController::class, 'destroy'])->name('estoque.destroy');

        Route::get('/itens-pedido', [itensPedidoController::class, 'index'])->name('itens_pedido.index');
        Route::get('/itens-pedido/create', [itensPedidoController::class, 'create'])->name('itens_pedido.create');
        Route::post('/itens-pedido', [itensPedidoController::class, 'store'])->name('itens_pedido.store');
        Route::get('/itens-pedido/{id}', [itensPedidoController::class, 'show'])->name('itens_pedido.show');
        Route::get('/itens-pedido/{id}/edit', [itensPedidoController::class, 'edit'])->name('itens_pedido.edit');
        Route::put('/itens-pedido/{id}', [itensPedidoController::class, 'update'])->name('itens_pedido.update');
        Route::delete('/itens-pedido/{id}', [itensPedidoController::class, 'destroy'])->name('itens_pedido.destroy');

        Route::get('/pedido', [pedidoController::class, 'index'])->name('pedido.index');
        Route::get('/pedido/create', [pedidoController::class, 'create'])->name('pedido.create');
        Route::post('/pedido', [pedidoController::class, 'store'])->name('pedido.store');
        Route::get('/pedido/{id}', [pedidoController::class, 'show'])->name('pedido.show');
        Route::get('/pedido/{id}/edit', [pedidoController::class, 'edit'])->name('pedido.edit');
        Route::put('/pedido/{id}', [pedidoController::class, 'update'])->name('pedido.update');
        Route::delete('/pedido/{id}', [pedidoController::class, 'destroy'])->name('pedido.destroy');

        Route::get('/produto', [produtoController::class, 'index'])->name('produto.index');
        Route::get('/produto/create', [produtoController::class, 'create'])->name('produto.create');
        Route::post('/produto', [produtoController::class, 'store'])->name('produto.store');
        Route::get('/produto/{id}', [produtoController::class, 'show'])->name('produto.show');
        Route::get('/produto/{id}/edit', [produtoController::class, 'edit'])->name('produto.edit');
        Route::put('/produto/{id}', [produtoController::class, 'update'])->name('produto.update');
        Route::delete('/produto/{id}', [produtoController::class, 'destroy'])->name('produto.destroy');

        Route::get('/produto-promocao', [produtoPromocaoController::class, 'index'])->name('produto_promocao.index');
        Route::get('/produto-promocao/create', [produtoPromocaoController::class, 'create'])->name('produto_promocao.create');
        Route::post('/produto-promocao', [produtoPromocaoController::class, 'store'])->name('produto_promocao.store');
        Route::get('/produto-promocao/{id}', [produtoPromocaoController::class, 'show'])->name('produto_promocao.show');
        Route::get('/produto-promocao/{id}/edit', [produtoPromocaoController::class, 'edit'])->name('produto_promocao.edit');
        Route::put('/produto-promocao/{id}', [produtoPromocaoController::class, 'update'])->name('produto_promocao.update');
        Route::delete('/produto-promocao/{id}', [produtoPromocaoController::class, 'destroy'])->name('produto_promocao.destroy');

        Route::get('/promocao', [promocaoController::class, 'index'])->name('promocao.index');
        Route::get('/promocao/create', [promocaoController::class, 'create'])->name('promocao.create');
        Route::post('/promocao', [promocaoController::class, 'store'])->name('promocao.store');
        Route::get('/promocao/{id}', [promocaoController::class, 'show'])->name('promocao.show');
        Route::get('/promocao/{id}/edit', [promocaoController::class, 'edit'])->name('promocao.edit');
        Route::put('/promocao/{id}', [promocaoController::class, 'update'])->name('promocao.update');
        Route::delete('/promocao/{id}', [promocaoController::class, 'destroy'])->name('promocao.destroy');
    });

});

require __DIR__.'/auth.php';

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Aluno;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// CRUD dos Alunos
Route::get('/', function () {
    return view('create');
});

Route::post('/cadastrar_aluno', function (Request $informacoes) {
    Aluno::create([
        'Nome' => $informacoes->nome,
        'Sobrenome' => $informacoes->sobrenome,
        'Email' => $informacoes->email,
        'Senha' => $informacoes->senha
    ]);
    return view('tables');
});

Route::get('/mostrar_aluno/{ID_Aluno}', function ($ID_Aluno) {
    $aluno = Aluno::findOrFail($ID_Aluno);
    echo $aluno->Nome;
    echo $aluno->Sobrenome;
    echo $aluno->Email;
    echo $aluno->Senha;
});

Route::get('/editar_aluno/{ID_Aluno}', function ($ID_Aluno) {
    $aluno = Aluno::findOrFail($ID_Aluno);
    return view('edit', ['aluno' => $aluno]);
});

Route::put('/atualizar_aluno/{ID_Aluno}', function (Request $informacoes, $ID_Aluno) {
    $aluno = Aluno::findOrFail($ID_Aluno);
    $aluno->Nome = $informacoes->nome;
    $aluno->Sobrenome = $informacoes->sobrenome;
    $aluno->Email = $informacoes->email;
    $aluno->Senha = $informacoes->senha;
    $aluno->save();
    return redirect('/tables')->with('success', 'Aluno atualizado com sucesso!');
});

Route::get('/excluir_aluno/{ID_Aluno}', function (Request $informacoes, $ID_Aluno) {
    $aluno = Aluno::findOrFail($ID_Aluno);
    $aluno->delete();
    echo "Aluno excluito com Sucesso!";
});
// Fim do CRUD dos Alunos

Route::get('/tables', function () {
    $alunos = App\Models\Aluno::all(); // Obtém todos os alunos do banco de dados
    return view('tables', ['alunos' => $alunos]);
});

Route::get('/editar_aluno/{ID_Aluno}', function ($ID_Aluno) {
    $aluno = App\Models\Aluno::findOrFail($ID_Aluno);
    return view('edit', ['aluno' => $aluno]);
    return redirect('/tables')->with('success', 'Aluno atualizado com sucesso!');
})->name('edit');

// Define a rota para a exclusão do aluno
Route::get('/excluir_aluno/{ID_Aluno}', function ($ID_Aluno) {
    $aluno = App\Models\Aluno::findOrFail($ID_Aluno);
    $aluno->delete();
    return redirect('/tables')->with('success', 'Aluno excluído com sucesso!');
})->name('delete');
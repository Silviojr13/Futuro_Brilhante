<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Aluno;
use App\Models\Professor;

// Rotas para CRUD dos Alunos
Route::get('/', function () {
    return view('home');
});

Route::post('/cadastrar_aluno', function (Request $request) {
    $request->validate([
        'nome' => 'required',
        'sobrenome' => 'required',
        'email' => 'required|email',
        'senha' => 'required',
    ]);

    Aluno::create([
        'Nome' => $request->nome,
        'Sobrenome' => $request->sobrenome,
        'Email' => $request->email,
        'Senha' => $request->senha
    ]);

    return redirect('/alunostb')->with('success', 'Aluno cadastrado com sucesso!');
});

Route::get('/cadastrarAluno', function () {
    return view('cadastrarAluno');
});

Route::get('/mostrar_aluno/{ID_Aluno}', function ($ID_Aluno) {
    $aluno = Aluno::findOrFail($ID_Aluno);
    return view('mostrar_aluno', ['aluno' => $aluno]);
});

Route::get('/editar_aluno/{ID_Aluno}', function ($ID_Aluno) {
    $aluno = Aluno::findOrFail($ID_Aluno);
    return view('editaluno', ['aluno' => $aluno]);
})->name('editAluno');

Route::put('/atualizar_aluno/{ID_Aluno}', function (Request $request, $ID_Aluno) {
    $request->validate([
        'nome' => 'required',
        'sobrenome' => 'required',
        'email' => 'required|email',
        'senha' => 'required',
    ]);

    $aluno = Aluno::findOrFail($ID_Aluno);
    $aluno->update([
        'Nome' => $request->nome,
        'Sobrenome' => $request->sobrenome,
        'Email' => $request->email,
        'Senha' => $request->senha
    ]);

    return redirect('/alunostb')->with('success', 'Aluno atualizado com sucesso!');
});

Route::get('/excluir_aluno/{ID_Aluno}', function ($ID_Aluno) {
    $aluno = Aluno::findOrFail($ID_Aluno);
    $aluno->delete();
    return redirect('/alunostb')->with('success', 'Aluno excluído com sucesso!');
})->name('deleteAluno');

Route::get('/alunostb', function () {
    $alunos = Aluno::all();
    return view('alunostb', ['alunos' => $alunos]);
});


// Rotas para CRUD dos Professores

Route::post('/cadastrar_professor', function (Request $request) {
    $request->validate([
        'nome' => 'required',
        'sobrenome' => 'required',
        'email' => 'required|email',
        'senha' => 'required',
    ]);

    Professor::create([
        'Nome' => $request->nome,
        'Sobrenome' => $request->sobrenome,
        'Email' => $request->email,
        'Senha' => $request->senha
    ]);

    return redirect('/professorestb')->with('success', 'Professor cadastrado com sucesso!');
});

Route::get('/cadastrarProfessor', function () {
    return view('cadastrarProfessor');
});

Route::get('/mostrar_professor/{ID_Professor}', function ($ID_Professor) {
    $professor = Professor::findOrFail($ID_Professor);
    return view('mostrar_professor', ['professor' => $professor]);
});

Route::get('/editar_professor/{ID_Professor}', function ($ID_Professor) {
    $professor = Professor::findOrFail($ID_Professor);
    return view('editprofessor', ['professor' => $professor]);
});


Route::put('/atualizar_professor/{ID_Professor}', function (Request $request, $ID_Professor) {
    $request->validate([
        'nome' => 'required',
        'sobrenome' => 'required',
        'email' => 'required|email',
        'senha' => 'required',
    ]);

    $professor = Professor::findOrFail($ID_Professor);
    $professor->update([
        'Nome' => $request->nome,
        'Sobrenome' => $request->sobrenome,
        'Email' => $request->email,
        'Senha' => $request->senha
    ]);

    return redirect('/professorestb')->with('success', 'Professor atualizado com sucesso!');
});

Route::get('/excluir_professor/{ID_Professor}', function ($ID_Professor) {
    $professor = Professor::findOrFail($ID_Professor);
    $professor->delete();
    return redirect('/professorestb')->with('success', 'Professor excluído com sucesso!');
});

Route::get('/professorestb', function () {
    $professores = Professor::all();
    return view('professorestb', ['professores' => $professores]);
});

<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Post;
use App\Http\Controllers\PostController;

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
        'nome' => $request->nome,
        'sobrenome' => $request->sobrenome,
        'email' => $request->email,
        'senha' => $request->senha
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
        'nome' => $request->nome,
        'sobrenome' => $request->sobrenome,
        'email' => $request->email,
        'senha' => $request->senha
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

// =========================================================================================================================================
// Rotas para CRUD dos Professores

Route::post('/cadastrar_professor', function (Request $request) {
    $request->validate([
        'nome' => 'required',
        'sobrenome' => 'required',
        'email' => 'required|email',
        'senha' => 'required',
    ]);

    Professor::create([
        'nome' => $request->nome,
        'sobrenome' => $request->sobrenome,
        'email' => $request->email,
        'senha' => $request->senha
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
        'nome' => $request->nome,
        'sobrenome' => $request->sobrenome,
        'email' => $request->email,
        'senha' => $request->senha
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


//=========================================================================================================================
// CRUD para Post

Route::get('/cadastrarPost', function () {
    return view('cadastrarPost');
});

// Rota para cadastrar uma postagem
Route::post('/cadastrar_post', function (Request $request) {
    // Validação dos dados da postagem
    $request->validate([
        'titulo' => 'required',
        'descricao' => 'required',
        'data_publicacao' => 'required|date',
        'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Salvar a imagem
    $imagem = $request->file('imagem');
    $nomeImagem = time().'.'.$imagem->extension();
    $caminho = public_path('/img');
    $imagem->move($caminho, $nomeImagem);

    // Criação da postagem no banco de dados
    Post::create([
        'titulo' => $request->titulo,
        'descricao' => $request->descricao,
        'data_publicacao' => $request->data_publicacao,
        'imagem' => $nomeImagem,
    ]);

    return redirect('/')->with('success', 'Postagem cadastrada com sucesso!');
});

// Rota para exibir uma postagem específica
Route::get('/mostrar_post/{ID_Post}', function ($ID_Post) {
    $post = Post::findOrFail($ID_Post);
    return view('mostrar_post', ['post' => $post]);
});

// Rota para editar uma postagem
Route::get('/editar_post/{ID_Post}', function ($ID_Post) {
    $post = Post::findOrFail($ID_Post);
    return view('editpost', ['post' => $post]);
});

Route::put('/atualizar_post/{ID_Post}', function (Request $request, $ID_Post) {
    $request->validate([
        'titulo' => 'required',
        'descricao' => 'required',
        'data_publicacao' => 'required|date',
        'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post = Post::findOrFail($ID_Post);

    // Atualiza a imagem, se fornecida
    if ($request->hasFile('imagem')) {
        $imagem = $request->file('imagem');
        $nomeImagem = time().'.'.$imagem->extension();
        $caminho = public_path('/img');
        $imagem->move($caminho, $nomeImagem);
        $post->imagem = $nomeImagem;
    }

    $post->update([
        'titulo' => $request->titulo,
        'descricao' => $request->descricao,
        'data_publicacao' => $request->data_publicacao,
    ]);

    return redirect('/')->with('success', 'Postagem atualizada com sucesso!');
});

// Rota para excluir uma postagem
Route::get('/excluir_post/{ID_Post}', function ($ID_Post) {
    $post = Post::findOrFail($ID_Post);
    
    // Verifica se a postagem possui uma imagem
    if ($post->imagem) {
        $caminhoImagem = public_path('img/' . $post->imagem);
        
        // Verifica se o arquivo de imagem existe antes de excluir
        if (File::exists($caminhoImagem)) {
            // Exclui a imagem
            File::delete($caminhoImagem);
        }
    }
    
    // Exclui a postagem
    $post->delete();
    
    return redirect('/')->with('success', 'Postagem excluída com sucesso!');
})->name('excluir_post');

// Rota para exibir todas as postagens
Route::get('/', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});

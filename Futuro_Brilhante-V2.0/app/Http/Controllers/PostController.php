<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titulo' => 'required',
            'descricao' => 'required',
            'data_publicacao' => 'required',
            // 'tag_id' => 'required',
            // 'coordenador_id' => 'required',
        ]);

        $imagem = $request->file('imagem');
        $nomeImagem = time().'.'.$imagem->extension();
        $caminho = public_path('/img');
        $imagem->move($caminho, $nomeImagem);

        $post = new Post();
        $post->titulo = $request->titulo;
        $post->descricao = $request->descricao;
        $post->data_publicacao = $request->data_publicacao;
        $post->imagem = $nomeImagem;
        // $post->tag_id = $request->tag_id;
        // $post->coordenador_id = $request->coordenador_id;
        $post->save();

        return redirect('/criar_post')->with('success', 'Post criado com sucesso!');
    }
}

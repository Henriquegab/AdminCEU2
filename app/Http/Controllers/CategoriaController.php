<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.lista',['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = [
            'categoria' => 'required|unique:categorias,categoria',
            'preco' => 'required|gte:0'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',
            'preco.gte' => 'O preço não pode ser menor que 0!',
            'unique' => 'Essa categoria já existe!',
        ];


        $request->validate($regras, $feedback);



        Categoria::create($request->all());

        return view('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {

        //dd($categoria);
        $regras = [
            'categoria' => 'required|unique:categorias,categoria,' .$categoria->id,
            'preco' => 'required|gte:0'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',
            'preco.gte' => 'O preço não pode ser menor que 0!',
            'unique' => 'Essa categoria já existe!',
        ];


        $request->validate($regras, $feedback);



        $categoria->update($request->all());



        return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $procura = Aluno::where('categoria_id', $categoria->id)->withTrashed()->get();
        if($procura->first()){
            return redirect()->back()->with('error', 'Essa categoria está sendo utilizada por algum aluno cadastrado!');
        }
        else{

            $deletar = Categoria::where('id', $categoria->id);
            $deletar->delete();
            return redirect()->route('categorias.index');

        }

    }
}

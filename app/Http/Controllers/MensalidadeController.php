<?php

namespace App\Http\Controllers;

use App\Models\Mensalidade;
use Illuminate\Http\Request;

class MensalidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mensalidade.categoria');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'categoria' => 'required|unique:mensalidades,categoria',
            'preco' => 'required|gte:0'
        ];

        $feedback = [
            'required' => 'O campo :atribute é obrigatório!',
            'preco.gte' => 'O preço não pode ser menor que 0!',
            'unique' => 'Essa categoria já existe!',
        ];


        $request->validate($regras, $feedback);



        Mensalidade::create($request->all());

        return view('home');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensalidade  $mensalidade
     * @return \Illuminate\Http\Response
     */
    public function show(Mensalidade $mensalidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensalidade  $mensalidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensalidade $mensalidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensalidade  $mensalidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensalidade $mensalidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensalidade  $mensalidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensalidade $mensalidade)
    {
        //
    }
}

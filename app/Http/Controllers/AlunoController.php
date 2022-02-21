<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('aluno.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $hoje = Carbon::now();

        // dd($hoje);

        $regras = [
            'nome' => 'required',
            'cpf' => 'required|cpf',
            'nascimento' => 'required|date|before:'.$hoje,
            'endereco' => 'required',
            'telefone' => 'required',
            'categoria_id' => 'required',
            'modalidade' => 'required',
            'data' => 'required|date',
            'horario' => 'required',
            'data_atestado' => 'required|date',
            
            
            
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',
            'cpf.cpf' => 'O cpf é inválido!',
            'nascimento.before' => 'A data de nascimento não pode ser no futuro e nem hoje!',
            
        ];


        $request->validate($regras, $feedback);

        

        Aluno::create($request->all());
        
        

        return view('home');
    









    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $aluno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        //
    }
}

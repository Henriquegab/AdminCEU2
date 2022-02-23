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
        $alunos = Aluno::all();
        return view('aluno.index',['alunos' => $alunos]);
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
        

        $hoje = Carbon::now();

        dd($request);

        // dd($request->all());

        $regras = [
            'nome' => 'required',
            'cpf' => 'required|cpf|unique:alunos',
            'nascimento' => 'required|date|before_or_equal:'.$hoje,
            'endereco' => 'required',
            'telefone' => 'required',
            'categoria_id' => 'required',
            'modalidade' => 'required',
            
            'inicio' => 'required|different:termino',
            'termino' => 'required|different:inicio',
            'data_atestado' => 'required|date|before:'.$hoje,
            
            
            
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',
            'cpf.cpf' => 'O cpf é inválido!',
            'cpf.unique' => 'O cpf ja existe!',
            'nascimento.before_or_equal' => 'A data de nascimento não pode ser no futuro e nem hoje!',
            'data_atestado.before' => 'A data do atestado não pode ser no futuro!',
            'inicio.different' => 'O início não pode ser igual ao termino!',
            'termino.different' => 'O termino não pode ser igual ao início!',
            
        ];

        

        $request->validate($regras, $feedback);

        
        

        

        Aluno::create($request->all());
        
        

        return redirect()->route('alunos.index');
    









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
        $deletar = Aluno::find($aluno->id);
        $deletar->delete();
        return redirect()->route('alunos.index');
    }
}

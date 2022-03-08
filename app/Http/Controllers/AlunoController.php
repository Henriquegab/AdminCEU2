<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Periodofiscal;
use App\Models\Pagamento;

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

    public function excluidos()
    {
        $alunos = Aluno::onlyTrashed()->get();

        

        return view('aluno.excluidos',['alunos' => $alunos]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */

    public function restore(Request $request, $id)
    {
        
        
        
        $aluno = Aluno::onlyTrashed()->where('id', $id)->get()->first();
        
        if($aluno){
            $aluno->restore();
        }

        

        return redirect()->route('alunos.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        
        $alunos = Aluno::all();

        // dd($alunos);


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

        // dd($request);

        // dd($request->all());

        $regras = [
            'nome' => 'required',
            'cpf' => 'required|cpf|unique:alunos',
            'nascimento' => 'required|date|before_or_equal:'.$hoje,
            'endereco' => 'required',
            
            'categoria_id' => 'required',
            'modalidade' => 'required',
            
            'inicio' => 'required|different:termino',
            'termino' => 'required|different:inicio',
            'data_atestado' => 'required|date|before:'.$hoje,
            'dia' => 'required'
            
            
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
        $count = 0;

        foreach ($request->dia as $dia) {
            if($count == 0){
                $request['dias'] = $dia;
            }
            else{
                $request['dias'] = $request->dias.' '.$dia;
            };
            $count++;
            
        }

        
        
        // dd($request->all());

        

        $aluno = Aluno::create($request->all());
        
        
        

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
        $categorias = Categoria::all();
        return view('aluno.edit', ['categorias' => $categorias, 'aluno' => $aluno]);
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
        $hoje = Carbon::now();

        dd($request);

        // dd($request);

        // dd($request->all());

        $regras = [
            'nome' => 'required',
            'cpf' => 'required|cpf|unique:alunos,cpf,' .$aluno->id,
            'nascimento' => 'required|date|before_or_equal:'.$hoje,
            'endereco' => 'required',
            
            'categoria_id' => 'required',
            'modalidade' => 'required',
            
            'inicio' => 'required|different:termino',
            'termino' => 'required|different:inicio',
            'data_atestado' => 'required|date|before:'.$hoje,
            // 'dia' => 'required'
            
            
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
        $count = 0;

        foreach ($request->dia as $dia) {
            if($count == 0){
                $request['dias'] = $dia;
            }
            else{
                $request['dias'] = $request->dias.' '.$dia;
            };
            $count++;
            
        }

        
        
        // dd($request->all());

        

        $aluno->update($request->all());
        
        
        

        return redirect()->route('alunos.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        $deletarAluno = Aluno::find($aluno->id);
        $deletarAluno->delete();
        return redirect()->route('alunos.index');
    }

    
}

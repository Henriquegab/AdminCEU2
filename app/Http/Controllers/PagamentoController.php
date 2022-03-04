<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Pagamento;
use App\Models\Aluno;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::all();
        $pagamentos = Pagamento::all();

        // dd($alunos);


        return view('pagamento.index',['alunos' => $alunos, 'pagamentos' => $pagamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alunos = Aluno::all();
        return view('pagamento.create', ['alunos' => $alunos]);
    }
    public function create2(Request $request)
    {
        $aluno = Aluno::find($request->aluno_id);
        return view('pagamento.create2', ['aluno' => $aluno]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Aluno $aluno, Request $request)
    {
        $hoje = Carbon::now();

        // dd($aluno);

        // dd($request);

        // dd($request->all());

        $regras = [
            
            'valor_pago' => 'required|gte:0',
            'data' => 'required|date|before:'.$hoje,
            
            
            
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',
            'data.date' => 'A data tem que ser válida!',
            'data.before' => 'A data não pode ser no futuro!',
            
        ];

        

        $request->validate($regras, $feedback);

        
        

        

        $pagamento = Pagamento::create($request->all());

        $aluno->pagamento_id = $pagamento->id;

        $aluno->save();
        

        return redirect()->route('alunos.index');
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function show(Pagamento $pagamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagamento $pagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagamento $pagamento, Aluno $aluno)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagamento $pagamento)
    {
        //
    }
}

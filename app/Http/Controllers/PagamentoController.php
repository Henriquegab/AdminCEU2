<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Pagamento;
use App\Models\Periodofiscal;
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
        $alunos = Aluno::withTrashed()->get();
        // dd($alunos);
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

    public function create_relatorio()
    {
        $periodofiscal = Periodofiscal::all();
        return view('pagamento.create_relatorio', ['periodofiscal' => $periodofiscal]);
    }
    public function lista_relatorio(Request $request)
    {
        $alunos = Aluno::withTrashed()->get();
        $periodofiscal = Periodofiscal::find($request->periodofiscal);
        $pagamentos = Pagamento::where('periodo_fiscal', $periodofiscal->data);
        // dd($pagamentos->get());
        return view('pagamento.lista_relatorio', ['alunos' => $alunos, 'pagamentos' => $pagamentos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Aluno $aluno, Request $request)
    {
        // dd(1);
        $hoje = Carbon::now();

        // dd($aluno);

        // dd($request);

        // dd($request->all());

        

        
        // dd(Periodofiscal::all()->first()['data']);

        $request['periodo_fiscal'] = Periodofiscal::all()->last()['data'];
        $request['categoria'] = $aluno->categoria->categoria;
        $request['mensalidade'] = $aluno->categoria->preco;

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
        // dd($pagamento->aluno);
        $aluno = Aluno::find($pagamento->aluno_id);
        return view('pagamento.edit', ['pagamento' => $pagamento, 'aluno' => $aluno]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagamento $pagamento)
    {
        $pagamento->update([
            'valor_pago' => $request['valor_pago']
        ]);
        return view('home');
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

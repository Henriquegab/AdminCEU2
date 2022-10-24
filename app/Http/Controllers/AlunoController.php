<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Periodofiscal;
use App\Models\Pagamento;

use App\Models\Categoria;
use App\Models\Horario;
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

        // $teste = [];
        // $teste2 = [];

        // foreach ($alunos as $aluno) {
        //     $periodofiscal = Periodofiscal::all()->last();
        //     $periodofiscal->data = new Carbon($periodofiscal->data);





        //     $pagamento = Pagamento::where('periodo_fiscal', $periodofiscal->data->subMonth()->toDateString())->where('aluno_id', $aluno->id)->first();
        //     $periodofiscal->data->addMonth();
        //     if (empty($pagamento) && $aluno->pagamento_id == NULL) {
        //         array_push($teste, $aluno->nome);
        //     }
        //     else {

        //         array_push($teste2, $pagamento->id);

        //     }

        // }
        // dd($teste);

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
    public function create2()
    {
        $categorias = Categoria::all();
        return view('aluno.create2', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $categorias = Categoria::all();

        $hoje = Carbon::now();

        // dd($request);

        // dd($request->all());

        $input=$request->all();

        // dd($input);

        if(
            ($input['inicio_segunda'] == NULL || $input['termino_segunda'] == NULL) &&
            ($input['inicio_terca'] == NULL || $input['termino_terca'] == NULL) &&
            ($input['inicio_quarta'] == NULL || $input['termino_quarta'] == NULL) &&
            ($input['inicio_quinta'] == NULL || $input['termino_quinta'] == NULL) &&
            ($input['inicio_sexta'] == NULL || $input['termino_sexta'] == NULL))

            {



            return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira pelo menos um horário!');
        }









        $regras = [
            'nome' => 'required',
            'cpf' => 'required|cpf|unique:alunos',
            'nascimento' => 'required|date|before_or_equal:'.$hoje,
            'endereco' => 'required',

            'categoria_id' => 'required',



            // 'inicio_segunda' => 'before_or_equal:termino_segunda|different:termino_segunda',
            // 'termino_segunda' => 'after_or_equal:inicio_segunda|different:inicio_segunda',

            // 'inicio_terca' => 'before_or_equal:termino_terca|different:termino_terca',
            // 'termino_terca' => 'after_or_equal:inicio_terca|different:inicio_terca',

            // 'inicio_quarta' => 'before_or_equal:termino_quarta|different:termino_quarta',
            // 'termino_quarta' => 'after_or_equal:inicio_quarta|different:inicio_quarta',

            // 'inicio_quinta' => 'before_or_equal:termino_quinta|different:termino_quinta',
            // 'termino_quinta' => 'after_or_equal:inicio_quinta|different:inicio_quinta',

            // 'inicio_sexta' => 'before_or_equal:termino_sexta|different:termino_sexta',
            // 'termino_sexta' => 'after_or_equal:inicio_sexta|different:inicio_sexta',

            'data_atestado' => 'required|date|before:'.$hoje,



        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',
            'cpf.cpf' => 'O cpf é inválido!',
            'cpf.unique' => 'O cpf ja existe!',
            'nascimento.before_or_equal' => 'A data de nascimento não pode ser no futuro e nem hoje!',
            'data_atestado.before' => 'A data do atestado não pode ser no futuro!',


        ];



        $request->validate($regras, $feedback);
        // $count = 0;

        // foreach ($request->dia as $dia) {
        //     if($count == 0){
        //         $request['dias'] = $dia;
        //     }
        //     else{
        //         $request['dias'] = $request->dias.' '.$dia;
        //     };
        //     $count++;

        // }



        // dd($request->all());





        if($input['inicio_segunda'] != NULL && $input['termino_segunda'] != NULL){

            if($input['inicio_segunda'] >= $input['termino_segunda']){
                return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Segunda-Feira!');
            }



        }
        if($input['inicio_terca'] != NULL && $input['termino_terca'] != NULL){


            if($input['inicio_terca'] >= $input['termino_terca']){
                return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Terça-Feira!');
            }


        }
        if($input['inicio_quarta'] != NULL && $input['termino_quarta'] != NULL){

            if($input['inicio_quarta'] >= $input['termino_quarta']){
                return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Quarta-Feira!');
            }


        }
        if($input['inicio_quinta'] != NULL && $input['termino_quinta'] != NULL){


        if($input['inicio_quinta'] >= $input['termino_quinta']){
            return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Quinta-Feira!');
        }


        }
        if($input['inicio_sexta'] != NULL && $input['termino_sexta'] != NULL){

            if($input['inicio_sexta'] >= $input['termino_sexta']){
                return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Sexta-Feira!');
            }


        }



        $aluno = Aluno::create($input);



        if($input['inicio_segunda'] != NULL && $input['termino_segunda'] != NULL){

            if($input['inicio_segunda'] >= $input['termino_segunda']){
                return view('aluno.create', ['aluno' => $aluno])->with('error', 'insira um horário válido na Segunda-Feira!');
            }


            Horario::create([
                'aluno_id' => $aluno->id,
                'dia' =>  'segunda',
                'entrada' =>  $input['inicio_segunda'],
                'saida' =>  $input['termino_segunda']
            ]);
        }
        if($input['inicio_terca'] != NULL && $input['termino_terca'] != NULL){


            if($input['inicio_terca'] >= $input['termino_terca']){
                return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Terça-Feira!');
            }

            Horario::create([
                'aluno_id' => $aluno->id,
                'dia' =>  'terca',
                'entrada' =>  $input['inicio_terca'],
                'saida' =>  $input['termino_terca']
            ]);
        }
        if($input['inicio_quarta'] != NULL && $input['termino_quarta'] != NULL){

            if($input['inicio_quarta'] >= $input['termino_quarta']){
                return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Quarta-Feira!');
            }

            Horario::create([
                'aluno_id' => $aluno->id,
                'dia' =>  'quarta',
                'entrada' =>  $input['inicio_quarta'],
                'saida' =>  $input['termino_quarta']
            ]);
        }
        if($input['inicio_quinta'] != NULL && $input['termino_quinta'] != NULL){


        if($input['inicio_quinta'] >= $input['termino_quinta']){
            return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Quinta-Feira!');
        }

            Horario::create([
                'aluno_id' => $aluno->id,
                'dia' =>  'quinta',
                'entrada' =>  $input['inicio_quinta'],
                'saida' =>  $input['termino_quinta']
            ]);
        }
        if($input['inicio_sexta'] != NULL && $input['termino_sexta'] != NULL){

            if($input['inicio_sexta'] >= $input['termino_sexta']){
                return view('aluno.create', ['categorias' => $categorias, 'aluno' => $input])->with('error', 'insira um horário válido na Sexta-Feira!');
            }

            Horario::create([
                'aluno_id' => $aluno->id,
                'dia' =>  'sexta',
                'entrada' =>  $input['inicio_sexta'],
                'saida' =>  $input['termino_sexta']
            ]);
        }





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

        // dd($request);

        // dd($request);

        // dd($request->all());

        $regras = [
            'nome' => 'required',
            'cpf' => 'required|cpf|unique:alunos,cpf,' .$aluno->id,
            'nascimento' => 'required|date|before_or_equal:'.$hoje,
            'endereco' => 'required',

            'categoria_id' => 'required',
            // 'modalidade' => 'required',

            'inicio' => 'required|before_or_equal:termino|different:termino',
            'termino' => 'required|after_or_equal:inicio|different:inicio',
            'data_atestado' => 'required|date|before:'.$hoje,
            // 'dia' => 'required'


        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',
            'cpf.cpf' => 'O cpf é inválido!',
            'cpf.unique' => 'O cpf ja existe!',
            'nascimento.before_or_equal' => 'A data de nascimento não pode ser no futuro e nem hoje!',
            'data_atestado.before' => 'A data do atestado não pode ser no futuro!',
            // 'inicio.before_or_equal' => 'O início não pode ser maior do que o término!',
            // 'termino.after_or_equal' => 'O término não pode ser menor do que o início!',
            // 'inicio.different' => 'O início não pode ser igual ao término!',
            // 'termino.different' => 'O término não pode ser igual ao início!',

        ];



        $request->validate($regras, $feedback);
        // $count = 0;

        // foreach ($request->dia as $dia) {
        //     if($count == 0){
        //         $request['dias'] = $dia;
        //     }
        //     else{
        //         $request['dias'] = $request->dias.' '.$dia;
        //     };
        //     $count++;

        // }



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

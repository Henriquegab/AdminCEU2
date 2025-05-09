@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')





@stop

@section('content')

    <br>


    @php
    use App\Models\Categoria;
    use App\Models\Pagamento;
    use App\Models\Periodofiscal;
    use Carbon\Carbon;

    $heads = [
        ['label' => 'Nome', 'width' => 20],
        ['label' => 'CPF', 'width' => 20],


        ['label' => 'Categoria', 'width' => 20],
        ['label' => 'Dias', 'width' => 20],
        ['label' => 'Mensalidade', 'width' => 20],
        ['label' => 'Pagamento', 'width' => 15],
        ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pencil"></i>
                </button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </button>';

    $config = [
        'paging' => true,
        // 'filter' => true,

        'order' => [[0, 'asc']],
        'columns' => [['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => false]],
    ];



    @endphp



    <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable
        with-buttons beautify>
        @foreach ($alunos as $aluno)

        @php
            $periodofiscal = Periodofiscal::all()->last();
            $periodofiscal->data = new Carbon($periodofiscal->data);
            $aluno->created_at = new Carbon($aluno->created_at);
            $hoje = Carbon::now();




            $pagamento = Pagamento::where('periodo_fiscal', $periodofiscal->data->subMonth()->toDateString())->where('aluno_id', $aluno->id)->first();
            $periodofiscal->data->addMonth();
            //aluno ausente
            if (empty($pagamento) && $aluno->pagamento_id == NULL && $aluno->created_at->addMonth(1) <= $hoje) {
                $aluno->created_at->subMonth(1);
                $status = 1;
                $bgcolor = 'rgba(255, 160, 160, 0.250)';
            }
            else {

                $status = 0;
                $bgcolor = '';
            }
            // dd(2);

        @endphp
            <tr style="background-color: {{ $bgcolor }}">
                @php

                    if ($aluno->pagamento_id) {
                        $pago = $aluno->pagamento->valor_pago;
                        if ($pago < $aluno->categoria->preco && $pago > 0) {
                            //se o preço for menor que o valor da categoria mas maior que 0 a cor fica amarela
                            $cor = '#FFBA41';
                            $badge = 'badge badge-warning';
                            $pago = 'R$ ' . number_format($pago, 2);
                        }
                        else {
                            if ($pago == 0) {
                                //se o valor pago for 0 é considerado isento
                                $pago = 'Isento!';
                                $cor = 'purple';
                                $badge = 'badge badge-light';
                            }
                            else {
                                //se o valor for igual ou maior que o da categoria ficará verde
                                $cor = 'LimeGreen';
                                $pago = 'R$ ' . number_format($pago, 2);
                                $badge = 'badge badge-success';

                            }

                        }


                    } else {
                        //se nenhum pagamento foi constado ficará vermelho com status de não pago
                        if ($status == 1) {
                            $pago = 'Aluno Ausente!';
                            $cor = 'purple';
                            $badge = 'badge badge-dark';
                        }
                        else {
                            $pago = 'Não pago!';
                            $cor = 'Red';
                            $badge = 'badge badge-danger';
                        }


                    }
                    $dias = '';

                    foreach ($aluno->horarios as $horario) {
                            //lógica para printar os dias na lista
                        if ($horario->dia == 'segunda') {
                            $dias = $dias.'Segunda';
                        }
                        if ($horario->dia == 'terca') {
                            $dias = $dias.' '.'Terça';
                        }
                        if ($horario->dia == 'quarta') {
                            $dias = $dias.' '.'Quarta';
                        }
                        if ($horario->dia == 'quinta') {
                            $dias = $dias.' '.'Quinta';
                        }
                        if ($horario->dia == 'sexta') {
                            $dias = $dias.' '.'Sexta';
                        }
                    }




                @endphp

                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->cpf }}</td>
                {{-- <td>{{ $aluno->modalidade }}</td> --}}
                {{-- <td>{{ substr($aluno->inicio, 0, 5) }} até {{ substr($aluno->termino, 0, 5) }}</td> --}}
                <td>{{ $aluno->categoria->categoria }}</td>
                <td>{{ $dias }}</td>
                <td><span class="badge badge-secondary">{{ 'R$ ' . number_format($aluno->categoria->preco, 2) }}</span></td>
                <td style="color:{{ $cor }}">
                    <span class="{{ $badge }}">{{ $pago }}</span></td>
                <td>



                    <form action="{{ route('alunos.edit', $aluno->id) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                            <i class="fa fa-lg fa-fw fa-pencil"></i>
                        </button>
                    </form>








                    <form method="post" action="{{ route('alunos.destroy', $aluno->id) }}">


                        <x-adminlte-modal id="{{ 'ctz' . $aluno->id }}" title="Confirmar Exclusão" size="md"
                            theme="warning" icon="fas fa-exclamation-circle" v-centered static-backdrop>
                            <div style="height:50px;">Você tem Certeza que deseja excluir o(a) aluno(a)
                                {{ $aluno->nome }}?</div>
                            <x-slot name="footerSlot">
                                <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Sim" />


                                <x-adminlte-button theme="danger" label="Não" data-dismiss="modal" />
                                @csrf
                            </x-slot>
                        </x-adminlte-modal>




                        @method('DELETE')


                    </form>

                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" data-toggle="modal"
                        data-target="{{ '#ctz' . $aluno->id }}" title="Deletar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>

                </td>
            </tr>
        @endforeach

    </x-adminlte-datatable>













@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')



@stop

@section('footer')
<h6 align="center" style=""></a>AdminCEU - <a href="https://www.linkedin.com/in/henrique-gabriel-siqueira-da-cruz-0826a4146/">Henrique gabriel</a>  Todos os Direitos Reservados <a href="https://github.com/Henriquegab" class="fa fa-github"></a></h6>

@stop

@extends('adminlte::page')

@section('title', 'Histórico de Pagamentos')

@section('content_header')





@stop

@section('content')

    <br>


    @php
    use App\Models\Categoria;
    use App\Models\Aluno;
    use App\Models\Pagamento;
    use Carbon\Carbon;

    $heads = [
        ['label' => 'Id', 'width' => 5],
        ['label' => 'Nome', 'width' => 20],
        ['label' => 'CPF', 'width' => 20], 
        ['label' => 'Data', 'width' => 10],
        ['label' => 'Categoria', 'width' => 20],
        ['label' => 'Mês Referencia', 'width' => 10],
        ['label' => 'Mensalidade', 'width' => 18], 
        ['label' => 'Valor Pago', 'width' => 20],
        
        ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </button>';

    $config = [
        'paging' => true,
        'filter' => true,

        'order' => [[0, 'asc']],
        'columns' => [['orderable' => true],['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true],['orderable' => false]],
    ];

    @endphp

    

    <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable
        with-buttons beautify>
        
        


        @foreach ($pagamentos as $pagamento)
                @php
                    $pagamento->data = new Carbon($pagamento->data);
                    $pagamento->data = $pagamento->data->isoFormat('DD/MM/YYYY');
                    $pagamento->periodo_fiscal = new Carbon($pagamento->periodo_fiscal);
                    $pagamento->periodo_fiscal = $pagamento->periodo_fiscal->isoFormat('MM-YYYY');
                    

                    // dd(Aluno::find($pagamento->aluno_id)->nome);

                @endphp
            <tr>
                

                <td>{{ $pagamento->id }}</td>
                <td>{{ Aluno::withTrashed()->find($pagamento->aluno_id)->nome }}</td>
                <td>{{ Aluno::withTrashed()->find($pagamento->aluno_id)->cpf }}</td>
                <td>{{ $pagamento->data }}</td>
                <td>{{ Aluno::withTrashed()->find($pagamento->aluno_id)->categoria->categoria }}</td>
                <td>{{ $pagamento->periodo_fiscal }}</td>
                <td>{{ 'R$ ' . number_format(Aluno::withTrashed()->find($pagamento->aluno_id)->categoria->preco, 2) }}</td>
                <td>{{ 'R$ ' . number_format($pagamento->valor_pago, 2) }}</td>
                
                    
                    
                <td>
                    



                    <form action="{{ route('pagamentos.edit', $pagamento->id) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </form>



                    




                    

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
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos Reservados</h6>
    
@stop

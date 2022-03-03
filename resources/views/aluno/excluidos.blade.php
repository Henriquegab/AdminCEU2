@extends('adminlte::page')

@section('title', 'Alunos Excluidos')

@section('content_header')





@stop

@section('content')

    <br>


    @php
    use App\Models\Categoria;
    use App\Models\Pagamento;

    $heads = [
        ['label' => 'Nome', 'width' => 20], 
        ['label' => 'CPF', 'width' => 20], 
        ['label' => 'Modalidade', 'width' => 20], 
        ['label' => 'Horário', 'width' => 15], 
        ['label' => 'Categoria', 'width' => 20], 
        ['label' => 'Dias', 'width' => 20], 
        ['label' => 'Mensalidade', 'width' => 20], 
        ['label' => 'Pagamento', 'width' => 15], 
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
        'columns' => [['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => false]],
    ];

    @endphp

    

    <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable
        with-buttons beautify>
        @foreach ($alunos as $aluno)
            
            <tr>
                @php
                    
                    if ($aluno->pagamento_id) {
                        $pago = $aluno->pagamento->valor_pago;
                        if ($pago < $aluno->categoria->preco) {
                            $cor = '#FFBA41';
                        }
                        else {
                            $cor = 'LimeGreen';
                        }
                        $pago = 'R$ ' . number_format($pago, 2);

                    } else {
                        $pago = 'Não pago!';
                        $cor = 'Red';
                    }

                    
                    
                @endphp

                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->cpf }}</td>
                <td>{{ $aluno->modalidade }}</td>
                <td>{{ substr($aluno->inicio, 0, 5) }} até {{ substr($aluno->termino, 0, 5) }}</td>
                <td>{{ $aluno->categoria->categoria }}</td>
                <td>{{ $aluno->dias }}</td>
                <td>{{ 'R$ ' . number_format($aluno->categoria->preco, 2) }}</td>
                <td style="color:{{ $cor }}">
                    {{ $pago }}</td>
                <td>



                    



                    <form action="{{ route('alunos.show', $aluno->id) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Abrir Pedido" type="submit">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>
                    </form>




                    <form method="post" action="{{ route('alunos.restore', $aluno->id) }}">


                        <x-adminlte-modal id="{{ 'ctz' . $aluno->id }}" title="Confirmar Exclusão" size="md"
                            theme="warning" icon="fas fa-exclamation-circle" v-centered static-backdrop>
                            <div style="height:50px;">Você tem Certeza que deseja restaurar o(a) aluno(a)
                                {{ $aluno->nome }}?</div>
                            <x-slot name="footerSlot">
                                <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Sim" />

                                <input type="hidden" value="{{ $aluno->id }}" name= "id">
                                <x-adminlte-button theme="danger" label="Não" data-dismiss="modal" />
                                @csrf
                                
                            </x-slot>
                        </x-adminlte-modal>




                        


                    </form>

                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" data-toggle="modal"
                        data-target="{{ '#ctz' . $aluno->id }}" title="Deletar">
                        <i class="fa fa-lg fa-fw fa-backward"></i>
                        
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
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos Reservados</h6>
    
@stop

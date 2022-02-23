@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')





@stop

@section('content')

    <br>


    @php
    use App\Models\Categoria;
    use App\Models\Pagamento;

    $heads = [['label' => 'Nome', 'width' => 20], ['label' => 'CPF', 'width' => 20], ['label' => 'Modalidade', 'width' => 20], ['label' => 'Horário', 'width' => 15], ['label' => 'Categoria', 'width' => 20], ['label' => 'Mensalidade', 'width' => 20], ['label' => 'Pagamento', 'width' => 15], ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
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
        'columns' => [['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => false]],
    ];

    @endphp

    {{-- <div class="input-group-prepend">
    <select class="custom-select" id="inputGroupSelect04">
      <option selected>Choose...</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <div class="input-group">
        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
    </div>
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button">Button</button>
    </div>
  </div>
  <br> --}}

    <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable
        with-buttons beautify>
        @foreach ($alunos as $aluno)
            <tr>
                @php
                    
                    if (Pagamento::where('aluno_id', $aluno->id)->exists()) {
                        $pago = Pagamento::where('aluno_id', $aluno->id)->first()->valor_pago;
                        $pago = 'R$ ' . number_format($pago, 2);
                    } else {
                        $pago = 'Não pago!';
                    }
                    
                @endphp

                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->cpf }}</td>
                <td>{{ $aluno->modalidade }}</td>
                <td>{{ substr($aluno->inicio, 0, 5) }} até {{ substr($aluno->termino, 0, 5) }}</td>
                <td>{{ $aluno->categoria->categoria }}</td>
                <td>{{ 'R$ ' . number_format($aluno->categoria->preco, 2) }}</td>
                <td style="color:{{ Pagamento::where('aluno_id', $aluno->id)->exists() ? 'LimeGreen' : 'red' }}">
                    {{ $pago }}</td>
                <td>



                    <form action="{{ route('alunos.edit', $aluno->id) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </form>



                    <form action="{{ route('alunos.show', $aluno->id) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Abrir Pedido" type="submit">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
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

@extends('adminlte::page')

@section('title', 'Lista de Categorias')

@section('content_header')





@stop

@section('content')

<br>


@php
$heads = [
    ['label' => 'Id', 'width' => 20],
    ['label' => 'Nome', 'width' => 20],
    ['label' => 'Preço', 'width' => 20],
    ['label' => 'Ações', 'no-export' => true, 'width' => 5]
];
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
    'language' => ['url' => 'dataTables.pt-BR.json'],
    
    'order' => [[1, 'asc']],
    'columns' => [['orderable' => true], ['orderable' => true], ['orderable' => true], ['orderable' => false]],
];
     /*   $cont = 1;

        if ($clientes->currentPage() != 1) {
            $cont = 30 * ($clientes->currentPage() - 1);
        }
        
        */

@endphp
    

    
    <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable with-buttons beautify>
        @foreach($categorias as $categoria)
            <tr>
                
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->categoria}}</td>
                <td>{{'R$ '.number_format($categoria->preco, 2) }}</td>
                
                <td>
                
                <form action="{{ route('categorias.edit', $categoria->id) }}">
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                        <i class="fa fa-lg fa-fw fa-pencil"></i>
                    </button>
                </form>
                
                

                
                
                

                
                <form method="post" action="{{ route('categorias.destroy', $categoria->id) }}">


                    <x-adminlte-modal id="{{ 'ctz'.$categoria->id }}" title="Confirmar Exclusão" size="md" theme="warning"
                        icon="fas fa-exclamation-circle" v-centered static-backdrop >
                        <div style="height:50px;">Você tem Certeza que deseja excluir a categoria {{ $categoria->categoria }}?</div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Sim"/>
                            
                            
                            <x-adminlte-button theme="danger" label="Não" data-dismiss="modal"/>
                            @csrf
                        </x-slot>
                    </x-adminlte-modal>

                   

                    
                    @method('DELETE')
                    
                    
                </form>
                
                <button class="btn btn-xs btn-default text-danger mx-1 shadow"  data-toggle="modal" data-target="{{ '#ctz'.$categoria->id }}" title="Deletar">
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
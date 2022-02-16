@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')
    
@stop

@section('content')

<script>

$(document).on('keydown', '[data-mask-for-cpf-cnpj]', function (e) {

var digit = e.key.replace(/\D/g, '');

var value = $(this).val().replace(/\D/g, '');

var size = value.concat(digit).length;

$(this).mask((size <= 11) ? '000.000.000-00' : '00.000.000/0000-00');
});

</script>

<x-adminlte-card class="mt-3" title="Ficha de Inscrição" theme="dark" icon="far fa-fw fa-file">
   
    <form method="post" action="{{ route('alunos.store') }}">
        @csrf
           
       <div class="row">
        
            <x-adminlte-input enable-old-support name="nome" type="name" placeholder="Henrique gabriel" fgroup-class="col-md-5" label="Nome"/>
        

           

            <div class="form-group mb-4">
                <label for="CPF">CPF</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" data-mask-for-cpf-cnpj />
            
            </div>

           <x-adminlte-input enable-old-support name="cpf" type="text" label="CPF" placeholder="11111111111"
                fgroup-class="col-md-5"/>
           
           <x-adminlte-input enable-old-support name="email" type="email" placeholder="mail@example.com" fgroup-class="col-md-5" label="Email"/>

           
           
               
       </div>
       <div class="row">
           <x-adminlte-select enable-old-support label="Sexo" name="sexo" fgroup-class="col-md-3">
               <x-adminlte-options :options="['Masculino', 'Feminino', 'Outros']"
                   empty-option="Selecione uma opção"/>
           </x-adminlte-select>
       
           <x-adminlte-input enable-old-support name="endereco" type="name" placeholder="Rua Joaquim Costa" fgroup-class="col-md-4" label="Endereço"/>

           <x-adminlte-input enable-old-support name="numerocasa" type="name" label="Número" placeholder="2"
                   fgroup-class="col-md-1"/>

           <x-adminlte-input enable-old-support name="cep" type="name" label="CEP" placeholder="39402000"
           fgroup-class="col-md-2"/>

           <x-adminlte-input enable-old-support name="uf" type="name" placeholder="MG" fgroup-class="col-md-2" label="UF"/>
       </div>
       
       
           <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
   </form>


</x-adminlte-card>

    
        




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos Reservados</h6>
    
@stop
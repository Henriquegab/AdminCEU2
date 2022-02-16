@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')
    
@stop

@section('content')

<script> 
// função pra limitar campo de cpf pra ter apenas digitos
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>

<script>
    // função javascript pra evitar de fazer o submit caso haja campos invládios pelo frontend
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>

<x-adminlte-card class="mt-3" title="Ficha de Inscrição" theme="dark" icon="far fa-fw fa-file">
    
    <form method="post" action="{{ route('alunos.store') }}">
        @csrf
        
        <div class="form-row">


            <div class="col-md-6 mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Henrique Gabriel" required>
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o nome!
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" name="cpf" placeholder="111.444.777-99" data-mask="000.000.000-00" required>
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o CPF!
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="nascimento">Data de Nascimento</label>
                <input type="date" class="form-control" name="nascimento" placeholder="12/12/2012" required>
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o CPF!
                </div>
            </div>

            





        </div>
        <div class="form-row">

            <div class="col-md-6 mb-3">
                <label for="pai">Pai</label>
                <input type="text" class="form-control" name="pai" placeholder="Roberto Silveira">
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o nome!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="mae">Mãe</label>
                <input type="text" class="form-control" name="mae" placeholder="Maria do Carmo">
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o nome!
                </div>
            </div>


        </div>

        <div class="form-row">

            <div class="col-md-5 mb-3">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" name="endereco" placeholder="Rua do Cristal">
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o nome!
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <label for="numero">Número</label>
                <input type="text" class="form-control" name="numero" placeholder="123">
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o nome!
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" name="telefone" placeholder="(38) 94002-8922" data-mask="(00) 00000-0000">
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite o nome!
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="categoria">Categoria</label>
                <select class="form-control" name="categoria" required>
                    <option disabled selected value> Selecione uma Opção </option>
                    <option>Professor</option>
                    <option>Acadêmico</option>
                    <option>Servidor (Nível Superior)</option>
                    <option>Servidor (Nível Médio)</option>
                    <option>Comunidade</option>
                    <option>Conveniados</option>
                    <option>Comunidade</option>
                    <option>Comunidade</option>
                    <option>Comunidade</option>
                    <option>Comunidade</option>
                    <option>Outros</option>
                    
                </select>
            </div>


        </div>

        <button class="btn btn-primary" type="submit">Cadastrar</button>
        
           
       
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
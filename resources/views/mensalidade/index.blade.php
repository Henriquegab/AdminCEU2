@extends('adminlte::page')

@section('title', 'Cadastro de Categoria')

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

<x-adminlte-card class="mt-3" title="Cadastro de Categoria" theme="dark" icon="far fa-fw fa-file">
    
    <form method="post" action="{{ route('alunos.store') }}">
        @csrf
        
        <div class="form-row">


            <div class="col-md-5 mb-3">
                <label for="nome">Nome da categoria</label>
                <input type="text" class="form-control" name="categoria" placeholder="Acadêmico" required>
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Digite a Categoria!
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="dias">Quantidade de Dias</label>
                <select class="form-control" name="dias" required>
                    <option disabled selected value> Selecione uma Opção </option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>                  
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="preco">Preço (em reais)</label>
                <input type="number" class="form-control" name="preco" data-mask="000000" placeholder="40" required>
                <div class="valid-feedback">
                    Ok!
                </div>
                <div class="invalid-feedback">
                    Campo obrigatório!
                </div>
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
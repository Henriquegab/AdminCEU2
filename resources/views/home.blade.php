@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>

    

    
@stop

@section('content')
    
    @php
        



        $list = [6, 4, 7, 9, 3, 12];

$results = [];

for($i = 0; $i < count($list); $i++){

	for($j = 0; $j < count($list) ; $j++){

		if(!($i == $j)){
			
			if(($list[$i] + $list[$j]) == 13 ){
				

			array_push($results, "$list[$i] + $list[$j]");

			}
		

		}


	}


}

print_r($results);







    @endphp


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
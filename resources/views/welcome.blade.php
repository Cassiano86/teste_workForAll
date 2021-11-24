@extends('layouts.app')
@section('title_page', 'Página inicial')

@section('content')
    <div class="relative flex items-top justify-center">
        
        <div class="container">
            <h2 class="text-center {{config('app.bold')}}">Listagem clientes e suas categoria</h2>
            
            <table class="table table-hover text-center table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Estado</th>
                        <th scope='col'>Categoria</th>
                        <th scope='col'>Mais</th>
                    </tr>  
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->nome}}</td>
                        <td>{{$cliente->Estados->nome}}</td>
                        <td>{{$cliente->Categorias->nome}}</td>
                        <td>
                            @if(isset(auth()->user()->id))
                            <a href="{{route('cliente.show', encrypt($cliente->id))}}"  class='btn btn-sm btn-primary' data-toggle="tooltip" data-placement="top" title="Informação completa">
                                <i class="{{config('app.material')}}">add</i> informações
                            </a>
                            @else
                            <a href="#" class='btn btn-sm btn-primary' data-toggle="tooltip" data-placement="top" title="Faça seu login para acessar mais informações" disabled>
                                <i class="{{config('app.material')}}">add</i> informações
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan='4' class='text-secondary'>
                                <i class="{{config('app.material')}}">person_off</i> Nenhum cliente cadastrado até o momento
                            </td>
                        </tr>
                    @endforelse    
                </tbody>   
            </table>
            <div class="relative flex items-top justify-center">{{$clientes->links()}}</div>
        </div>
    </div>
    
    @push('js')
    <script src="{{asset('../js/clientes.js')}}"></script>
    @endpush
    @endsection
    
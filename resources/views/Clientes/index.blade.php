@extends('layouts.app')
@section('title_page', 'Gerenciamento de clientes')
@section('content')
<div class="container">    
    <div class="relative flex items-top justify-center">
        
        <div class="container">
            <h2 class="text-center {{config('app.bold')}}">Listagem de clientes</h2>

            <div class="d-flex justify-content-end">
                <a href="{{route('cliente.create')}}" class='btn btn-sm btn-success mr-3'>
                    <i class="{{config('app.material')}}">person_add</i> Novo cliente
                </a>      
            </div>

            <div class="d-flex justify-content-end my-4">
                <div class="col-sm-4 input-group">
                    <input type="text" id="buscar_cliente_admin" class="form-control" placeholder="Selecinar cliente">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend2">
                            <i class="{{config('app.material')}}">search</i>   
                        </span>
                    </div>
                </div>
            </div> 
            
            <table class="table table-hover text-center table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Estado</th>
                        <th scope='col'>Categoria</th>
                        <th scope='col'>Ações</th>
                    </tr>  
                </thead>
                <tbody id="body_table">
                    @forelse($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->nome}}</td>
                        <td>{{$cliente->Estados->nome}}</td>
                        <td>{{$cliente->Categorias->nome}}</td>
                        <td>
                            
                            <a href="{{route('cliente.edit', $cliente->id)}}"  class='btn btn-sm btn-info text-white' data-toggle="tooltip" data-placement="top" title="Atualizar informações">
                                <i class="{{config('app.material')}}">autorenew</i>
                            </a>
                            
                            <button value="{{route('cliente.destroy', $cliente->id)}}" class='btn btn-sm btn-danger btn_delete' data-toggle="tooltip" data-placement="top" title="Deletar cliente">
                                <i class="{{config('app.material')}}">delete_forever</i>
                            </button>                            
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
            <div class="d-flex justify-content-end">{{$clientes->links('pagination::bootstrap-4')}}</div>
        </div>
    </div>
    @include('Clientes.modals.deletar')
    @push('js')
        <script src="{{asset('../js/clientes.js')}}"></script>
    @endpush
</div>
@endsection

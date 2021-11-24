@extends('layouts.app')
@section('title_page', 'Página inicial')

@section('content')
    <div class="container">
        <h2 class="text-center">Cliente Selecionado</h2>

        <div class="d-flex justify-content-end">
            <a href="{{route('/')}}" class='btn btn-sm btn-success mr-3' data-toggle="tooltip" data-placement="top" title="Voltar a página inicial">
                <i class="{{config('app.material')}}">arrow_back</i>
            </a>      
        </div> 
        
        <div class="card mt-5">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class='form-control' readonly value="{{$cliente->nome}}">
                    </div>

                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="tipo">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class='form-control' readonly value="{{$cliente->tipo}}">
                    </div>

                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="contato">Contato</label>
                        <input type="text" name="contato" id="contato" class='form-control' readonly value="{{$cliente->contato}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="nascimento">{{$cliente->tipo == 'Física' ? 'Fundação' : 'Nascimento'}}</label>
                        <input type="text" name="nascimento" id="nascimento" class='form-control' readonly value="{{date('d-m-Y', strtotime($cliente->nascimento))}}">
                    </div>

                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="estado">Estado</label>
                        <input type="text" name="estado" id="estado" class='form-control' readonly value="{{$cliente->Estados->nome}}">
                    </div>

                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="categoria">Categoria</label>
                        <input type="text" name="categoria" id="categoria" class='form-control' readonly value="{{$cliente->Categorias->nome}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

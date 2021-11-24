@extends('layouts.app')
@section('title_page', 'Adicionar cliente')
@section('content')
<div class="container">    
    <div class="relative flex items-top justify-center">
        
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('cliente.store')}}" id="adicionar_cliente" method='post'>
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" value="{{old('nome')}}" class='form-control'>
                                <small class="text-danger">{{$errors->has('nome') ? $errors->first('nome') : ''}}</small>
                            </div>
        
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="tipo">Pessoa</label>
                                <select name="tipo" id="tipo" class='form-control'>
                                    <option disabled selected>-- Selecione o tipo --</option>
                                    <option value="{{encrypt(1)}}">Física</option>
                                    <option value="{{encrypt(2)}}">Jurídica</option>
                                </select>
                                <small class="text-danger">{{$errors->has('tipo') ? $errors->first('tipo') : ''}}</small>
                            </div>
                            
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="contato">Contato</label>
                                <input type="tel" name="contato" id="contato" class='form-control' value="{{old('contato')}}">
                                <small class="text-danger">{{$errors->has('contato') ? $errors->first('contato') : ''}}</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-sm-12">
                                <label id='nascimento_label' for="nascimento">Nascimento</label>
                                <input type="date" name="nascimento" id="nascimento" class='form-control' value="{{old('nascimento')}}" max="{{today()}}">
                                <small class="text-danger">{{$errors->has('nascimento') ? $errors->first('nascimento') : ''}}</small>
                            </div>
                            
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option disabled selected>-- Selecione o estado --</option>
                                    @foreach($estados as $estado)
                                        <option value="{{encrypt($estado->id)}}">{{$estado->nome}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{$errors->has('estado') ? $errors->first('estado') : ''}}</small>
                            </div>
        
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="categoria">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <option disabled selected>-- Selecione a categoria --</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{encrypt($categoria->id)}}">{{$categoria->nome}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{$errors->has('categoria') ? $errors->first('categoria') : ''}}</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Adicionar cliente">
                                <i class="{{config('app.material')}}">add</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{asset('../js/clientes.js')}}"></script>
@endpush
@endsection

$(function(){
            
    $('[data-toggle="tooltip"]').tooltip();         
    
    $('#estado, #tipo').on('change',function(){
        if($('#estado option:selected').text() == 'Minas Gerais'){
            $('#tipo option:eq(2)').prop('selected', true);
            $('#tipo').next().html('Para Minas gerais somente pessoas jurídicas');
        }else{
            $('#tipo').next().html('');
        }
    });

    $('.btn_delete').on('click',function(){
        $('#form_deletar_cliente').prop('action', $(this).val());
        $('#modalDeletarCliente').modal('show');
    });
});
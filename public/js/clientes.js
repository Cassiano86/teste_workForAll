$(function(){
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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

    $('#buscar_cliente_admin').on('keyup',function(){
        let valor = $(this).val();
        $.ajax({
            url: '/cliente/search',
            method : 'POST',
            dataType: 'JSON',
            data : {
                    _token : CSRF_TOKEN,
                    busca : valor
                  },
            timeout:5000,
            success  : function(retorno){
				if(retorno.success == 1){
                    linhas = '';
                    
                    for(let x = 0; x <= parseInt(10); x++){
                        linhas += "<tr>"+
                                    "<td>"+retorno.dados[x].nome_cliente+"</td>"+
                                    "<td>"+retorno.dados[x].nome_estado+"</td>"+
                                    "<td>"+retorno.dados[x].nome_categoria+"</td>"+
                                    "<td>"+
                                        "<a href='#'  disabled class='btn btn-sm btn-info text-white' data-toggle='tooltip' data-placement='top' title='Atualizar informações'>"+
                                        "<i class='material-icons align-middle'>autorenew</i>"+
                                        "</a>"+
                                    
                                        "<button value='#' disabled class='btn btn-sm btn-danger btn_delete' data-toggle='tooltip' data-placement='top' title='Deletar cliente'>"+
                                        '<i class="material-icons align-middle">delete_forever</i>'+
                                        '</button>'+
                                    "</td>"+
                                  "</tr>";
                    }
            
                    $('#body_table').html(linhas);
				}else{
					console.log(JSON.stringify(retorno));
				}
			},
            error : function(retorno){
                retorno ? console.log(JSON.stringify(retorno)) : console.log('Dados não enviados');
            }
        });
    });

    function montarPesquisa(indice, valores, total_paginacao ,hierarquia){
        let linhas = '';
        
        for(let x = 0; x <= indice; x++){
            
            linhas += "<tr>"+
                        "<td>"+valores[x].nome_cliente+"</td>"+
                        "<td>"+valores[x].nome_estado+"</td>"+
                        "<td>"+valores[x].nome_categoria+"</td>"+
                        "<td>"+
                        "<a href='#'  disabled class='btn btn-sm btn-info text-white' data-toggle='tooltip' data-placement='top' title='Atualizar informações'>"+
                            "<i class='material-icons align-middle'>autorenew</i>"+
                        "</a>"+
                        
                        "<button value='#' disabled class='btn btn-sm btn-danger btn_delete' data-toggle='tooltip' data-placement='top' title='Deletar cliente'>"+
                            '<i class="material-icons align-middle">delete_forever</i>'+
                        '</button>'
                        +"</td>"+
                      "</tr>";
        }

        $('#body_table').html(linhas);
    }
});
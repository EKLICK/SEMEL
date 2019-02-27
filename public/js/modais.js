//MODAL DELETE
$(document).on('click', '#btn-delete', function(){
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').val($(this).data('nome'));
});

//MODAL PESSOA E PROFESSOR
$(document).on('click', '.btn-modal_vincular', function(){
    $('#id_modal_vincular').val($(this).data('idusuario'));
    $('#id_turma_modal_vincular').val($(this).data('idturma'));
    document.getElementById('texto_id_vincular').innerHTML = 'Você deseja vincular ' + $(this).data('nomeusuario').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
});

//ATIVAR E INATIVAR
$(document).on('click', '.btn-modal_ativar', function(){
    $('#id_modal_ativar').val($(this).data('idusuario'));
    $('#id_turma_modal_ativar').val($(this).data('idturma'));
    document.getElementById('texto_id_ativar').innerHTML = 'Você deseja ativar ' + $(this).data('nomeusuario').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
});

$(document).on('click', '.btn-modal_inativar', function(){
    $('#id_modal_inativar').val($(this).data('idusuario'));
    $('#id_turma_modal_inativar').val($(this).data('idturma'));
    document.getElementById('texto_id_inativar').innerHTML = 'Você deseja inativar ' + $(this).data('nomeusuario').bold() + ' em ' + $(this).data('nometurma').bold() + '?';
});

//MODAL TURMA
$(document).on('click', '#btn-modal_ativar_objeto', function(){
    $('#id_modal_ativar').val($(this).data('idobjeto'));
    document.getElementById('texto_ativar').innerHTML = 'Você deseja Ativar ' + $(this).data('nomeobjeto').bold() + '?';
});

$(document).on('click', '#btn-modal_inativar_objeto', function(){
    $('#id_modal_inativar').val($(this).data('idobjeto'));
    document.getElementById('texto_inativar').innerHTML = 'Você deseja inativar ' + $(this).data('nomeobjeto').bold() + '?';
});

$(document).on('click', '#btn_delete', function(){
    if($(this).data('tipo') == 1){
        $('#tipo_delete').text('Administrador');
    }
    else{
        $('#tipo_delete').text('Professor')
    }
    $('#id_delete').val($(this).data('id'));
    $('#name_delete').text($(this).data('name'));
});
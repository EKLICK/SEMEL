const Calendario_de = document.querySelector('#de_search');
M.Datepicker.init(Calendario_de,{
    format:'dd/mm/yyyy'
});

const Calendario_ate = document.querySelector('#ate_search');
M.Datepicker.init(Calendario_ate,{
    format:'dd/mm/yyyy'
});

const Calendario_nascimento = document.querySelector('#nascimento');
M.Datepicker.init(Calendario_nascimento,{
    format:'dd/mm/yyyy'
});


//FORMATAÇÃO DE INPUTS:

function fMasc(objeto,mascara) {
    obj=objeto
    masc=mascara
    setTimeout("fMascEx()",1)
}
function fMascEx() {
    obj.value=masc(obj.value)
}
function mTel(tel) {
    tel=tel.replace(/\D/g,"")
    tel=tel.replace(/^(\d)/,"($1")
    tel=tel.replace(/(.{3})(\d)/,"$1) $2")
    if(tel.length == 9) {
        tel=tel.replace(/(.{1})$/,"-$1")
    } else if (tel.length == 10) {
        tel=tel.replace(/(.{2})$/,"-$1")
    } else if (tel.length == 11) {
        tel=tel.replace(/(.{3})$/,"-$1")
    } else if (tel.length == 12) {
        tel=tel.replace(/(.{4})$/,"-$1")
    } else if (tel.length > 12) {
        tel=tel.replace(/(.{4})$/,"-$1")
    }
    return tel;
}
function mCPF(cpf){
    cpf=cpf.replace(/\D/g,"")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
    return cpf
}
function mCEP(cep){
    cep=cep.replace(/\D/g,"")
    cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
    cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
    return cep
}
function mNum(num){
    num=num.replace(/\D/g,"")
    return num
}

//UPLOAD DE IMAGE PÁGINA PESSOAS:

function apagar_3_4(){
    document.getElementById('3x4_image').src = '';
    document.getElementById('img_3x4').value = '';
    document.getElementById('3x4').value = '';
}

function apagar_matricula(){
    document.getElementById('matricula_image').src = '';
    document.getElementById('img_matricula').value = '';
    document.getElementById('matricula').value = '';
}

document.getElementById("img_3x4").onchange = function (){
    string = document.getElementById("img_3x4").value.split('.');
    if(string[string.length-1] == 'img' || string[string.length-1] == 'jpg' || string[string.length-1] == 'png'){
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("3x4_image").src = e.target.result;
        };

        reader.readAsDataURL(this.files[0]);
    }
    else{
        apagar_3_4();
        alert('Ocorreu um erro ao fazer upload da imagem, por favor tente novamente!');
    }
};

document.getElementById("img_matricula").onchange = function (){
    string = document.getElementById("img_matricula").value.split('.');
    if(string[string.length-1] == 'img' || string[string.length-1] == 'jpg' || string[string.length-1] == 'png'){
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("matricula_image").src = e.target.result;
        };
        
        reader.readAsDataURL(this.files[0]);
    }
    else{
        apagar_matricula();
        alert('Ocorreu um erro no upload da imagem, por favor tente novamente!')
    }
};

//EDIÇÃO E CRIAÇÃO DE ANAMNESES
document.getElementById('limpar_3x4').onclick = function (){
    apagar_3_4();
}

document.getElementById('limpar_matricula').onclick = function (){
    apagar_matricula();
}

$("[name='marc']").click(function(){
    change(this.value, $('#convenio_medico'), $('#convenio_label'), $('#convenio_icon'));
});

function toma_medicacao_click(valor){
    change(valor, $('#string_toma_medicacao'), $('#toma_medicacao_label'), $('#toma_medicacao_icon'));
}

function alergia_medicacao_click(valor){
    change(valor, $('#string_alergia_medicacao'), $('#alergia_medicacao_label'), $('#alergia_medicacao_icon'));
}

function cirurgia_click(valor){
    change(valor, $('#string_cirurgia'), $('#cirurgia_label'), $('#cirurgia_icon'));
}

function dor_ossea_click(valor){
    change(valor, $('#string_dor_ossea'), $('#dor_ossea_label'), $('#dor_ossea_icon'));
}

function dor_muscular_click(valor){
    change(valor, $('#string_dor_muscular'), $('#dor_muscular_label'), $('#dor_muscular_icon'));
}

function dor_articular_click(valor){
    change(valor, $('#string_dor_articular'), $('#dor_articular_label'), $('#dor_articular_icon'));
}

function change(a,b,c,d){
    if(a == 'N'){
        b.hide(400);
        c.hide(400);
        d.hide(400);
    }
    else{
        b.show(400);
        c.show(400);
        d.show(400);
    }
};

//MODAL DOENÇAS-ANAMNESES
function modal_doencas(doencas){
    $('#lista_de_doencas').empty();
    $('#lista_de_doencas').append('<thead><th>Nome da Doença</th><th>Descrição</th></thead>');
    for(var i = 0; i < doencas.length; i++){
        $('#lista_de_doencas').append('<tbody><tr><td>'+doencas[i].nome+'</td><td>'+doencas[i].descricao+'</td></tr></tbody>');
    }
}

//CHANGE BAIRRO
function change_bairro(){
    if($('#div_bairro_list').is(':hidden')){
        $('#div_bairro_list').show(400);
        $('#div_bairro_string').hide(400);
        $('#string_bairro').val('');
        $('#bairro_select').empty();
        $('#bairro_select').append('<option value="" selected disabled>Selecione o bairro</option>');
        var array_bairro = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                            'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                            'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                            'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];
        for(var i = 0; i < array_bairro.length; i++){
            $('#bairro_select').append('<option value="'+array_bairro[i]+'">'+array_bairro[i]+'</option>');
        }
        $('select').formSelect();
    }
    else{
        $('#string_bairro').val('');
        $('#div_bairro_list').hide(400);
        $('#div_bairro_string').show(400);
    }
}

//OLD VALUES SELECTS
function change_bairro_select(){
    var bairro = document.getElementById('bairro_select');
    $('#string_bairro').val(bairro.options[bairro.selectedIndex].value);
}


function old_doencas_function(){
    $('#old_doencas').val($('#lista_de_pessoas').val());
}

function old_dias_function(){
    $('#old_dias').val($('#lista_de_dias').val());
}

function old_nucleo_function(){
    $('#old_nucleo').val($('#lista_de_nucleos').val());
}
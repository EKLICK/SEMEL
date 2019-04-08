var data = new Date;
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    yearRange: [1930, data.getFullYear()],
    i18n: {
        today: 'Hoje',
        clear: 'Limpar',
        cancel: 'Cancelar',
        done: 'Ok',
        nextMonth: 'Próximo mês',
        previousMonth: 'Mês anterior',
        weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
        weekdays: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'],
        monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    }
});

$('.timepicker').timepicker({
    twelveHour: false,
    i18n: {
        cancel: 'Cancelar',
        done: 'Ok',
    }
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
    document.getElementById('3x4_image').src = '../../../../img/unset_image_3x4.png';
    document.getElementById('img_3x4').value = '';
    document.getElementById('3x4').value = '';
}

function apagar_matricula(){
    document.getElementById('matricula_image').src = '../../../../img/unset_image_matricula.png';
    document.getElementById('img_matricula').value = '';
    document.getElementById('matricula').value = '';
}

function apagar_atestado(){
    document.getElementById('atestado_image').src = '../../../../img/unset_image_atestado.png';
    document.getElementById('img_atestado').value = '';
    document.getElementById('atestado').value = '';
}

function apagar_web(){
    document.getElementById('img_web').src = '../../../../img/unset_image_3x4.png';
    document.getElementById('web_image').value = '';
}

function change_img_3x4(){
    string = document.getElementById("img_3x4").value.split('.');
    if(string[string.length-1] == 'img' || string[string.length-1] == 'jpg' || string[string.length-1] == 'png'){
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("3x4_image").src = e.target.result;
        };

        reader.readAsDataURL(document.getElementById("img_3x4").files[0]);
    }
    else{
        apagar_3_4();
        alert('Ocorreu um erro ao fazer upload da imagem, por favor tente novamente!');
    }
};

function change_img_matricula(){
    string = document.getElementById("img_matricula").value.split('.');
    if(string[string.length-1] == 'img' || string[string.length-1] == 'jpg' || string[string.length-1] == 'png'){
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("matricula_image").src = e.target.result;
        };
        
        reader.readAsDataURL(document.getElementById("img_matricula").files[0]);
    }
    else{
        apagar_matricula();
        alert('Ocorreu um erro no upload da imagem, por favor tente novamente!')
    }
};

function change_img_atestado(){
    string = document.getElementById("img_atestado").value.split('.');
    if(string[string.length-1] == 'img' || string[string.length-1] == 'jpg' || string[string.length-1] == 'png'){
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("atestado_image").src = e.target.result;
        };
        
        reader.readAsDataURL(document.getElementById("img_atestado").files[0]);
    }
    else{
        apagar_atestado();
        alert('Ocorreu um erro no upload da imagem, por favor tente novamente!')
    }
};

//EDIÇÃO E CRIAÇÃO DE ANAMNESES
function convenio_medico_click(valor){
    change(valor, $('#string_convenio_medico'), $('#convenio_label'), $('#convenio_icon'));
}

function morte_click(valor){
    change(valor, $('#string_morte'), $('#morte_label'), $('#morte_icon'));
}

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

function fumante_click(valor){
    change(valor, $('#string_fumante'), $('#fumante_label'), $('#fumante_icon'));
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

$(document).keydown(function (event) {
    if (event.keyCode == 13) {
        $('#enter').click();
    }
});

function mudaCheck(op){
    if(op == 1){
        document.getElementById('check2').checked = false;
    }
    else{
        document.getElementById('check1').checked = false;
    }
}

//WEBCAM IMAGE:
$('#fotomodal').modal({
    dismissible: true,
    onCloseEnd: function(){
        stop(); 
    }
});

function stop(){
    try{
        var video = document.getElementById('video');
        video.srcObject.getTracks()[0].stop();
    }
    catch(e){}
}

function foto() {
    var video = document.getElementById('video');
    navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
    navigator.getMedia({
        video:true,
        audio: false
    }, function(stream) {
        video.srcObject = stream;
        video.play();
    }, function(error) {
        setTimeout(function(){alert('Wecam inativo: \n' + error);}, 350);
        $('#fotomodal').modal('close');
    });
};

if(document.getElementById('capture') != null){
    document.getElementById('capture').addEventListener('click', function(){
        var video = document.getElementById('video');
        context = document.getElementById('canvas_foto');
        context.getContext('2d').drawImage(video, 0, 0, 400, 300);
        document.getElementById("img_web").src = context.toDataURL('img/img_3x4');
        var codigo = context.toDataURL();
        document.getElementById('web_image').value = codigo;

        stop();
    })
}

function muda_foto(){
    var diva = document.getElementById('image_file');
    var divb = document.getElementById('image_web');
    apagar_3_4()
    apagar_web()
    if (diva.style.display == "none"){
        diva.style.display = "block";
        divb.style.display = "none";
        document.getElementById('muda_foto').innerHTML = 'Trocar para Webcam&emsp;&nbsp; <i class="material-icons">satellite</i>';
    }
    else{
        diva.style.display = "none";
        divb.style.display = "block";
        document.getElementById('muda_foto').innerHTML = 'Trocar para Pastas&emsp;&nbsp; <i class="material-icons">satellite</i>';
    }
}
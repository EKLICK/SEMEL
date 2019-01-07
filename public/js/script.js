M.AutoInit();

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

document.getElementById("img_3x4").onchange = function (){
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById("3x4_image").src = e.target.result;
    };

    reader.readAsDataURL(this.files[0]);
};

document.getElementById("img_matricula").onchange = function (){
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById("matricula_image").src = e.target.result;
    };
    
    reader.readAsDataURL(this.files[0]);
};

document.getElementById('limpar_3x4').onclick = function (){
    document.getElementById('3x4_image').src = '';
    document.getElementById('img_3x4').value = '';
    document.getElementById('3x4').value = '';
}

document.getElementById('limpar_matricula').onclick = function (){
    document.getElementById('matricula_image').src = '';
    document.getElementById('img_matricula').value = '';
    document.getElementById('matricula').value = '';
}

//EFEITOs DE MENU

function botao_de_mostrar() {
   if(document.getElementById('cssmenu').style.display != 'block'){
        document.getElementById('cssmenu').style.display = 'block';
   }
   else{
        document.getElementById('cssmenu').style.display = 'none';
   }
}

function mostragem_menu() {
    if($(window).width() > 1000){
        document.getElementById('botao').style.display = 'none';
        document.getElementById('cssmenu').style.display = 'block';
    }
    else{
        document.getElementById('botao').style.display = 'block';
        document.getElementById('cssmenu').style.display = 'none';
    }
}
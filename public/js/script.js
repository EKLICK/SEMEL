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

document.getElementById('limpar_3x4').onclick = function (){
    apagar_3_4();
}

document.getElementById('limpar_matricula').onclick = function (){
    apagar_matricula();
}

$("[name='marc']").click(function(){
    change(this.value, $('#convenio_medico'), $('.convenio_label'), $('#convenio_icon'));
});

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
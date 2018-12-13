M.AutoInit();

const Calendario_de = document.querySelector('#de_search');
M.Datepicker.init(Calendario_de,{
    format:'dd/mm/yy'
});

const Calendario_ate = document.querySelector('#ate_search');
M.Datepicker.init(Calendario_ate,{
    format:'dd/mm/yy'
});

const Calendario_nascimento = document.querySelector('#nascimento');
M.Datepicker.init(Calendario_nascimento,{
    format:'dd/mm/yy'
});
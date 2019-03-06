<?php

namespace App\Http\Controllers\Ferramentas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pessoa;
use App\Turma;
use App\Nucleo;

//CONTROLE DE PDF:
//Comentarios em cima, código comentado em baixo.
class PDFController extends Controller{
    public function returnIds($list){
        $list = str_replace('[', '', $list);
        $list = str_replace(']', '', $list);

        return explode(',', $list);
    }

    //FUNÇÕES DE REDIRECIONAMENTO:
    
    public function menu_pessoas_pdf($list){
        $list = $this->returnIds($list);
        $pessoaslist = Pessoa::whereIn('id', $list)->get();

        return view ('pdf_file.pdf_pessoas.menu_pdf_pessoas', compact('pessoaslist'));
    }

    public function menu_turmas_pdf($list){
        $list = $this->returnIds($list);
        $turmaslist = Turma::whereIn('id', $list)->get();

        return view ('pdf_file.pdf_turmas.menu_pdf_turmas', compact('turmaslist'));
    }

    public function menu_nucleos_pdf($list){
        $list = $this->returnIds($list);
        $nucleoslist = Nucleo::whereIn('id', $list)->get();

        return view ('pdf_file.pdf_nucleos.menu_pdf_nucleos', compact('nucleoslist'));
    }

    //Função pdfpessoas: Retorna o pdf das informações da pessoa.
    public function pessoas_pdf(Request $request, $list){
        $dataForm = $request->all();
        $opcoes_colunas = [];
        if(isset($dataForm['endereco'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['telefone'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['telefone_emergencia'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['data_nascimento'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['rg'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['morto'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}

        $list = $this->returnIds($list);
        if($dataForm['option_order'] == 'nome'){
            $pessoaslist = Pessoa::whereIn('id', $list)->orderBy('nome')->get();
        }
        elseif($dataForm['option_order'] == 'data'){
            $pessoaslist = Pessoa::whereIn('id', $list)->orderBy('created_at')->get();
        }

        return \PDF::loadview('pdf_file.pdf_pessoas.pessoas_pdf', compact('pessoaslist','opcoes_colunas'))->stream('PDF_registro_pessoas'.'.pdf');
    }

    public function turmas_pdf(Request $request, $list){
        $dataForm = $request->all();
        $opcoes_colunas = [];
        if(isset($dataForm['limite'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['quant_atual'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['data_semanal'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['horario'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['inativo'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}

        $list = $this->returnIds($list);
        if($dataForm['option_order'] == 'nome'){
            $turmaslist =  Turma::whereIn('id', $list)->orderBy('nome')->get();
        }
        elseif($dataForm['option_order'] == 'data'){
            $turmaslist = Turma::whereIn('id', $list)->orderBy('created_at')->get();
        }

        return \PDF::loadview('pdf_file.pdf_turmas.turmas_pdf', compact('turmaslist','opcoes_colunas'))->stream('PDF_registro_turmas'.'.pdf');
    }

    public function nucleos_pdf(Request $request, $list){
        $dataForm = $request->all();
        $opcoes_colunas = [];
        if(isset($dataForm['cidade'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['bairro'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['rua'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['numero_endereco'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['cep'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}
        if(isset($dataForm['inativo'])){array_push($opcoes_colunas, 1);}else{array_push($opcoes_colunas, 0);}

        $list = $this->returnIds($list);

        if($dataForm['option_order'] == 'nome'){
            $nucleoslist =  Nucleo::whereIn('id', $list)->orderBy('nome')->get();
        }
        elseif($dataForm['option_order'] == 'data'){
            $nucleoslist = Nucleo::whereIn('id', $list)->orderBy('created_at')->get();
        }

        return \PDF::loadview('pdf_file.pdf_nucleos.nucleos_pdf', compact('nucleoslist','opcoes_colunas'))->stream('PDF_registro_nucleos'.'.pdf');
    }
}

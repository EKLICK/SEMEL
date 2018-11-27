<?php

use Illuminate\Database\Seeder;

class PessoasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pessoas')->delete();
        
        \DB::table('pessoas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cidade' => 'São Leopoldo',
                'nome' => 'Luis',
                'nascimento' => '20/06/1988',
                'rg' => '123123123',
                'cpf' => '321.123.321-36',
                'endereco' => 'Rua marinho 644',
                'bairro' => 'Lago azul',
                'cep' => '654567895',
            'telefone' => '(51) 3561-5201',
            'telefone_emergencia' => '(51) 1234-1234',
                'nome_do_pai' => 'João',
                'nome_da_mae' => 'Maria',
                'pessoa_emergencia' => 'Olavo',
                'convenio_medico' => 'UL',
                'filhos' => 1,
                'irmaos' => 2,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'mora_com_os_pais' => 2,
                'inativo' => 0,
                'created_at' => '2018-11-21 11:00:06',
                'updated_at' => '2018-11-21 11:00:06',
            ),
            1 => 
            array (
                'id' => 2,
                'cidade' => 'São Leopoldo',
                'nome' => 'Mateus',
                'nascimento' => '15/04/1990',
                'rg' => '456654456',
                'cpf' => '852.258.456-98',
                'endereco' => 'Rua flores 200',
                'bairro' => 'Mares',
                'cep' => '357951789',
            'telefone' => '(51) 7899-7899',
            'telefone_emergencia' => '(51) 7899-7885',
                'nome_do_pai' => 'Jorge',
                'nome_da_mae' => 'Juditi',
                'pessoa_emergencia' => 'Paulo',
                'convenio_medico' => 'OL',
                'filhos' => 0,
                'irmaos' => 3,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'mora_com_os_pais' => 2,
                'inativo' => 1,
                'created_at' => '2018-11-21 11:09:09',
                'updated_at' => '2018-11-21 11:09:09',
            ),
            2 => 
            array (
                'id' => 3,
                'cidade' => 'São Leopoldo',
                'nome' => 'Joana',
                'nascimento' => '20/01/1999',
                'rg' => '4658521',
                'cpf' => '159.915.159-93',
                'endereco' => 'Rua Girafa 789',
                'bairro' => 'celestial',
                'cep' => '879541221',
            'telefone' => '(51) 6545-45654',
            'telefone_emergencia' => '(51) 6520-45654',
                'nome_do_pai' => 'Marcos',
                'nome_da_mae' => 'Marta',
                'pessoa_emergencia' => 'Rodrigo',
                'convenio_medico' => 'LO',
                'filhos' => 0,
                'irmaos' => 1,
                'sexo' => 'F',
                'estado_civil' => 'Solteiro',
                'mora_com_os_pais' => 1,
                'inativo' => 1,
                'created_at' => '2018-11-21 11:14:26',
                'updated_at' => '2018-11-21 11:14:26',
            ),
            3 => 
            array (
                'id' => 4,
                'cidade' => 'São Leopoldo',
                'nome' => 'Mario',
                'nascimento' => '03/09/1985',
                'rg' => '45613321',
                'cpf' => '159.325.652-12',
                'endereco' => 'Rua Leão 411',
                'bairro' => 'das Linhas',
                'cep' => '6512346',
            'telefone' => '(51) 7613-1235',
            'telefone_emergencia' => '(51) 5132-5132',
                'nome_do_pai' => 'Julio',
                'nome_da_mae' => 'Julia',
                'pessoa_emergencia' => 'Maria',
                'convenio_medico' => 'AS',
                'filhos' => 2,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'mora_com_os_pais' => 2,
                'inativo' => 0,
                'created_at' => '2018-11-21 11:18:29',
                'updated_at' => '2018-11-21 11:18:29',
            ),
            4 => 
            array (
                'id' => 7,
                'cidade' => 'São Leopoldo',
                'nome' => 'Maria',
                'nascimento' => '29/07/1992',
                'rg' => '1561651',
                'cpf' => '432.135.482-12',
                'endereco' => 'Rua dos Javalis 900',
                'bairro' => 'das gaivotas',
                'cep' => '8972146',
            'telefone' => '(51) 8852-5431',
            'telefone_emergencia' => '(51) 5651-3221',
                'nome_do_pai' => 'Martines',
                'nome_da_mae' => 'Rita',
                'pessoa_emergencia' => 'Mario',
                'convenio_medico' => 'BG',
                'filhos' => 0,
                'irmaos' => 3,
                'sexo' => 'F',
                'estado_civil' => 'Solteiro',
                'mora_com_os_pais' => 1,
                'inativo' => 1,
                'created_at' => '2018-11-21 11:30:38',
                'updated_at' => '2018-11-21 11:30:38',
            ),
            5 => 
            array (
                'id' => 9,
                'cidade' => 'São Leopoldo',
                'nome' => 'Paulo',
                'nascimento' => '12/06/1970',
                'rg' => '1235115',
                'cpf' => '132.023.105-02',
                'endereco' => 'Rua dos Lobos 752',
                'bairro' => 'das Boias',
                'cep' => '4654651',
            'telefone' => '(51) 8213-1242',
            'telefone_emergencia' => '(51) 1244-1242',
                'nome_do_pai' => 'João',
                'nome_da_mae' => 'Joana',
                'pessoa_emergencia' => 'Marcos',
                'convenio_medico' => 'HU',
                'filhos' => 2,
                'irmaos' => 4,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'mora_com_os_pais' => 2,
                'inativo' => 1,
                'created_at' => '2018-11-21 11:37:28',
                'updated_at' => '2018-11-21 11:37:28',
            ),
            6 => 
            array (
                'id' => 10,
                'cidade' => 'São Leopoldo',
                'nome' => 'Marta',
                'nascimento' => '02/02/1980',
                'rg' => '5642112',
                'cpf' => '132.123.123-05',
                'endereco' => 'Rua das Raposas 652',
                'bairro' => 'das Lagostas',
                'cep' => '5545849',
            'telefone' => '(51) 3421-1541',
            'telefone_emergencia' => '(51) 3766-1352',
                'nome_do_pai' => 'Rodrigo',
                'nome_da_mae' => 'Leonarda',
                'pessoa_emergencia' => 'Leonardo',
                'convenio_medico' => 'MJ',
                'filhos' => 1,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Casado',
                'mora_com_os_pais' => 2,
                'inativo' => 1,
                'created_at' => '2018-11-21 11:41:13',
                'updated_at' => '2018-11-21 11:41:13',
            ),
            7 => 
            array (
                'id' => 11,
                'cidade' => 'São Leopoldo',
                'nome' => 'Felipe',
                'nascimento' => '20/012/2005',
                'rg' => '156153',
                'cpf' => '123.510.160-03',
                'endereco' => 'Rua das Pratas 106',
                'bairro' => 'das Marés',
                'cep' => '16542315',
            'telefone' => '(51) 2148-4589',
            'telefone_emergencia' => '(51) 5499-0099',
                'nome_do_pai' => 'Rau',
                'nome_da_mae' => 'Eduarda',
                'pessoa_emergencia' => 'Eduardo',
                'convenio_medico' => 'NA',
                'filhos' => 0,
                'irmaos' => 1,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'mora_com_os_pais' => 1,
                'inativo' => 1,
                'created_at' => '2018-11-21 12:07:08',
                'updated_at' => '2018-11-21 12:07:08',
            ),
            8 => 
            array (
                'id' => 12,
                'cidade' => 'São Leopoldo',
                'nome' => 'Leonardo',
                'nascimento' => '04/06/2000',
                'rg' => '1556153',
                'cpf' => '541.462.132-42',
                'endereco' => 'Rua das palmeiras',
                'bairro' => 'das Marés',
                'cep' => '6511513',
            'telefone' => '(51) 4689-3965',
            'telefone_emergencia' => '(51) 5439-9569',
                'nome_do_pai' => 'Batista',
                'nome_da_mae' => 'Vera',
                'pessoa_emergencia' => 'Matheus',
                'convenio_medico' => 'MNG',
                'filhos' => 0,
                'irmaos' => 2,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'mora_com_os_pais' => 1,
                'inativo' => 0,
                'created_at' => '2018-11-21 12:26:25',
                'updated_at' => '2018-11-21 12:26:25',
            ),
        ));
        
        
    }
}
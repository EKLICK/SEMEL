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
                'foto' => 'img/img_3x4/imagem_3788.png',
                'nome' => 'Julio da Silva',
                'nascimento' => '1994-04-07 00:00:00',
                'rg' => '51235121',
                'cpf' => '156.156.045-46',
                'cpf_responsavel' => NULL,
                'cidade' => 'teste',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Rua das Aráras',
                'numero_endereco' => '620',
                'cep' => '41.981-210',
            'telefone' => '(56) 0980-1565',
            'telefone_emergencia' => '(56) 0198-1210',
                'nome_do_pai' => 'Juliano da Silva',
                'nome_da_mae' => 'Juliana da Silva',
            'pessoa_emergencia' => 'Julia da Silva (irmã)',
                'convenio_medico' => 'SEN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-26 15:25:07',
                'updated_at' => '2018-12-27 11:22:19',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'foto' => 'img/img_3x4/imagem_7782.png',
                'nome' => 'João Barros',
                'nascimento' => '2005-09-14 00:00:00',
                'rg' => '15320510',
                'cpf' => '156.601.656-20',
                'cpf_responsavel' => '056.056.420-56',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro dos armários',
                'rua' => 'Rua das Panteras',
                'numero_endereco' => '480',
                'cep' => '54.006-486',
            'telefone' => '(51) 1561-5618',
            'telefone_emergencia' => '(51) 5156-1566',
                'nome_do_pai' => 'Julio Barros',
                'nome_da_mae' => 'Julia Barros',
            'pessoa_emergencia' => 'Jorge Reis (amigo)',
                'convenio_medico' => 'UN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => 'img/img_matricula/imagem_5171.png',
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 12:16:50',
                'updated_at' => '2018-12-28 15:07:16',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'foto' => 'img/img_3x4/imagem_4996.png',
                'nome' => 'Gabriel de Souza',
                'nascimento' => '1992-02-05 00:00:00',
                'rg' => '48778984',
                'cpf' => '894.465.458-98',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Canetas',
                'rua' => 'Rua das Zebras',
                'numero_endereco' => '611',
                'cep' => '48.898-798',
            'telefone' => '(51) 5894-8189',
            'telefone_emergencia' => '(51) 5954-9875',
                'nome_do_pai' => 'Valdir de Souza',
                'nome_da_mae' => 'Gabriela de Souza',
            'pessoa_emergencia' => 'Felipe de Souza (Tio)',
                'convenio_medico' => 'UN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 12:24:05',
                'updated_at' => '2018-12-28 10:03:50',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 7,
                'foto' => 'img/img_3x4/imagem_6601.png',
                'nome' => 'Felipe Soares',
                'nascimento' => '1990-02-23 00:00:00',
                'rg' => '88745868',
                'cpf' => '797.141.005-55',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Rua das Pombas',
                'numero_endereco' => '489',
                'cep' => '11.651-561',
            'telefone' => '(51) 5151-5655',
            'telefone_emergencia' => '(51) 5151-5151',
                'nome_do_pai' => 'Fernando Soares',
                'nome_da_mae' => 'Fernando Soares',
            'pessoa_emergencia' => 'Julio Emanuel (Vizinho)',
                'convenio_medico' => 'SEN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 12:37:49',
                'updated_at' => '2018-12-28 15:26:24',
                'deleted_at' => '2018-12-28 15:26:24',
            ),
            4 => 
            array (
                'id' => 8,
                'foto' => 'img/img_3x4/imagem_2462.png',
                'nome' => 'Diego Francisco',
                'nascimento' => '1998-01-13 00:00:00',
                'rg' => '13212322',
                'cpf' => '456.445.656-45',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Comidas',
                'rua' => 'Rua dos Lobos',
                'numero_endereco' => '458',
                'cep' => '15.213-300',
            'telefone' => '(51) 6548-9845',
            'telefone_emergencia' => '(51) 0000-0000',
                'nome_do_pai' => 'Daniel Francisco',
                'nome_da_mae' => 'Fatima Francisco',
            'pessoa_emergencia' => 'Matheus Borrano (Amigo)',
                'convenio_medico' => 'ON',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 12:55:48',
                'updated_at' => '2018-12-27 12:55:48',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 9,
                'foto' => 'img/img_3x4/imagem_8506.png',
                'nome' => 'Rogeria Duarte',
                'nascimento' => '1989-04-03 00:00:00',
                'rg' => '95175385',
                'cpf' => '789.789.789-78',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Canetas',
                'rua' => 'Rua dos Peixes',
                'numero_endereco' => '875',
                'cep' => '45.645-651',
            'telefone' => '(51) 5156-5798',
            'telefone_emergencia' => '(51) 9872-0489',
                'nome_do_pai' => 'Rau Duarte',
                'nome_da_mae' => 'Riana Duarte',
            'pessoa_emergencia' => 'Ritta Duarte (Vó)',
                'convenio_medico' => 'SEM',
                'filhos' => 2,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 13:00:18',
                'updated_at' => '2018-12-27 13:00:18',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 11,
                'foto' => 'img/img_3x4/imagem_9223.png',
                'nome' => 'Diana Tavares',
                'nascimento' => '1985-08-14 00:00:00',
                'rg' => '78899512',
                'cpf' => '120.123.789-54',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Comidas',
                'rua' => 'Rua das Gaivotas',
                'numero_endereco' => '987',
                'cep' => '46.498-721',
            'telefone' => '(51) 5615-6110',
            'telefone_emergencia' => '(51) 2005-6095',
                'nome_do_pai' => 'Carlos Tavares',
                'nome_da_mae' => 'Vanessa Tavares',
                'pessoa_emergencia' => 'Miguel Enrique',
                'convenio_medico' => 'GO',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 13:11:57',
                'updated_at' => '2018-12-27 13:38:58',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 12,
                'foto' => 'img/img_3x4/imagem_5077.png',
                'nome' => 'Amanda Teixeira',
                'nascimento' => '2005-07-27 00:00:00',
                'rg' => '156108089',
                'cpf' => '408.948.905-98',
                'cpf_responsavel' => '401.489.487-65',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Rua dos Pássaros',
                'numero_endereco' => '446',
                'cep' => '56.789-871',
            'telefone' => '(51) 5616-8487',
            'telefone_emergencia' => '(51) 6878-9732',
                'nome_do_pai' => 'Diego Teixeira',
                'nome_da_mae' => 'Carol Teixeira',
            'pessoa_emergencia' => 'Luciana Teixeira (Tia)',
                'convenio_medico' => 'SEN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Solteiro',
                'matricula' => 'img/img_matricula/imagem_3751.png',
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 13:18:02',
                'updated_at' => '2018-12-27 13:18:02',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 13,
                'foto' => 'img/img_3x4/imagem_3304.png',
                'nome' => 'Rita dos Santos',
                'nascimento' => '1974-06-13 00:00:00',
                'rg' => '87542115',
                'cpf' => '080.808.880-88',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Tomadas',
                'rua' => 'Rua dos Celulares',
                'numero_endereco' => '821',
                'cep' => '79.510-326',
            'telefone' => '(51) 5100-5657',
            'telefone_emergencia' => '(51) 5615-0897',
                'nome_do_pai' => NULL,
                'nome_da_mae' => 'Maria dos Santos',
            'pessoa_emergencia' => 'Marta regina (Amiga)',
                'convenio_medico' => 'UN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 13:22:43',
                'updated_at' => '2019-01-02 11:17:10',
                'deleted_at' => '2019-01-02 11:17:10',
            ),
            9 => 
            array (
                'id' => 14,
                'foto' => 'img/img_3x4/imagem_6478.png',
                'nome' => 'Reginaldo Mendes',
                'nascimento' => '1975-10-29 00:00:00',
                'rg' => '15605657',
                'cpf' => '489.409.005-68',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Praças',
                'rua' => 'Rua dos Ratos',
                'numero_endereco' => '156',
                'cep' => '56.888-815',
            'telefone' => '(51) 5615-6688',
            'telefone_emergencia' => '(51) 5684-0540',
                'nome_do_pai' => 'Reinaldo Mendes',
                'nome_da_mae' => 'Amanda Mendes',
            'pessoa_emergencia' => 'Fatima Bonai (Amiga)',
                'convenio_medico' => NULL,
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 0,
                'created_at' => '2018-12-27 13:28:58',
                'updated_at' => '2018-12-28 14:41:32',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 15,
                'foto' => 'img/img_3x4/imagem_1373.png',
                'nome' => 'Rafaela Prata',
                'nascimento' => '1980-05-14 00:00:00',
                'rg' => '45654665',
                'cpf' => '984.061.320-89',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro dos armários',
                'rua' => 'Rua das Aranhas',
                'numero_endereco' => '188',
                'cep' => '16.508-445',
            'telefone' => '(51) 5687-9206',
            'telefone_emergencia' => '(51) 0055-8453',
                'nome_do_pai' => 'Beto Prata',
                'nome_da_mae' => 'Manuela Prata',
            'pessoa_emergencia' => 'Mateus Prata (Filho)',
                'convenio_medico' => 'SEN',
                'filhos' => 3,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 13:34:55',
                'updated_at' => '2018-12-27 13:34:55',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 17,
                'foto' => 'img/img_3x4/imagem_6393.png',
                'nome' => 'Maria Marielo',
                'nascimento' => '1982-11-30 00:00:00',
                'rg' => '799974545',
                'cpf' => '797.875.211-66',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Canetas',
                'rua' => 'Rua dos Bois',
                'numero_endereco' => '495',
                'cep' => '98.712-657',
            'telefone' => '(51) 6100-0335',
            'telefone_emergencia' => '(51) 6518-0895',
                'nome_do_pai' => 'Mario Marielo',
                'nome_da_mae' => 'Marta Marielo',
            'pessoa_emergencia' => 'Fernando Marielo (Vô)',
                'convenio_medico' => 'FM',
                'filhos' => 1,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-27 14:42:14',
                'updated_at' => '2018-12-27 14:42:14',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 18,
                'foto' => 'img/img_3x4/imagem_2539.png',
                'nome' => 'Felipe Braga',
                'nascimento' => '1993-07-21 00:00:00',
                'rg' => '56481861',
                'cpf' => '498.108.948-02',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Comidas',
                'rua' => 'Rua das Gaivotas',
                'numero_endereco' => '951',
                'cep' => '10.651-489',
            'telefone' => '(51) 198-7216',
            'telefone_emergencia' => '(51) 1561-6508',
                'nome_do_pai' => 'Rogério Braga',
                'nome_da_mae' => 'Daniela Braga',
            'pessoa_emergencia' => 'Rodrigo Braga (Irmão)',
                'convenio_medico' => 'UN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 11:18:52',
                'updated_at' => '2018-12-28 11:18:52',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 19,
                'foto' => 'img/img_3x4/imagem_4947.png',
                'nome' => 'Mateus Darcias',
                'nascimento' => '2007-05-25 00:00:00',
                'rg' => '6446548',
                'cpf' => '645.648.942-15',
                'cpf_responsavel' => '054.089.481-65',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Canetas',
                'rua' => 'Rua dos Dinossauros',
                'numero_endereco' => '654',
                'cep' => '46.508-480',
            'telefone' => '(51) 5165-0565',
            'telefone_emergencia' => '(51) 5607-8978',
                'nome_do_pai' => 'Diego Darcias',
                'nome_da_mae' => 'Amanda Darcias',
            'pessoa_emergencia' => 'Guilherme Pereira (Tio)',
                'convenio_medico' => 'EM',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => 'img/img_matricula/imagem_7467.png',
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 11:27:15',
                'updated_at' => '2018-12-28 11:27:15',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 21,
                'foto' => 'img/img_3x4/imagem_9088.png',
                'nome' => 'Rodrigo de Cesar',
                'nascimento' => '2006-04-12 00:00:00',
                'rg' => '89448984',
                'cpf' => '908.489.089-48',
                'cpf_responsavel' => '894.089.498-98',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Comidas',
                'rua' => 'Rua das Gaivotas',
                'numero_endereco' => '564',
                'cep' => '46.546-008',
            'telefone' => '(51) 5106-5688',
            'telefone_emergencia' => '(51) 0689-7056',
                'nome_do_pai' => 'Mario de Cesar',
                'nome_da_mae' => 'Fatima de Cesar',
            'pessoa_emergencia' => 'Eduardo Lopez (Vô)',
                'convenio_medico' => 'ON',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => 'img/img_matricula/imagem_7617.png',
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 11:34:35',
                'updated_at' => '2018-12-28 11:34:35',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 22,
                'foto' => 'img/img_3x4/imagem_3748.png',
                'nome' => 'Rogério Matos',
                'nascimento' => '1992-02-11 00:00:00',
                'rg' => '544654665',
                'cpf' => '465.874.566-50',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Rua dos Elefantes',
                'numero_endereco' => '145',
                'cep' => '56.084-756',
            'telefone' => '(51) 5106-5405',
            'telefone_emergencia' => '(51) 5608-9486',
                'nome_do_pai' => 'Mario Matos',
                'nome_da_mae' => 'Regina Matos',
            'pessoa_emergencia' => 'Felipe Irineu (Amigo)',
                'convenio_medico' => 'SUN',
                'filhos' => 2,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 12:16:46',
                'updated_at' => '2018-12-28 12:16:46',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 23,
                'foto' => 'img/img_3x4/imagem_8051.png',
                'nome' => 'Marina Garcia',
                'nascimento' => '1989-07-12 00:00:00',
                'rg' => '8904811',
                'cpf' => '487.987.598-40',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Canetas',
                'rua' => 'Rua dos Mamutes',
                'numero_endereco' => '657',
                'cep' => '18.972-089',
            'telefone' => '(51) 8907-2138',
            'telefone_emergencia' => '(51) 0897-8432',
                'nome_do_pai' => NULL,
                'nome_da_mae' => NULL,
            'pessoa_emergencia' => 'Regina Santos (Amiga)',
                'convenio_medico' => 'ME',
                'filhos' => 1,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 12:21:56',
                'updated_at' => '2018-12-28 12:21:56',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 24,
                'foto' => 'img/img_3x4/imagem_9754.png',
                'nome' => 'Mario Dirceu dos Santos',
                'nascimento' => '1984-07-11 00:00:00',
                'rg' => '78489465',
                'cpf' => '554.084.984-56',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Facas',
                'rua' => 'Rua dos Jacarés',
                'numero_endereco' => '484',
                'cep' => '65.405-648',
            'telefone' => '(51) 6510-4896',
            'telefone_emergencia' => '(51) 6084-9632',
                'nome_do_pai' => NULL,
                'nome_da_mae' => 'Eduarda Dirceu dos Santos',
                'pessoa_emergencia' => 'Julio Dirceu dos Santos',
                'convenio_medico' => 'SUN',
                'filhos' => 1,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 12:29:43',
                'updated_at' => '2018-12-28 12:29:43',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 25,
                'foto' => 'img/img_3x4/imagem_7638.png',
                'nome' => 'Romero Fernando',
                'nascimento' => '2000-04-02 00:00:00',
                'rg' => '14123123',
                'cpf' => '189.842.302-35',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Ruas das Aráras',
                'numero_endereco' => '564',
                'cep' => '16.874-425',
            'telefone' => '(51) 5165-6875',
            'telefone_emergencia' => '(51) 6879-1321',
                'nome_do_pai' => 'Carlos Fernando',
                'nome_da_mae' => NULL,
            'pessoa_emergencia' => 'Marcos Fernando (Tio)',
                'convenio_medico' => 'UN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => 'img/img_matricula/imagem_4601.png',
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 13:36:33',
                'updated_at' => '2019-01-02 11:16:05',
                'deleted_at' => '2019-01-02 11:16:05',
            ),
            19 => 
            array (
                'id' => 26,
                'foto' => 'img/img_3x4/imagem_3730.png',
                'nome' => 'Carlos Matina',
                'nascimento' => '1995-04-29 00:00:00',
                'rg' => '487321987',
                'cpf' => '897.019.008-89',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Facas',
                'rua' => 'Rua dos Galos',
                'numero_endereco' => '454',
                'cep' => '10.897-035',
            'telefone' => '(51) 6508-9746',
            'telefone_emergencia' => '(51) 6048-9210',
                'nome_do_pai' => 'Giovanni Matina',
                'nome_da_mae' => 'Mara Matina',
            'pessoa_emergencia' => 'Melissa Esqueiros (Amiga)',
                'convenio_medico' => 'SUN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 13:49:27',
                'updated_at' => '2019-01-02 10:47:00',
                'deleted_at' => '2019-01-02 10:47:00',
            ),
            20 => 
            array (
                'id' => 27,
                'foto' => 'img/img_3x4/imagem_7249.png',
                'nome' => 'Rogério Farias',
                'nascimento' => '1989-10-11 00:00:00',
                'rg' => '54658985',
                'cpf' => '498.721.080-89',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Facas',
                'rua' => 'Rua das Lulas',
                'numero_endereco' => '546',
                'cep' => '08.946-505',
            'telefone' => '(51) 0984-9895',
            'telefone_emergencia' => '(51) 8974-0765',
                'nome_do_pai' => NULL,
                'nome_da_mae' => NULL,
            'pessoa_emergencia' => 'Mario Vagante (Amigo)',
                'convenio_medico' => 'Sun',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 13:52:40',
                'updated_at' => '2019-01-02 11:44:13',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 28,
                'foto' => 'img/img_3x4/imagem_4674.png',
                'nome' => 'Rodrigo Benatti',
                'nascimento' => '1988-08-17 00:00:00',
                'rg' => '13215412',
                'cpf' => '187.325.892-38',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Canetas',
                'rua' => 'Rua das Zebras',
                'numero_endereco' => '165',
                'cep' => '16.508-907',
            'telefone' => '(51) 5608-9875',
            'telefone_emergencia' => '(51) 5605-8076',
                'nome_do_pai' => 'Dirceu Benatti',
                'nome_da_mae' => 'Carla Benatti',
            'pessoa_emergencia' => 'Amanda Benatti (Esposa)',
                'convenio_medico' => 'MU',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 14:31:59',
                'updated_at' => '2018-12-28 14:31:59',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 29,
                'foto' => 'img/img_3x4/imagem_7554.png',
                'nome' => 'Gustavo Martines',
                'nascimento' => '2004-09-08 00:00:00',
                'rg' => '1565615616',
                'cpf' => '516.089.408-94',
                'cpf_responsavel' => '560.489.456-45',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro dos armários',
                'rua' => 'Rua das Panteras',
                'numero_endereco' => '056',
                'cep' => '45.607-894',
            'telefone' => '(51) 1505-6080',
            'telefone_emergencia' => '(51) 8979-0001',
                'nome_do_pai' => 'Arnold Martines',
                'nome_da_mae' => 'Paloma Martines',
            'pessoa_emergencia' => 'Juliano Martines (Tio)',
                'convenio_medico' => 'SUN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => 'img/img_matricula/imagem_2243.png',
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 15:15:48',
                'updated_at' => '2018-12-28 15:15:48',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 30,
                'foto' => 'img/img_3x4/imagem_2850.png',
                'nome' => 'Walter Migueli',
                'nascimento' => '1993-08-10 00:00:00',
                'rg' => '212312323',
                'cpf' => '132.165.045-64',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Ruas das Arára',
                'numero_endereco' => '561',
                'cep' => '46.507-897',
            'telefone' => '(51) 5108-9988',
            'telefone_emergencia' => '(51) 5809-4889',
                'nome_do_pai' => 'Gilson Migueli',
                'nome_da_mae' => 'Vera Migueli',
            'pessoa_emergencia' => 'Daniel Migueli (Irmão)',
                'convenio_medico' => 'Sun',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 15:32:25',
                'updated_at' => '2018-12-28 15:32:25',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 31,
                'foto' => 'img/img_3x4/imagem_6480.png',
                'nome' => 'Yuri Utakata',
                'nascimento' => '1999-07-21 00:00:00',
                'rg' => '023132115',
                'cpf' => '450.897.565-70',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Facas',
                'rua' => 'Rua dos Vidros',
                'numero_endereco' => '215',
                'cep' => '56.048-945',
            'telefone' => '(51) 0894-9845',
            'telefone_emergencia' => '(51) 0597-1036',
                'nome_do_pai' => 'Sani Utakata',
                'nome_da_mae' => 'Yukata Utakata',
            'pessoa_emergencia' => 'José de Solimon (Amigo)',
                'convenio_medico' => 'MU',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 15:38:21',
                'updated_at' => '2018-12-28 15:38:21',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 32,
                'foto' => 'img/img_3x4/imagem_1924.png',
                'nome' => 'Bruno Machado',
                'nascimento' => '1998-10-28 00:00:00',
                'rg' => '50648945',
                'cpf' => '408.970.568-87',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Facas',
                'rua' => 'Rua dos Galos',
                'numero_endereco' => NULL,
                'cep' => '50.897-890',
            'telefone' => '(51) 8904-8995',
            'telefone_emergencia' => '(51) 8907-4975',
                'nome_do_pai' => 'Marcos Machado',
                'nome_da_mae' => 'Diana Machado',
            'pessoa_emergencia' => 'Henrique Machado (Vô)',
                'convenio_medico' => 'EN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 1,
                'inativo' => NULL,
                'estado' => 0,
                'created_at' => '2018-12-28 15:40:44',
                'updated_at' => '2018-12-28 15:41:16',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 33,
                'foto' => 'img/img_3x4/imagem_3887.png',
                'nome' => 'Vera Marcia',
                'nascimento' => '1983-03-16 00:00:00',
                'rg' => '5015648',
                'cpf' => '108.975.687-89',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Rua das Girafas',
                'numero_endereco' => '450',
                'cep' => '40.897-089',
            'telefone' => '(51) 0819-8795',
            'telefone_emergencia' => '(51) 8097-8949',
                'nome_do_pai' => NULL,
                'nome_da_mae' => 'Dina Marcia',
            'pessoa_emergencia' => 'Bruna Marcia (filha)',
                'convenio_medico' => 'MA',
                'filhos' => 2,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 15:44:04',
                'updated_at' => '2018-12-28 15:44:04',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 34,
                'foto' => 'img/img_3x4/imagem_4891.png',
                'nome' => 'Regina Minori',
                'nascimento' => '1998-11-19 00:00:00',
                'rg' => '15657891',
                'cpf' => '089.719.845-56',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Comidas',
                'rua' => 'Rua do Gaivotas',
                'numero_endereco' => '165',
                'cep' => '10.897-456',
            'telefone' => '(51) 0890-7895',
            'telefone_emergencia' => '(51) 8907-9875',
                'nome_do_pai' => 'Reinaldo Minori',
                'nome_da_mae' => 'Maria Minori',
            'pessoa_emergencia' => 'Henrique Machado (Amigo)',
                'convenio_medico' => 'EN',
                'filhos' => 1,
                'irmaos' => 0,
                'sexo' => 'F',
                'estado_civil' => 'Casado',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-28 15:46:58',
                'updated_at' => '2018-12-28 15:46:58',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
<?php 
    require_once 'Aluno.php';
    require_once 'Bolsista.php';
    require_once 'Tecnico.php';
    require_once 'Visitante.php';

    $p[1] = new Visitante("João", 17, 'M');
    $p[2] = new Aluno("Maria", 16, 'F', 100036);
    $p[3] = new Bolsista("Cláudio", 16, 'M', 100101, 50);
    $p[4] = new Tecnico("Jubileu", 20, 'M', 100231);

    $p[2]->setCurso('Administração');
    $p[2]->pagarMensalidade();

    $p[3]->setCurso('Informatica');
    $p[3]->pagarMensalidade();

    $p[4]->setCurso('Direito');
    $p[4]->pagarMensalidade();
    $p[4]->setRegistroProfissional('R1000013265');

    print_r($p);


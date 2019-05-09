<?php 
    require_once 'Aluno.php';
    require_once 'Funcionario.php';
    require_once 'Professor.php';

    $p[1] = new Pessoa();
    $p[2] = new Aluno();
    $p[3] = new Professor();
    $p[4] = new Funcionario();

    $p[1]->setNome("Pedro");
    $p[2]->setNome("Maria");
    $p[3]->setNome("Cláudio");
    $p[4]->setNome("Fabiana");

    $p[2]->setCurso('Informática');
    $p[3]->setSalario(2500.75);
    $p[4]->setSetor('Estoque');

    print_r($p);


<?php
    
    require_once 'Video.php';
    require_once 'User.php';
    require_once 'Visualization.php';

    $v[] = new Video("Aula 1 de POO");
    $v[] = new Video("Aula 12 de PHP");
    $v[] = new Video("Aula 15 de HTML5");

    $u[] = new User("Jubileu", 22, "M", "juba");
    $u[] = new User("Creuza", 18, "F", "creuzita");

    $vs[] = new Visualization($u[0], $v[2]);
    $vs[] = new Visualization($u[0], $v[1]);

    $vs[0]->evaluate();
    $vs[1]->evaluatePerc(80);
    //print_r($v);
    //print_r($u);
    print_r($vs);
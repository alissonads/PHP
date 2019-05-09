<?php 
    require_once 'Livro.php';

    $pessoas[] = new Pessoa('João', 30, 'M');
    $pessoas[] = new Pessoa('Pedro', 28, 'M');
    $pessoas[] = new Pessoa('Maria', 21, 'F');
    $pessoas[] = new Pessoa('Ana', 23, 'F');

    $livros[] = new Livro('Use a Cabeça Java', 'João das Coves', 365, $pessoas[2]);
    $livros[] = new Livro('Use a Cabeça PHP', 'Sicrano Souza', 758, $pessoas[0]);
    $livros[] = new Livro('Use a Cabeça Padrão de Projetos', 'Fulano da Silva', 382, $pessoas[3]);
    $livros[] = new Livro('Use a Cabeça HTML', 'João das Coves', 565, $pessoas[1]);
    $livros[] = new Livro('Raytracing from the groundup', 'Kaven Duckaxoto', 723, $pessoas[2]);
    $livros[] = new Livro('Use a Cabeça C#', 'Chispirito', 465, $pessoas[0]);

    /*$livros[0]->folhear(1);
    $livros[0]->voltarPagina();
    $livros[0]->detalhes();*/

    foreach ($livros as $l) {
        $l->detalhes();
    }
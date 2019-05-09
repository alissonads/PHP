<?php
    require_once 'Pessoa.php';

    final class Visitante extends Pessoa {
        public function __construct($nome, $idade, $sexo) {
            parent::__construct($nome, $idade, $sexo);
        }
    }
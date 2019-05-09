<?php
    require_once 'Aluno.php';

    class Tecnico extends Aluno {
        private $registroProfissional;

        public function __construct($nome, $idade, $sexo, $matricula) {
            parent::__construct($nome, $idade, $sexo, $matricula);
        }

        public function getRegistroProfissional() { return $this->registroProfissional; }

        public function setRegistroProfissional($registroProfissional) { $this->registroProfissional = $registroProfissional; }

        public function praticar() {

        }
    }
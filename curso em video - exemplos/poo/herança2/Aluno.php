<?php 
    require_once 'Pessoa.php';

    class Aluno extends Pessoa {
        private $matricula;
        private $curso;

        public function __construct($nome, $idade, $sexo, $matricula) {
            parent::__construct($nome, $idade, $sexo);
            $this->matricula = $matricula;
        }

        public function getMatricula() { return $this->matricula; }

        public function getCurso() { return $this->curso; }

        public function setMatricula($matricula) { return $this->matricula = $matricula; }
        
        public function setCurso($curso) { return $this->curso = $curso; }

        public function cancelarMatricula() {
            echo "<p>Matricula será cancelada.</p>";
        }

        public function pagarMensalidade() {
            echo "<p>Pagando a mensalidade do aluno <strong>$this->nome</strong></p>";
        }
    }
<?php
    require_once 'Aluno.php';

    class Bolsista extends Aluno {
        private $bolsa;

        public function __construct($nome, $idade, $sexo, $matricula, $bolsa) {
            parent::__construct($nome, $idade, $sexo, $matricula);
            $this->bolsa = $bolsa;
        }

        public function getBolsa() { return $this->bolsa; }

        public function setBolsa($bolsa) { $this->bolsa = $bolsa; }

        public function renovarBolsa() {
            echo "<p>Bolsa renovada.</p>";
        }

        public function pagarMensalidade() {
            echo "<p><strong>$this->nome</strong> é bolsista! Então paga com desconto de $this->bolsa%</p>";
        }
    }
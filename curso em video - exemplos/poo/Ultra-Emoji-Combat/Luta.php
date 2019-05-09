<?php

    require_once 'Lutador.php';

    class Luta {
        private $desafiado;
        private $desafiante;
        private $rounds;
        private $aprovada;

        public function __construct() {

        }

        public function getDesafiado() {
            return $this->desafiado;
        }
    
        public function getDesafiante() {
            return $this->desafiante;
        }

        public function getRounds() {
            return $this->rounds;
        }

        public function isAprovada() {
            return $this->aprovada;
        }

        public function setDesafiado($desafiado) {
            $this->desafiado = $desafiado;
        }
                
        public function setDesafiante($desafiante) {
            $this->desafiante = $desafiante;
        }
            
        public function setRounds($rounds) {
            $this->rounds = $rounds;
        }
            
        public function setAprovada($aprovada) {
            $this->aprovada = $aprovada;
        }

        public function marcarLuta($l1, $l2) {
            if ($l1 != $l2 && $l1->getCategoria() === $l2->getCategoria()) {
                $this->desafiado = $l1;
                $this->desafiante = $l2;
                $this->aprovada = true;
            }
            else {
                $this->desafiado = null;
                $this->desafiante = null;
                $this->aprovada = false;
            }
        }

        public function lutar() {
            if ($this->isAprovada()) {
                echo "Chegou a hora!!!";
                $this->desafiado->apresentar();
                $this->desafiante->apresentar();

                $vecedor = rand(0, 2);

                switch ($vecedor) {
                    case 0: //Empate
                        echo "<p>Vencerdor: Empate!</p>";
                        $this->desafiado->empatarLuta();
                        $this->desafiante->empatarLuta();
                        break;
                    case 1: //Desafiado vence
                    echo "<p>Vencedor: " . $this->desafiado->getNome() . "</p>";
                        $this->desafiado->ganharLuta();
                        $this->desafiante->perderLuta();
                        break;
                    case 2: //Desafiante vence
                        echo "<p>Vencedor: " . $this->desafiante->getNome() . "</p>";
                        $this->desafiado->perderLuta();
                        $this->desafiante->ganharLuta();
                        break;
                }
            }
            else {
                echo "<p>Luta não pode acontecer</p>";
            }
        }
    }

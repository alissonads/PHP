<?php
    class ContaBanco
    {
        public $numConta;
        protected $tipo;
        private $dono;
        private $saldo;
        private $status;

        public function __construct() {
            $this->saldo = 0;
            $this->status = false;
        }

        public function abrirConta($dono, $tipo) {
            if ($this->status) {
                echo "<p>Impossivel de abrir a conta. A conta de $dono já está ativa.</p>";
                return;
            }
            $this->tipo = $tipo;
            $this->dono = $dono;

            $this->saldo = ($tipo == "CC")? 50 : 150;
            $this->status = true;
            echo "<p>Conta aberta com sucesso.</p>";
        }

        public function fecharConta() {
            if ($this->saldo > 0)
                return "<p>Impossivel de encerrar a conta. Conta ainda com Dinheiro.</p>";
            elseif ($this->saldo < 0) {
                return "<p>Impossivel de encerrar a conta. Conta em débito.</p>";
            }
            
            $this->numConta = -1;
            $this->tipo = "";
            $this->dono = "";
            $this->saldo = 0;
            $this->status = false;
            return "<p>Conta Fechada com sucesso!</p>";
        }

        public function depositar($v) {
            if ($this->status)
                $this->saldo += $v;
            return $this->status;
        }

        public function sacar($v) {
            if ($this->status && $this->saldo > 0)
            {
                $this->saldo -= $v;
                return $v;
            }

            return 0;
        }

        public function pagarMensalidade() {
            if ($this->status)
                $this->saldo -= ($this->tipo) == "CC"? 12 : 20;
            return $this->status;
        }

        public function getNumConta() {
            return $this->numConta;
        }

        public function setNumConta($nc) {
            $this->numConta = $nc;
        }

        public function getTipo() {
            return $this->tipo;
        }
            
        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function getDono() {
            return $this->dono; 
        }
                        
        public function setDono($dono) {
            $this->dono = $dono; 
        }

        public function getSaldo() {
            return $this->saldo;
        }
            
        public function setSaldo($s) {
            $this->saldo = $s;
        }

        public function getStatus() {
            return $this->status;
        }
            
        public function setStatus($s) {
            $this->status = $s;
        }
    }
?>
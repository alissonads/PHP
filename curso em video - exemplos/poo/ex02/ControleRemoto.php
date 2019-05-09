<?php

    require_once 'Controlador.php';

    class ControleRemoto implements Controlador{
        private $volume;
        private $ligado;
        private $tocando;
        private $volumeAnterior;

        public function __construct() {
            $this->volume = 20;
            $this->volumeAnterior = $this->volume;
            $this->ligado = false;
            $this->tocando = false;
        }

        private function getVolume() {
            return $this->volume;
        }

        private function getLigado() {
            return $this->ligado;
        }

        private function getTocando() {
            return $this->tocando;
        }

        private function setVolume($volume) {
            $this->volume = $volume;
        }

        private function setLigado($ligado) {
            $this->ligado = $ligado;
        }

        private function setTocando($tocando) {
            $this->tocando = $tocando;
        }

        public function ligar() {
            $this->setLigado(true);
        }

        public function desligar() {
            $this->pause();
            $this->setLigado(false);
        }
        
        public function abrirMenu() {
            echo "<p>---- MENU ----</p>";
            echo "<br>Está ligado?: " . ($this->getLigado()? "SIM" : "NÃO");
            echo "<br>Está tocando?: " . ($this->getTocando()? "SIM" : "NÃO");
            echo "<br>Volume: ";

            for($i = 1; $i <= $this->getVolume(); $i++) {
                echo "|";
            }
            echo " " . $this->getVolume() . "<br/><br/>";
        }

        public function fecharMenu() {
            echo "<br>Fechando Menu...<br/>";
        }

        public function maisVolume() {
            if ($this->getLigado() && $this->getVolume() <= 50)
                $this->volume++;
        }

        public function menosVolume() {
            if ($this->getLigado() && $this->getVolume() > 0)
                $this->volume--;
        }

        public function ligarMudo() {
            if ($this->getLigado() && $this->getVolume() > 0) {
                $this->volumeAnterior = $this->getVolume();
                $this->setVolume(0);
            }
        }

        public function desligarMudo() {
            if ($this->getLigado() && $this->getVolume() == 0)
                $this->setVolume($this->volumeAnterior);
        }

        public function play() {
            if ($this->getLigado() && !$this->getTocando())
                $this->setTocando(true);
        }

        public function pause() {
            if ($this->getLigado() && $this->getTocando())
                $this->setTocando(false);
        }

    }

?>
<?php
    
    require_once 'People.php';

    class User extends People {
        private $login;
        private $attendedTotal;

        public function __construct($name, $age, $sex, $login) {
            parent::__construct($name, $age, $sex);
            $this->login = $login;
            $this->attendedTotal = 0;
        }

        public function getLogin() { return $this->login; }

        public function getAttendedTotal() { return $this->attendedTotal; }

        public function setLogin($login) { $this->login = $login; }

        public function setAttendedTotal($attendedTotal) { $this->attendedTotal = $attendedTotal; }

        public function addViews() {
            $this->attendedTotal++;
        }
    }
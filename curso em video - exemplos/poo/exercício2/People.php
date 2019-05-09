<?php
    
    abstract class People {
        protected $name;
        protected $age;
        protected $sex;
        protected $experience;

        public function __construct($name, $age, $sex) {
            $this->name = $name;
            $this->age = $age;
            $this->sex = $sex;
            $this->experience = 0;
        }

        public function getName() { return $this->name; }

        public function getAge() { return $this->age; }

        public function getSex() { return $this->sex; }

        public function getExperience() { return $this->experience; }

        public function setName($name) { $this->name = $name; }
        
        public function setAge($age) { $this->age = $age; }
        
        public function setSex($sex) { $this->sex = $sex; }
        
        public function setExperience($experience) { $this->experience = $experience; }

        protected function toWinExperiences($n) {
            $this->experience += $n;
        }
    }
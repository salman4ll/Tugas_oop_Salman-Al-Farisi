<?php
    class Mahasiswa extends Person {
        private $nim;

        public function __construct($nama, $Nim) {
            parent::__construct($nama);
            $this->nim = $Nim;
        }
        public function getNim() {
            return $this->nim;
        }
    }    

    
<?php
    class Person {
        protected $nama;

        public function __construct($nama) {
            $this->nama = $nama;
        }

        public function getNama() {
            return $this->nama;
        }
    }
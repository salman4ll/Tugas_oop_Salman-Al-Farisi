<?php

interface Mengajar {
    public function mengajarMataKuliah($mataKuliah);
}
    class Dosen extends Person implements Mengajar {
        private $kodeDosen;

        public function __construct($nama, $kodeDosen) {
            parent::__construct($nama);
            $this->kodeDosen = $kodeDosen;
        }

        public function getKodeDosen() {
            return $this->kodeDosen;
        }

        public function mengajarMataKuliah($mataKuliah) {
            echo $this->nama . " sedang mengajar mata kuliah " . $mataKuliah->getNama() . "<br>";
        }
    }
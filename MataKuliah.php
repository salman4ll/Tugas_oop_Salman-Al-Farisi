<?php
    class MataKuliah {
        private $nama;
        private $dosen;
        private $jadwal;
    
        public function __construct($nama, $dosen, $jadwal) {
            $this->nama = $nama;
            $this->dosen = $dosen;
            $this->jadwal = $jadwal;
        }
    
        public function getNama() {
            return $this->nama;
        }
    
        public function getDosen() {
            return $this->dosen;
        }
    
        public function getJadwal() {
            return $this->jadwal;
        }
    }
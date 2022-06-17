<?php
    Class Artist {
        private $artistID, $stageName, $birthName, $hometown, $birthDate, $deathDate, $fact;
        
        public function __construct($artistID, $stageName, $birthName, $lastName, $hometown, $birthDate, $deathDate, $fact, $age, $numberOfSongs) {
            $this->artistID = $artistID;
            $this->stageName = $stageName;
            $this->birthName = $birthName;
            $this->lastName = $lastName;
            $this->hometown = $hometown;
            $this->birthDate = $birthDate;
            $this->deathDate = $deathDate;
            $this->fact = $fact;
            $this->age = $age;
            $this->numberOfSongs = $numberOfSongs;
        }
      
        public function getArtistID() {
            return $this->artistID;
        }

        public function getStageName() {
            return $this->stageName;
        }

        public function getBirthName() {
            return $this->birthName;
        }
        
        public function getLastName() {
            return $this->lastName;
        }

        public function getHometown() {
            return $this->hometown;
        }

        public function getBirthDate() {
            return $this->birthDate;
        }

        public function getDeathDate() {
            return $this->deathDate;
        }

        public function getFact() {
            return $this->fact;
        }
        
        public function getAge() {
            return $this->age;
        }
        
        public function getNumberOfSongs() {
            return $this->numberOfSongs;
        }
        
        public function setArtistID($artistID): void {
            $this->artistID = $artistID;
        }

        public function setStageName($stageName): void {
            $this->stageName = $stageName;
        }

        public function setBirthName($birthName): void {
            $this->birthName = $birthName;
        }
        
        public function setLastName($lastName): void {
            $this->lastName = $lastName;
        }

        public function setHometown($hometown): void {
            $this->hometown = $hometown;
        }

        public function setBirthDate($birthDate): void {
            $this->birthDate = $birthDate;
        }

        public function setDeathDate($deathDate): void {
            $this->deathDate = $deathDate;
        }

        public function setFact($fact): void {
            $this->fact = $fact;
        }
        
        public function setAge($age): void {
            $this->age = $age;
        }
        
        public function setNumberOfSongs($numberOfSongs): void {
            $this->numberOfSongs = $numberOfSongs;
        }

    }
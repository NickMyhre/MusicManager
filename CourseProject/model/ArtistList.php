<?php

Class ArtistList {

    private $artists;

    public function __construct() {
        $this->artists = array();
    }

    public function getArtists() {
        return $this->artists;
    }

    public function getArtist($artistID) {
        foreach ($this->artists as $artist) {
            if ((int)$artist->getArtistID() == (int)$artistID) {
                return $artist;
            } else {
                return -1;
            }
        }
    }

    public function addArtist(Artist $artist) {
        $this->artists[] = $artist;
    }
    
    public function addResultSet($result) {
        foreach ($result as $row) {
            $artist = new Artist($row['artistID'], $row['stageName'], $row['birthName'], $row['last'], $row['hometown'], $row['birth'], $row['death'], $row['fact'], $row['age'], $row['songs']);
            $this->addArtist($artist);
        }
    }

    public function getArtistIDs() {
        $artistIDList = array();
        foreach ($this->artists as $artist) {
            $artistIDList[] = $artist->getArtistID();
        }
        return $artistIDList;
    }

}

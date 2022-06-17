<?php

Class SongList {

    private $songs;

    public function __construct() {
        $this->songs = array();
    }

    public function getSongs() {
        return $this->songs;
    }

    public function getSong($songID) {
        foreach ($this->songs as $song) {
            if ((int)$song->getSongID() === (int)$songID) {
                return $song;
            } else {
                return -1;
            }
        }
    }

    public function addSong (Song $song) {
        $this->songs[] = $song;
    }
    
    public function addResultSet($result) {
            foreach ($result as $row) {
            $song = new Song($row['songID'], $row['songName'], $row['length'], $row['writer'], $row['title'], $row['bbDate'],$row['bbRank'], $row['comments'], $row['albumID']);
            $this->addSong($song);
        }
    }
        

    public function getSongIDs() {
        $songIDs = array();
        foreach ($this->songs as $song) {
            $songIDs[] = $song->getSongID();
        }
        return $songIDs;
    }

}

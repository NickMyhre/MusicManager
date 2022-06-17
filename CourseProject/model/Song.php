<?php

Class Song {

    private $songID, $songName, $length, $title, $writer, $bbDate, $bbRank, $comments, $albumID, $mintues, $seconds;

    public function __construct($songID, $songName, $length, $writer, $title, $bbDate, $bbRank, $comments, $albumID) {
        $this->songID = $songID;
        $this->songName = $songName;
        $this->length = $length;
        $this->title = $title;
        $this->writer = $writer;
        $this->bbDate = $bbDate;
        $this->bbRank = $bbRank;
        $this->comments = $comments;
        $this->albumID = $albumID;
    }

    public function setID($value) {
        $this->songID = $value;
    }

    public function getID() {
        return $this->songID;
    }

    public function setName($value) {
        $this->songName = $value;
    }

    public function getName() {
        return $this->songName;
    }

    public function setLength($value) {
        $this->length = $value;
    }

    public function getLength() {
        return $this->length;
    }

    public function setAlbum($value) {
        $this->title = $value;
    }

    public function getAlbum() {
        return $this->title;
    }

    public function setWriter($value) {
        $this->writer = $value;
    }

    public function getWriter() {
        return $this->writer;
    }

    public function setbbDate($value) {
        $this->bbDate = $value;
    }

    public function getbbDate() {
        return $this->bbDate;
    }

    public function setbbRank($value) {
        $this->bbRank = $value;
    }

    public function getbbRank() {
        return $this->bbRank;
    }
    
    public function setComments($value) {
        $this->comments = $value;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setAlbumID($value) {
        $this->albumID = $value;
    }

    public function getAlbumID() {
        return $this->albumID;
    }
    
    public function getMinutes($length) {
        $index = strpos($length, ':', 3) - 3;
        return (int) trim(substr($length, 3, $index));
    }
    
    public function getSeconds($length) {
        $index = strrpos($length, ':') + 1;
        return (int)substr($length, $index);
    }
}

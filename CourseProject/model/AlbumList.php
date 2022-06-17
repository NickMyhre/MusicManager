<?php
Class AlbumList {

    private $albums;

    public function __construct() {
        $this->albums = array();
    }

    public function getAlbums() {
        return $this->albums;
    }

    public function getAlbum($albumID) {
        foreach ($this->albums as $album) {
            if ((int)$album->getAlbumID() == (int)$albumID) {
                return $album;
            } else {
                return -1;
            }
        }
    }

    public function addAlbum(Album $album) {
        $this->albums[] = $album;
    }
    
    public function addResultSet($result) {
        foreach ($result as $row) {
            $row = new Album($row['albumID'], $row['title'], $row['label'], $row['genre'], $row['releaseDate'], $row['fact'], $row['artists']);
            $this->addAlbum($row);
        }
    }

    public function getAlbumIDs() {
        $albumIDList = array();
        foreach ($this->albums as $album) {
            $albumIDList[] = $album->getAlbumID();
        }
        return $albumIDList;
    }

}

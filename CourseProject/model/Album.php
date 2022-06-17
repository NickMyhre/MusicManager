<?php

Class Album {

    private $albumID, $title, $label, $genre, $releaseDate, $fact, $artists;

    public function __construct($albumID, $title, $label, $genre, $releaseDate, $fact, $artists) {
        $this->albumID = $albumID;
        $this->title = $title;
        $this->label = $label;
        $this->genre = $genre;
        $this->releaseDate = $releaseDate;
        $this->fact = $fact;
        $this->artists = $artists;
    }

    public function getAlbumID() {
        return $this->albumID;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }
    
    public function getFormattedRelDate() {
        return trim(substr($this->releaseDate, 0, 10));
    }
    public function getFact() {
        return $this->fact;
    }

    public function getArtists() {
        return $this->artists;
    }

    public function setAlbumID($albumID): void {
        $this->albumID = $albumID;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setLabel($label): void {
        $this->label = $label;
    }

    public function setGenre($genre): void {
        $this->genre = $genre;
    }

    public function setReleaseDate($releaseDate): void {
        $this->releaseDate = $releaseDate;
    }
    
    public function setFact($fact): void {
        $this->fact = $fact;
    }

    public function setArtists($artists): void {
        $this->artists = $artists;
    }

    public function validate_album($albumID = '', $modifying = false) {

        $validate = new Validate();
        $fields = $validate->getFields();

        $fields->addField('albumID', 'Unknown Album');
        $fields->addField('title', 'An album needs a title.');
        $fields->addField('label', 'Record label is required.');
        $fields->addField('genre', 'Enter a genre please.');
        $fields->addField('releaseDate', 'Enter a date in the correct format please.');
        $fields->addField('fact', 'Please enter a cool fact about the album.');
        $fields->addField('artists', 'No artists selected.');

        $validate->text('albumID', $albumID, $modifying);
        $validate->text('title', $this->title);
        $validate->text('label', $this->label);
        $validate->text('genre', $this->genre);
        $validate->date('releaseDate', $this->releaseDate);
        $validate->text('fact', $this->fact);
        $validate->artist('artists', $this->artists);

        if ($fields->hasErrors()) {
            return false;
        } else {
            return true;
        }
    }

}

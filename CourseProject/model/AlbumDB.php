<?php

class AlbumDB {

    public static function get_albums($order = 'title') {

        $db = Database::getDB();

        $query = "SELECT albums.albumID, title, label, genre, releaseDate, albums.fact, GROUP_CONCAT(birthName) AS artists
              FROM albums
              LEFT JOIN albums_artists ON albums.albumID = albums_artists.albumID
              LEFT JOIN artists ON albums_artists.artistID = artists.artistID
              GROUP BY albums.albumID
              ORDER BY $order ASC";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $albums = new AlbumList();
        $albums->addResultSet($result);
        $statement->closeCursor();
        /*foreach ($result as $row) {
            $album = new Album($row['albumID'], $row['title'], $row['label'], $row['genre'], $row['releaseDate'], $row['fact'], $row['artists']);
            $albums[] = $album;
        }*/
        return $albums;
    }

//gets single album and uses relationship tables to join entries with multiple artists into one entry
    public static function get_album_info($albumID) {
        $db = Database::getDB();
        $query = "SELECT albums.albumID, title, label, genre, releaseDate, albums.fact, GROUP_CONCAT(birthName) AS artists 
              FROM albums
              LEFT JOIN albums_artists ON albums.albumID = albums_artists.albumID
              LEFT JOIN artists ON albums_artists.artistID = artists.artistID
              GROUP BY albums.albumID
              HAVING albums.albumID = :albumID";
        $statement = $db->prepare($query);
        $statement->bindValue(":albumID", $albumID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        
        $album = new Album($result['albumID'], $result['title'], $result['label'], $result['genre'], $result['releaseDate'], $result['fact'], $result['artists']);
        return $album;
    }

//gets all artists for an album
    //todo - refactor to return artistList Object
    public static function get_album_artists($albumID) {
        $db = Database::getDB();
        $query = "SELECT birthName, SUBSTR(birthName FROM (INSTR(birthName,' ') + 1)) AS last, FLOOR(DATEDIFF(IFNULL(death, CURRENT_DATE), birth)/365) AS age, IFNULL(COUNT(artists_songs.artistID), 0) As songs,
              artists.artistID, stageName, birthName, hometown, birth, death, fact
              FROM artists 
              INNER JOIN albums_artists ON artists.artistID = albums_artists.artistID
              INNER JOIN artists_songs ON artists.artistID = artists_songs.artistID
              WHERE albums_artists.albumID = :albumID";
        $statement = $db->prepare($query);
        $statement->bindValue(":albumID", $albumID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $artists = new ArtistList();
        $artists->addResultSet($result);
        return $artists;
    }

    public static function add_album($title, $label, $genre, $releaseDate, $fact, $artists) {
        
        $album = new Album('', $title, $label, $genre, $releaseDate, $fact, $artists);
        
        $db = Database::getDB();
        $query = "INSERT INTO albums
            (title, label, genre, releaseDate, fact)
            VALUES
            (:title, :label, :genre, :releaseDate, :fact)";
        $statement = $db->prepare($query);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":label", $label);
        $statement->bindValue(":genre", $genre);
        $statement->bindValue(":releaseDate", $releaseDate);
        $statement->bindValue(":fact", $fact);
        $statement->execute();
        $id = $db->lastInsertID();
        $statement->closeCursor();
        foreach ($artists as $artist) {
            insert_relationships('albums_artists', $id, $artist);
        }
        
    }

    public static function modify_album($albumID, $title, $label, $genre, $releaseDate, $fact, $artists) {


        $album = new Album($albumID, $title, $label, $genre, $releaseDate, $fact, $artists);
        
            $db = Database::getDB();
            $query = "UPDATE albums
            SET title = :title, label = :label, genre = :genre, releaseDate = :releaseDate, fact = :fact
            WHERE albumID = :albumID";
            $statement = $db->prepare($query);
            $statement->bindValue(":albumID", $albumID);
            $statement->bindValue(":title", $title);
            $statement->bindValue(":label", $label);
            $statement->bindValue(":genre", $genre);
            $statement->bindValue(":releaseDate", $releaseDate);
            $statement->bindValue(":fact", $fact);
            $statement->execute();
            $statement->closeCursor();
            delete_relationships('albums_artists', 'albumID', $albumID);
            foreach ($artists as $artist) {
                insert_relationships('albums_artists', $albumID, $artist);
            }
    }

    public static function delete_album($albumID) {
        $db = Database::getDB();
        $query = "DELETE FROM albums
              WHERE albumID = :albumID";
        $statement = $db->prepare($query);
        $statement->bindValue(':albumID', $albumID);
        $statement->execute();
        $statement->closeCursor();
    }

}

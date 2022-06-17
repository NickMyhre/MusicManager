<?php

class SongDB {

    public static function get_songs($order = 'songName') {
        $db = Database::getDB();
        $query = "SELECT songID, songName, length, title, writer, bbDate, bbRank, comments, songs.albumID
              FROM songs 
              LEFT JOIN albums ON songs.albumID=albums.albumID
              ORDER BY $order ASC";

        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        /*
        foreach ($result as $row) {
            $song = new Song($row['songID'], $row['songName'], $row['length'], $row['writer'], $row['title'], $row['bbDate'],$row['bbRank'], $row['comments'], $row['albumID']);
            $songs[] = $song;
        }*/
        $songs = new SongList();
        $songs->addResultSet($result);
        return $songs;
    }

    public static function get_artists_songs($artistID) {
        $db = Database::getDB();
        $query = "SELECT songs.songID, songName, length, title, writer, bbDate, bbRank, comments, songs.albumID
              FROM songs
              INNER JOIN artists_songs ON songs.songID = artists_songs.songID
              LEFT JOIN albums ON songs.albumID=albums.albumID
              WHERE artists_songs.artistID = {$artistID}
              ORDER BY songName ASC";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        /*foreach ($result as $row) {
            $song = new Song($row['songID'], $row['songName'], $row['length'], $row['writer'], $row['title'], $row['bbDate'], $row['bbRank'], $row['comments'], $row['albumID']);
            $songs[] = $song;
        }*/
        $songs = new SongList();
        $songs->addResultSet($result);
        return $songs;
    }

    public static function get_albums_songs($albumID, $order = 'songName') {
        $db = Database::getDB();
        $query = "SELECT songs.songID, songName, length, title, writer, bbDate, bbRank, comments, songs.albumID
              FROM songs
              LEFT JOIN albums 
              ON songs.albumID = albums.albumID
              WHERE songs.albumID = :albumID
              ORDER BY {$order} ASC";
        $statement = $db->prepare($query);
        $statement->bindValue(":albumID", $albumID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        /*$songs = array();
        foreach ($result as $row) {
            $song = new Song($row['songID'], $row['songName'], $row['length'], $row['writer'], $row['title'], $row['bbDate'], $row['bbRank'], $row['comments'], $row['albumID']);
            $songs[] = $song;
        }*/
        $songs = new SongList();
        $songs->addResultSet($result);
        return $songs;
    }

    public static function get_num_of_songs_on_album_from_particular_artist($albumID, $artistID) {
        $db = Database::getDB();
        $query = "SELECT COUNT(songs.songID) AS albumSongs
              FROM songs
              LEFT JOIN albums 
              ON songs.albumID = albums.albumID
              LEFT JOIN artists_songs
              ON songs.songID = artists_songs.songID 
              WHERE songs.albumID = :albumID && artists_songs.artistID = :artistID";
        $statement = $db->prepare($query);
        $statement->bindValue(":albumID", $albumID);
        $statement->bindValue(":artistID", $artistID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['albumSongs'];
    }

    public static function get_song_info($songID) {
        $db = Database::getDB();
        $query = "SELECT songID, songName, length, title, writer, bbDate, bbRank, comments, songs.albumID
              FROM songs 
              LEFT JOIN albums ON songs.albumID=albums.albumID
              WHERE songs.songID = :songID";
        $statement = $db->prepare($query);
        $statement->bindValue(":songID", $songID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        $song = new Song($result['songID'], $result['songName'], $result['length'], $result['writer'], $result['title'], $result['bbDate'], $result['bbRank'], $result['comments'], $result['albumID']);
        return $song;
    }

    public static function get_song_artists($songID) {
        /*SELECT artists.artistID, birthName
              FROM artists 
              INNER JOIN artists_songs ON artists.artistID = artists_songs.artistID*/
        $db = Database::getDB();
        $query = "
                SELECT SUBSTR(birthName FROM (INSTR(birthName,' ') + 1)) AS last, FLOOR(DATEDIFF(IFNULL(death, CURRENT_DATE), birth)/365) AS age, IFNULL(COUNT(artists_songs.artistID), 0) As songs,
              artists.artistID, stageName, birthName, hometown, birth, death, fact
              FROM artists LEFT JOIN artists_songs
              ON artists.artistID = artists_songs.artistID
              WHERE artists_songs.songID = :songID";
        $statement = $db->prepare($query);
        $statement->bindValue(":songID", $songID);
        $statement->execute();
        $result = $statement->fetchAll();
        $artistList = new ArtistList();
        $artistList->addResultSet($result);
        $statement->closeCursor();
        return $artistList;
    }

    public static function add_song($song_name, $song_artists, $length, $bb_ranking, $rank_date, $writer, $comments, $albumID) {
        $db = Database::getDB();

        $query = "INSERT INTO songs
            (songName, length, comments, bbRank, bbDate, writer, albumID)
            VALUES
            (:song_name, :length, :comments, :bb_ranking, :rank_date, :writer,  :albumID)";
        $statement = $db->prepare($query);
        $statement->bindValue(":song_name", $song_name);
        $statement->bindValue(":length", $length);
        $statement->bindValue(":comments", $comments);
        $statement->bindValue(":bb_ranking", $bb_ranking);
        $statement->bindValue(":rank_date", $rank_date);
        $statement->bindValue(":writer", $writer);
        $statement->bindValue(":albumID", $albumID);
        $statement->execute();
        $id = $db->lastInsertID();
        $statement->closeCursor();
        foreach ($song_artists as $artist) {
            insert_relationships('artists_songs', $artist, $id);
        }
    }

    public static function modify_song($songID, $song_name, $song_artists, $length, $bb_ranking, $rank_date, $writer, $comments, $albumID) {
        $db = Database::getDB();

        $query = "UPDATE songs
            SET songName = :song_name, length= :length, comments = :comments, bbRank = :bb_ranking,
            bbDate = :rank_date, writer = :writer, albumID = :albumID
            WHERE songID = :songID";
        $statement = $db->prepare($query);
        $statement->bindValue(":songID", $songID);
        $statement->bindValue(":song_name", $song_name);
        $statement->bindValue(":length", $length);
        $statement->bindValue(":comments", $comments);
        $statement->bindValue(":bb_ranking", $bb_ranking);
        $statement->bindValue(":rank_date", $rank_date);
        $statement->bindValue(":writer", $writer);
        $statement->bindValue(":albumID", $albumID);
        $statement->execute();
        $statement->closeCursor();
        delete_relationships('artists_songs', 'songID', $songID);
        foreach ($song_artists as $artist) {
            insert_relationships('artists_songs', $artist, $songID);
        }
    }

    public static function delete_song($songID) {
        $db = Database::getDB();
        $query = "DELETE FROM songs
              WHERE songID = {$songID}";
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }

}

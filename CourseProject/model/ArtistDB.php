<?php

class ArtistDB {

    //deprecated
    /*public static function get_artists() {
        $db = Database::getDB();
        $query = "SELECT artistID, stageName, birthName, hometown, birth, death, fact 
              FROM artists";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        foreach ($result as $row) {
            $artist = new Artist($row['artistID'], $row['stageName'], $row['birthName'], $row['hometown'], $row['birth'], $row['death'], $row['fact']);
            $artists[] = $artist;
        }
        return $artists;
    }
*/
//gets all info for an artist
//first column modifies birth name column to get last name of artist
//second column calculates age of artist and uses current date if they aren't dead
//third column gets song count if the artist has any songs
    public static function get_artist_info($artistID) {
        $db = Database::getDB();
        $query = "SELECT SUBSTR(birthName FROM (INSTR(birthName,' ') + 1)) AS last, FLOOR(DATEDIFF(IFNULL(death, CURRENT_DATE), birth)/365) AS age, IFNULL(COUNT(artists_songs.artistID), 0) As songs,
              artists.artistID, stageName, birthName, hometown, birth, death, fact
              FROM artists LEFT JOIN artists_songs
              ON artists.artistID = artists_songs.artistID
              WHERE artists.artistID = :artistID";
        $statement = $db->prepare($query);
        $statement->bindValue(":artistID", $artistID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        $artist = new Artist($result['artistID'], $result['stageName'], $result['birthName'], $result['last'], $result['hometown'], $result['birth'], $result['death'], $result['fact'], $result['age'], $result['songs']);
        return $artist;
    }

//same logic as get_artist_info function but gets information for all artists
    public static function get_artist_page($order = 'last') {
        $db = Database::getDB();
        $query = "SELECT birthName, SUBSTR(birthName FROM (INSTR(birthName,' ') + 1)) AS last, FLOOR(DATEDIFF(IFNULL(death, CURRENT_DATE), birth)/365) AS age, IFNULL(COUNT(artists_songs.artistID), 0) As songs,
              artists.artistID, stageName, birthName, hometown, birth, death, fact
              FROM artists LEFT JOIN artists_songs
              ON artists.artistID = artists_songs.artistID
              GROUP BY artists.artistID
              ORDER BY $order ASC";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $artists = new ArtistList();
        $artists->addResultSet($result);
        /*foreach ($result as $row) {
            $artist = new Artist($row['artistID'], $row['stageName'], $row['birthName'], $row['last'], $row['hometown'], $row['birth'], $row['death'], $row['fact'], $row['age'], $row['songs']);
            $artists[] = $artist;
        }*/
        return $artists;
    }

    public static function add_artist($stage_name, $birth_name, $hometown, $birth_date, $death_date, $fact) {
        $db = Database::getDB();
        $query = "INSERT INTO artists
            (stageName, birthName, hometown, birth, death, fact)
            VALUES
            (:stage_name, :birth_name, :hometown, :birth_date, :death_date, :fact)";
        $statement = $db->prepare($query);
        $statement->bindValue(":stage_name", $stage_name);
        $statement->bindValue(":birth_name", $birth_name);
        $statement->bindValue(":hometown", $hometown);
        $statement->bindValue(":birth_date", $birth_date);
        $statement->bindValue(":death_date", $death_date);
        $statement->bindValue(":fact", $fact);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function delete_artist($artistID) {
        $db = Database::getDB();
        $query = "DELETE FROM artists
              WHERE artistID = :artistID";
        $statement = $db->prepare($query);
        $statement->bindValue(':artistID', $artistID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function modify_artist($artistID, $stage_name, $birth_name, $hometown, $birth_date, $death_date, $fact) {
        $db = Database::getDB();
        $query = "UPDATE artists
            SET stageName = :stage_name, birthName = :birth_name, hometown = :hometown,
            birth = :birth_date, death = :death_date, fact = :fact
            WHERE artistID = :artistID";
        $statement = $db->prepare($query);
        $statement->bindValue(":stage_name", $stage_name);
        $statement->bindValue(":birth_name", $birth_name);
        $statement->bindValue(":hometown", $hometown);
        $statement->bindValue(":birth_date", $birth_date);
        $statement->bindValue(":death_date", $death_date);
        $statement->bindValue(":fact", $fact);
        $statement->bindValue(":artistID", $artistID);
        $statement->execute();
        $statement->closeCursor();
    }

}

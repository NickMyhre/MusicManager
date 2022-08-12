<?php

//formats minutes and seconds into valid data format
function song_string ($minutes, $seconds) {
    return "00:" . trim($minutes) . ":". trim($seconds);
}
//returns null if string is empty
function isNull($string) {
    if (empty($string) || $string === false) {
        return null;
    }
    else {
        return $string;
    }
}

//creates new relationships for many-to-many tables
function insert_relationships($table, $key1, $key2) {
    $db = Database::getDB();
    $query = "INSERT INTO {$table}
            VALUES ({$key1}, {$key2})";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

//deletes relationship from many-to-many table
function delete_relationships($table, $column, $id) {
    $db = Database::getDB();
    $query = "DELETE FROM {$table}
    WHERE {$column} = {$id}";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();  
}


?>

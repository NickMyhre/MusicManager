<?php


//gets multiple artist strings
function artist_string($rows) {
    $string ='';
    foreach ($rows as $artist) {
        $string .= $artist['birthName'] . "\n";
    }
    return $string;
}

//formats minutes and seconds into valid data format
function song_string ($minutes, $seconds) {
    return "00:" . trim($minutes) . ":". trim($seconds);
}

function get_minutes($string) {
    $index = strpos($string, ':', 3) - 3;
    return (int) trim(substr($string, 3, $index));
}
function get_seconds($string) {
    $index = strrpos($string, ':') + 1;
    return (int)substr($string, $index);
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

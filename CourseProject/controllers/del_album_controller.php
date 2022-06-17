<?php

//initialize arrays

$artist_list = array();
$artist_deletion_list = array();

//list each artist in album
foreach ($album_artists->getArtists() as $artist) {
    $artist_list[] = $artist->getArtistID();
}
//see if number of songs that artist has in album is the same as the number of all their songs
foreach ($artist_list as $id) {
    $total_artist_songs = count(SongDB::get_artists_songs($id)->getSongs());
    $album_artist_songs = SongDB::get_num_of_songs_on_album_from_particular_artist($albumID, $id);
    if ($total_artist_songs == $album_artist_songs) {
        
        //add artist to deletion list if true
        $artist_deletion_list[] = $id;
    }
}

//display artists data 

if (!empty($artist_deletion_list)) {?>
<h3>
    Artists
</h3>
<?php
$result = new ArtistList();
foreach ($artist_deletion_list as $artist) {
    $result->addArtist(ArtistDB::get_artist_info($artist));
}
include('./view/tables/all_artists.php'); }?>

<form action='.' method='post'>
    <div class="form-group">
            <button type="submit" class="btn btn-primary" name='action' value='destroy'>DESTROY THE DATA</button>
            <button type="submit" class="btn btn-primary" name='action' value='all_albums'>Chicken Out</button>
            <input type="hidden" name="albumID" value="<?php echo $albumID; ?>">
            <?php foreach ($artist_deletion_list as $artist) { ?> 
            <input type="hidden" name="artist_deletion_list[]" value="<?php echo $artist; ?>">
            <?php } ?>
    </div>
</form>
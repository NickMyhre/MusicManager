<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles/main.css">
        <title>Music Manager</title>
    </head>
    <body>
        <header>
            <?php include('./view/header.php');
            ?>
        </header>
        <main>
            <div class="column">
                <?php
                include('./view/action_list.php');
                require_once './SQL/Database.php';
                require_once('./model/Fields.php');
                require_once('./model/Validate.php');
                require_once('./model/AlbumDB.php');
                require_once('./model/ArtistDB.php');
                require_once('./model/SongDB.php');
                require_once('./model/Song.php');
                require_once('./model/Artist.php');
                require_once('./model/ArtistList.php');
                require_once('./model/AlbumList.php');
                require_once('./model/SongList.php');
                require_once('./model/Album.php');
                require_once('./model/general_functions.php');

                $action = filter_input(INPUT_POST, 'action');
                if ($action === NULL) {
                    $action = filter_input(INPUT_GET, 'action');
                }
                $modifying = filter_input(INPUT_POST, 'modifying', FILTER_VALIDATE_BOOLEAN);
                if (empty($modifying)) {
                    $modifying = FALSE;
                }

                switch ($action) {
                    
                    
                    //view, add, delete albums
                    case 'all_albums':
                        $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
                        if (empty($order)) {
                            $result = AlbumDB::get_albums();
                        } else {
                            $result = AlbumDB::get_albums($order);
                        }
                        include('./view/tables/table_headers/albums_header.php');
                        $url = './view/tables/all_albums.php';
                        break;

                    case 'view_album':
                        $albumID = filter_input(INPUT_POST, 'albumID', FILTER_VALIDATE_INT);
                        if (!isset($albumID)) {
                            $albumID = filter_input(INPUT_GET, 'albumID', FILTER_VALIDATE_INT);
                        }
                        $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
                        $album = AlbumDB::get_album_info($albumID);
                        $album_artists = AlbumDB::get_album_artists($albumID);
                        $artist_string = artist_string($album_artists);
                        if (empty($order)) {
                            $result = SongDB::get_albums_songs($albumID);
                        } else {
                            $result = SongDB::get_albums_songs($albumID, $order);
                        }
                        include('./view/single_entries/album.php');
                        $url = './view/tables/all_songs.php';
                        break;

                    case 'add_album':
                        $url = './view/add_forms/' . $action . '.php';
                        break;

                    case 'del_album':
                        $albumID = filter_input(INPUT_POST, 'albumID', FILTER_VALIDATE_INT);
                        $result = SongDB::get_albums_songs($albumID);
                        $album_artists = AlbumDB::get_album_artists($albumID);
                        include './view/tables/table_headers/confirmation_header.php';
                        include('./view/tables/all_songs.php');
                        $url = './controllers/del_album_controller.php';
                        break;

                    
                    //deletes an album, its songs, and the artists if their last songs are getting deleted
                    case 'destroy':
                        $albumID = filter_input(INPUT_POST, 'albumID', FILTER_VALIDATE_INT);
                        $artist_deletion_list = filter_input(INPUT_POST, 'artist_deletion_list', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        AlbumDB::delete_album($albumID);
                        if (isset($artist_deletion_list)) {
                            foreach ($artist_deletion_list as $artist) {
                                ArtistDB::delete_artist($artist);
                            }
                        }
                        
                        
                        //view, add, delete artists
                    case 'all_artists':
                        $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
                        if (empty($order)) {
                            $result = ArtistDB::get_artist_page();
                        } else {
                            $result = ArtistDB::get_artist_page($order);
                        }
                        include('./view/tables/table_headers/artists_header.php');
                        $url = './view/tables/all_artists.php';
                        break;

                    case 'view_artist':
                        $artistID = filter_input(INPUT_POST, 'artistID', FILTER_VALIDATE_INT);
                        $result = SongDB::get_artists_songs($artistID);
                        $artist = ArtistDB::get_artist_info($artistID);
                        include('./view/single_entries/artist.php');                      
                        $url = './view/tables/all_songs.php';
                        break;

                    case 'add_artist':
                        $url = './view/add_forms/' . $action . '.php';
                        break;

                    case 'del_artist':
                        $artistID = filter_input(INPUT_POST, 'artistID', FILTER_VALIDATE_INT);
                        ArtistDB::delete_artist($artistID);
                        header('Location: .?action=all_artists');
                        break;
                    
                    
                    //view, add, delete songs
                    case 'all_songs':
                        $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
                        if (empty($order)) {
                            $result = SongDB::get_songs();
                        } else {
                            $result = SongDB::get_songs($order);
                        }
                        include('./view/tables/table_headers/songs_header.php');
                        $url = './view/tables/all_songs.php';
                        break;

                    case 'view_song':
                        $songID = filter_input(INPUT_POST, 'songID', FILTER_VALIDATE_INT);
                        $song = SongDB::get_song_info($songID);
                        $song_artists = SongDB::get_song_artists($songID);
                        $artist_string = artist_string($song_artists);
                        include('./view/single_entries/song.php');
                        break;

                    case 'add_song':
                        $url = './view/add_forms/' . $action . '.php';
                        break;

                    case 'delete_song':
                        $songID = filter_input(INPUT_POST, 'songID', FILTER_VALIDATE_INT);
                        SongDB::delete_song($songID);
                        header('Location: .?action=all_songs');
                        break;

                    
                    //displaying modification pages
                    case 'modify_album_page':
                        $url = './view/modify_forms/modify_album.php';
                        
                        $albumID = filter_input(INPUT_POST, 'rowID', FILTER_VALIDATE_INT);
                        $album = AlbumDB::get_album_info($albumID);
                        $title = filter_input(INPUT_POST, 'title');
                        $artists = filter_input(INPUT_POST, 'artists', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        $genre = filter_input(INPUT_POST, 'genre');
                        $label = filter_input(INPUT_POST, 'label');
                        $release_date = filter_input(INPUT_POST, 'release_date');
                        $fact = filter_input(INPUT_POST, 'fact');
                        break;

                    case 'modify_artist_page':
                        $url = './view/modify_forms/modify_artist.php';

                        $artistID = filter_input(INPUT_POST, 'rowID', FILTER_VALIDATE_INT);
                        $stage_name = filter_input(INPUT_POST, 'stage_name');
                        $birth_name = filter_input(INPUT_POST, 'birth_name');
                        $hometown = filter_input(INPUT_POST, 'hometown');
                        $birth_date = filter_input(INPUT_POST, 'birth_date');
                        $death_date = filter_input(INPUT_POST, 'death_date');
                        $fact = filter_input(INPUT_POST, 'fact');
                        break;

                    case 'modify_song_page':
                        $url = './view/modify_forms/modify_song.php';

                        $songID = filter_input(INPUT_POST, 'rowID', FILTER_VALIDATE_INT);
                        $albumID = filter_input(INPUT_POST, 'albumID', FILTER_VALIDATE_INT);
                        $song_name = filter_input(INPUT_POST, 'song_name');
                        $artists = filter_input(INPUT_POST, 'artists', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        $album_name = filter_input(INPUT_POST, 'album_name');
                        $comments = filter_input(INPUT_POST, 'comments');
                        $length = filter_input(INPUT_POST, 'length');
                        $bb_ranking = filter_input(INPUT_POST, 'bb_ranking');
                        $song_artist = filter_input(INPUT_POST, 'song_artist');
                        $rank_date = filter_input(INPUT_POST, 'rank_date');
                        $writer = filter_input(INPUT_POST, 'writer');
                        break;

                    
                    
                    //adding new entries
                    case 'add_album_entry':
                        $title = filter_input(INPUT_POST, 'title');
                        $artists = filter_input(INPUT_POST, 'artists', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        $genre = filter_input(INPUT_POST, 'genre');
                        $label = filter_input(INPUT_POST, 'label');
                        $releaseDate = filter_input(INPUT_POST, 'release_date');
                        $fact = filter_input(INPUT_POST, 'fact');
                        AlbumDB::add_album($title, $label, $genre, $releaseDate, $fact, $artists);
                        header('Location: .?action=all_albums');
                        break;

                    case 'add_artist_entry':
                        $stage_name = filter_input(INPUT_POST, 'stage_name');
                        $birth_name = filter_input(INPUT_POST, 'birth_name');
                        $hometown = filter_input(INPUT_POST, 'hometown');
                        $birth_date = filter_input(INPUT_POST, 'birth_date');
                        $death_date = isNull(filter_input(INPUT_POST, 'death_date'));
                        $fact = filter_input(INPUT_POST, 'fact');

                        //value output test
                        /* echo 's: ' .$stage_name;
                          echo 'b: '. $birth_name;
                          echo 'h: '. $hometown;
                          echo 'bd: '. $birth_date;
                          echo "dd: ". gettype($death_date);
                          echo "f: ". $fact; */


                        ArtistDB::add_artist($stage_name, $birth_name, $hometown, $birth_date, $death_date, $fact);
                        header('Location: .?action=all_artists');
                        break;

                    case 'add_song_entry':
                        $song_name = filter_input(INPUT_POST, 'song_name');
                        $song_artists = filter_input(INPUT_POST, 'song_artists', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

                        //song length operations
                        $minutes = filter_input(INPUT_POST, 'minutes', FILTER_VALIDATE_INT);
                        $seconds = filter_input(INPUT_POST, 'seconds', FILTER_VALIDATE_INT);
                        $length = song_string($minutes, $seconds);

                        $bb_ranking = isNull(filter_input(INPUT_POST, 'bb_ranking'));
                        $rank_date = isNull(filter_input(INPUT_POST, 'rank_date'));
                        $comments = isNull(filter_input(INPUT_POST, 'comments'));
                        $writer = filter_input(INPUT_POST, 'writer');
                        $albumID = isNull(filter_input(INPUT_POST, 'albumID'));

                        //value output test
                        /* echo 'name: ' . $song_name ;
                          echo 'length'. $length;
                          echo 'rank: ' . $bb_ranking;
                          echo 'date: '. $rank_date;
                          echo 'comment: '. $comments;
                          echo 'writer: '. $writer;
                          echo 'album: ' . gettype($albumID);

                          print_r($song_artists); */
                        SongDB::add_song($song_name, $song_artists, $length, $bb_ranking, $rank_date, $writer, $comments, $albumID);

                        //display album page if song is added to album
                        if ($albumID === null) {
                            header('Location: .?action=all_songs');
                        } else {
                            header("Location: .?action=view_album&albumID={$albumID}");
                        }
                        break;
                    
                        
                        
                        //modifying existing entries
                    case 'modify_album_entry':
                        
                        $rowID = filter_input(INPUT_POST, 'rowID', FILTER_VALIDATE_INT);
                        $title = filter_input(INPUT_POST, 'title');
                        $artists = filter_input(INPUT_POST, 'artists', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        $genre = filter_input(INPUT_POST, 'genre');
                        $label = filter_input(INPUT_POST, 'label');
                        $release_date = filter_input(INPUT_POST, 'release_date');
                        $fact = filter_input(INPUT_POST, 'fact');

                        //value output test
                        /* echo 'title: ' . $title ;
                          echo 'artists: ' . print_r($artists);
                          echo 'genre: ' . $genre;
                          echo 'label: '. $label;
                          echo 'release date: '. $release_date;
                          echo 'fact: '. $fact;
                          echo $rowID; */

                        $error = AlbumDB::modify_album($rowID, $title, $label, $genre, $release_date, $fact, $artists);
                        print_r($error);
                        //header('Location: .?action=all_albums');
                        break;

                    case 'modify_artist_entry':
                        $rowID = filter_input(INPUT_POST, 'rowID', FILTER_VALIDATE_INT);
                        $stage_name = filter_input(INPUT_POST, 'stage_name');
                        $birth_name = filter_input(INPUT_POST, 'birth_name');
                        $hometown = filter_input(INPUT_POST, 'hometown');
                        $birth_date = filter_input(INPUT_POST, 'birth_date');
                        $death_date = filter_input(INPUT_POST, 'death_date');
                        $fact = filter_input(INPUT_POST, 'fact');
                        ArtistDB::modify_artist($rowID, $stage_name, $birth_name, $hometown, $birth_date, $death_date, $fact);
                        break;

                    case 'modify_song_entry':
                        $rowID = filter_input(INPUT_POST, 'rowID', FILTER_VALIDATE_INT);
                        $song_name = filter_input(INPUT_POST, 'song_name');
                        $song_artists = filter_input(INPUT_POST, 'song_artists', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

                        //song length operations
                        $minutes = filter_input(INPUT_POST, 'minutes', FILTER_VALIDATE_INT);
                        $seconds = filter_input(INPUT_POST, 'seconds', FILTER_VALIDATE_INT);
                        $length = song_string($minutes, $seconds);

                        $bb_ranking = isNull(filter_input(INPUT_POST, 'bb_ranking'));
                        $rank_date = isNull(filter_input(INPUT_POST, 'rank_date'));
                        $comments = isNull(filter_input(INPUT_POST, 'comments'));
                        $writer = filter_input(INPUT_POST, 'writer');
                        $albumID = isNull(filter_input(INPUT_POST, 'albumID', FILTER_VALIDATE_INT));

                        //value output test
                        /* echo 'name: ' . $song_name ;
                          echo 'length'. $length;
                          echo 'rank: ' . gettype($bb_ranking);
                          echo 'date: '. $rank_date;
                          echo 'comment: '. $comments;
                          echo 'writer: '. $writer;
                          echo 'album: ' . gettype($albumID);
                          echo $rowID; */

                        SongDB::modify_song($rowID, $song_name, $song_artists, $length, $bb_ranking, $rank_date, $writer, $comments, $albumID);
                        header('Location: .?action=all_songs');
                        break;

                    //home page
                    default :
                        ?> 
                        <div class="jumbotron jumbotron-fluid add_data">
                            <div class = "container">
                                <h1 class = "display-4">Welcome to the Music Manager!</h1>
                                <p class = "lead">Click a link to get started and begin managing your musical data.</p>
                            </div> 
                        </div>
                        <?php
                        break;
                }

                if (isset(($url))) {
                    include("$url");
                }
                ?>
            </div>
        </main>
        <footer>
<?php include('./view/footer.php'); ?>
        </footer>
    </body>
</html>

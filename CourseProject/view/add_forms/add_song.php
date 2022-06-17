<form action='.' method='post'>
    <div class='add_data'>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Song Name</label>
                <input type ="text" class="form-control" name="song_name" placeholder="Song Name" required>
            </div>
        </div>
        <div class="form-row">
            <label>Album</label>
            <div class="form-group col-md-12">
                <select name="albumID">
                    <option  class="form-control" value="">None</option>
                <?php $albums = AlbumDB::get_albums();
                foreach ($albums->getAlbums() as $album) { 
                    // set artist value and select the album from previous entry if modifying
                    ?>
                    <option class="form-control" value="<?php echo $album->getAlbumID()?>">
                        <?php echo $album->getTitle(); ?>
                    </option>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Comments</label>
                <input type="text" class="form-control" name="comments" placeholder="Comments">
            </div>
        </div>
        <div class="songLength">
        <label>Length</label>
        <div class="form-row">  
            <div class="form-group col-md-6">
                <input type="number" class="form-control" name="minutes" placeholder="minutes" min="0" required>
            </div>
            <div class="form-group col-md-6">
                <input type="number" class="form-control" name="seconds" placeholder="seconds" min="0" max="60" required>
            </div>
        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Billboard Ranking</label>
                <input type="int" class="form-control" name="bb_ranking" placeholder="Billboard Ranking" min="0">
            </div>
            <div class="form-group col-md-6">
                <label>Billboard Ranking Date</label>
                <input type="date" class="form-control" name="rank_date" placeholder="Ranking Date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Artist</label>
                <?php $result = ArtistDB::get_artist_page(); ?>
                <select class="form-control" name='song_artists[]' multiple size="2" required>                    
                    <?php foreach ($result->getArtists() as $artist) { 
                        
                        // set artist value and select the artists from previous entry if modifying
                        
                        ?>
                    <option value="<?php echo $artist->getArtistID(); ?>">
                            <?php echo $artist->getBirthName(); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Songwriter Name</label>
                <input type="text" class="form-control" name='writer' placeholder="Songwriter Name" required>
            </div>
        </div>
            <div class="form-group">
                <div class="form-check">
                    <button type="submit" class="btn btn-primary"">Submit Song</button>
                    <input type="hidden" name="action" value="add_song_entry">
                </div>
            </div>

    </div>
</form>

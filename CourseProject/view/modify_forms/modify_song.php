<form action='.' method='post'>
    <div class='add_data'>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Song Name</label>
                <input type ="text" class="form-control" name="song_name" placeholder="Song Name" value="<?php {echo $song->getName(); }?>" required>
            </div>
        </div>
        <div class="form-row">
            <label>Album</label>
            <div class="form-group col-md-12">
                <select name="albumID">
                    <option  class="form-control" value="">None</option>
                <?php
                foreach ($albums->getAlbums() as $album) { 
                    // set artist value and select the album from previous entry if modifying
                    ?>
                    <option class="form-control" value="<?php echo $album->getAlbumID()?>" <?php if ($albumID === (int)$album->getAlbumID()) { ?> selected <?php } ?>>
                        <?php echo $album->getTitle(); ?>
                    </option>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Comments</label>
                <input type="text" class="form-control" name="comments" placeholder="Comments" value="<?php {echo $song->getComments(); }?>">
            </div>
        </div>
        <div class="songLength">
        <label>Length</label>
        <div class="form-row">  
            <div class="form-group col-md-6">
                <input type="number" class="form-control" name="minutes" placeholder="minutes" min="0" value="<?php {echo $song->getMinutes(); }?>" required>
            </div>
            <div class="form-group col-md-6">
                <input type="number" class="form-control" name="seconds" placeholder="seconds" min="0" max="60" value="<?php { echo $song->getSeconds(); }?>"required>
            </div>
        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Billboard Ranking</label>
                <input type="int" class="form-control" name="bb_ranking" placeholder="Billboard Ranking" min="0" value="<?php {echo (int)$song->getbbRank(); }?>">
            </div>
            <div class="form-group col-md-6">
                <label>Billboard Ranking Date</label>
                <input type="date" class="form-control" name="rank_date" placeholder="Ranking Date" value="<?php {echo $song->getFormattedbbDate(); }?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Artist</label>
                <select class="form-control" name='song_artists[]' multiple size="2" required>                    
                    <?php foreach ($result->getArtists() as $artist) { 
                        
                        // set artist value and select the artists from previous entry if modifying
                        
                        ?>
                    <option value="<?php echo $artist->getArtistID(); ?>" <?php if (in_array((int)$artist->getArtistID(), $artists)) { ?> selected <?php } ?> >
                            <?php echo $artist->getBirthName(); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Songwriter Name</label>
                <input type="text" class="form-control" name='writer' placeholder="Songwriter Name" value="<?php {echo $song->getWriter(); }?>" required>
            </div>
        </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Modify Song</button>
                <input type="hidden" name="rowID" value="<?php echo $songID; ?>">
                <input type="hidden" name="action" value="modify_song_entry">
            </div>

    </div>
</form>

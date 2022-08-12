
<form action='.' method="post">
    <div class='add_data'>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Album Title</label>
                <input type ="text" class="form-control" name="title" placeholder="Album Title" value="<?php {echo $album->getTitle(); }?>" required>
            </div>
        </div>
        <div class="form-group">  
            <label>Album Artist</label>
            <?php  ?>
            <select class="form-control" name='artists[]' multiple size="2" required>                    
                <?php foreach ($result->getArtists() as $artist) { 
                    // set artist value and select the artists from previous entry if modifying
                    ?>
                <option value="<?php echo $artist->getArtistID(); ?>" <?php if ( in_array((int)$artist->getArtistID(), $artists)) { ?> selected <?php } ?>>
                    <?php echo $artist->getBirthName(); ?>
                </option>            
                <?php } ?>
            </select>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6" >
                <label>Genre</label>
                <input type="text" class="form-control" name="genre" placeholder="Genre" value="<?php {echo $album->getGenre(); }?>" required>
            </div>
            <div class="form-group col-md-6">
                <label>Album Label</label>
                <input class="form-control" name="label" placeholder="Album Label" value="<?php {echo $album->getLabel();} ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Release Date</label>
                <input type="date" class="form-control" name="release_date" placeholder="Release Date" value="<?php {echo $album->getFormattedRelDate(); }?>" required>
            </div>
            <div class="form-group col-md-6">
                <label>Notable Fact</label>
                <input type="text" class="form-control" name="fact" placeholder="Notable Fact" value="<?php {echo $album->getFact(); }?>">
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Modify Album</button>
            <input type="hidden" name="rowID" value="<?php echo $album->getAlbumID(); ?>">
            <input type="hidden" name="action" value="modify_album_entry">
        </div>
    </div>
</form>

<form action='.' method="post">
    <div class='add_data'>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Album Title</label>
                <input type ="text" class="form-control" name="title" placeholder="Album Title">
            </div>
        </div>
        <div class="form-group">  
            <label>Album Artist</label>
            <?php $result = ArtistDB::get_artist_page(); ?>
            <select class="form-control" name='artists[]' multiple size="2" required>                    
                <?php foreach ($result->getArtists() as $artist) { 
                    // set artist value and select the artists from previous entry if modifying
                    ?>
                <option value="<?php echo $artist->getArtistID(); ?>" ?>
                    <?php echo $artist->getBirthName(); ?>
                </option>            
                <?php } ?>
            </select>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6" >
                <label>Genre</label>
                <input type="text" class="form-control" name="genre" placeholder="Genre" required>
            </div>
            <div class="form-group col-md-6">
                <label>Album Label</label>
                <input class="form-control" name="label" placeholder="Album Label" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Release Date</label>
                <input type="date" class="form-control" name="release_date" placeholder="Release Date" required>
            </div>
            <div class="form-group col-md-6">
                <label>Notable Fact</label>
                <input type="text" class="form-control" name="fact" placeholder="Notable Fact"">
            </div>
        </div>      

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="type" value="album">Submit Album</button>
            <input type="hidden" name="action" value="add_album_entry">
        </div>
    </div>
</form>
<form action='.' method="post">
    <div class='add_data'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Stage Name</label>
                <input type ="text" class="form-control" name="stage_name" placeholder="Stage Name" value="<?php {echo $artist->getStageName(); }?>">
            </div>
            <div class="form-group col-md-6">
                <label>Birth Name</label>
                <input type ="text" class="form-control" name="birth_name" placeholder="Birth Name" value="<?php {echo $artist->getBirthName(); }?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Hometown</label>
            <input type="text" class="form-control" name="hometown" placeholder="Hometown" value="<?php {echo $artist->getHometown(); }?>">
        </div>
        <div class="form-group">
            <label>Birth Date</label>
            <input type="date" class="form-control" name="birth_date" placeholder="Birth Date" value="<?php {echo $artist->getFormattedBirthDate(); }?>" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Death Date</label>
                <input type="date" class="form-control" name="death_date" placeholder="Death Date" value="<?php {echo $artist->getFormattedDeathDate(); }?>">
            </div>
            <div class="form-group col-md-6">
                <label>Notable Fact</label>
                <input type="text" class="form-control" name="fact" placeholder="Notable Fact" value="<?php {echo $artist->getFact(); }?>" required>
            </div>
        </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Modify Artist</button>
                <input type="hidden" name="rowID" value="<?php echo $artistID; ?>">
                <input type="hidden" name="action" value="modify_artist_entry">
            </div>
    </div>
</form>
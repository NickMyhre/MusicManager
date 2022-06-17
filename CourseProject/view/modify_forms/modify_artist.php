<form action='.' method="post">
    <div class='add_data'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Stage Name</label>
                <input type ="text" class="form-control" name="stage_name" placeholder="Stage Name" value="<?php {echo $stage_name; }?>">
            </div>
            <div class="form-group col-md-6">
                <label>Birth Name</label>
                <input type ="text" class="form-control" name="birth_name" placeholder="Birth Name" value="<?php {echo $birth_name; }?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Hometown</label>
            <input type="text" class="form-control" name="hometown" placeholder="Hometown" value="<?php {echo $hometown; }?>">
        </div>
        <div class="form-group">
            <label>Birth Date</label>
            <input type="date" class="form-control" name="birth_date" placeholder="Birth Date" value="<?php {echo trim($birth_date); }?>" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Death Date</label>
                <input type="date" class="form-control" name="death_date" placeholder="Death Date" value="<?php {echo trim($death_date); }?>">
            </div>
            <div class="form-group col-md-6">
                <label>Notable Fact</label>
                <input type="text" class="form-control" name="fact" placeholder="Notable Fact" value="<?php {echo $fact; }?>" required>
            </div>
        </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Modify Artist</button>
                <input type="hidden" name="rowID" value="<?php echo $artistID; ?>">
                <input type="hidden" name="action" value="modify_artist_entry">
            </div>
    </div>
</form>
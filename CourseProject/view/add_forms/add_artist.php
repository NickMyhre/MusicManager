<form action='.' method="post">
    <div class='add_data'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Stage Name</label>
                <input type ="text" class="form-control" name="stage_name" placeholder="Stage Name">
            </div>
            <div class="form-group col-md-6">
                <label>Birth Name</label>
                <input type ="text" class="form-control" name="birth_name" placeholder="Birth Name" required>
            </div>
        </div>
        <div class="form-group">
            <label>Hometown</label>
            <input type="text" class="form-control" name="hometown" placeholder="Hometown">
        </div>
        <div class="form-group">
            <label>Birth Date</label>
            <input type="date" class="form-control" name="birth_date" placeholder="Birth Date" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Death Date</label>
                <input type="date" class="form-control" name="death_date" placeholder="Death Date">
            </div>
            <div class="form-group col-md-6">
                <label>Notable Fact</label>
                <input type="text" class="form-control" name="fact" placeholder="Notable Fact" required>
            </div>
        </div>
        <!-- Display different button depending on modifying variable -->
        <div class="form-group">
            <div class="form-check">
                <button type="submit" class="btn btn-primary">Submit Artist</button>
                <input type="hidden" name="action" value="add_artist_entry">
            </div>
        </div>
    </div>
</form>
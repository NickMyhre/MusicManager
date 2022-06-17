<div class='header'><h1 class="display-3">Artists</h1>
    <form action="." method="post" class="sort">
        <label>Sort By: </label>
        <select name="order">
            <option value="last" selected>Last Name</option>
            <option value="age">Age</option>
            <option value="songs">Number of Songs</option>
        </select>
        <input type="submit" value="Sort">
        <input type='hidden' name='action' value='all_artists'>
    </form>
</div>
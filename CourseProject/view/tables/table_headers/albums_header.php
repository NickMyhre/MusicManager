<div class="header">    
    <h1 class="display-3">Albums</h1>
    <form action="." method="post" class="sort">
        <label>Sort By: </label>
        <select name="order">
            <option value="title" selected>Album Title</option>
            <option value="artists">Artist</option>
            <option value="genre">Genre</option>
            <option value="label">Label</option>
            <option value="releaseDate">Release Date</option>
        </select>
        <input type="submit" value="Sort">
        <input type='hidden' name='action' value='all_albums'>
    </form>
</div>
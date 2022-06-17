<div class='header'>
    <h1 class="display-3">Songs</h1>
    <form action="." method="post" class="sort">
        <label>Sort By: </label>
        <select name="order">
            <option value="songName" selected>Song Title</option>
            <option value="title">Album</option>
            <option value="writer">Writer</option>
        </select>
        <input type="submit" value="Sort">
        <input type='hidden' name='action' value="all_songs">
    </form>
</div>
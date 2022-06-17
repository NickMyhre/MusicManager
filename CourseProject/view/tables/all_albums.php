<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Album Title</th>
            <th scope="col">Artist</th>
            <th scope="col">Genre</th>
            <th scope="col">Label</th>
            <th scope="col">Release Date</th>
            <th scope="col" class="btn-col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result->getAlbums() as $album) {
            ?>
            <tr>
                <?php
                $artists = AlbumDB::get_album_artists($album->getAlbumID());
                
                ?>
                <td><?php echo $album->getAlbumID(); ?> </td>
                <td><?php echo $album->getTitle(); ?></td>
                <td><?php echo $album->getArtists(); ?></td>
                <td><?php echo $album->getGenre(); ?></td>
                <td><?php echo $album->getLabel(); ?></td>
                <td><?php echo $album->getFormattedRelDate(); ?></td>
                <td class="btn-col"> 
                    
                    <!-- View Button -->
                    <form action=".?action=view_album" method="post">
                        <input type="submit" value="View" class="item-action">
                        <input type="hidden" value="<?php echo $album->getAlbumID(); ?> " name="albumID" >            
                    </form>
                    
                    <!-- Modify Button -->
                    <form action="." method="post">
                        <input type="submit" value="Modify" class="item-action">
                        <input type="hidden" value="<?php echo $album->getAlbumID(); ?> " name="rowID" >
                        <input type="hidden" value="modify_album_page" name="action" >
                    </form>
                    
                    <!-- Delete Button -->
                    <form action=".?action=del_album" method="post">
                        <input type="submit" value="Delete" class="item-action">
                        <input type="hidden" value="<?php echo $album->getAlbumID(); ?> " name="albumID" >            
                    </form> </td>

                <?php
            }
            ?>
        </tr>
    </tbody>
</table>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Song Title</th>
            <th scope="col">Album</th>
            <th scope="col">Writer</th>
            <th scope="col" class="btn-col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($result)) {
        foreach ($result->getSongs() as $song) {
            ?>
            <tr>
                <td><?php echo $song->getID(); ?> </td>
                <td><?php echo $song->getName(); ?></td>
                <td><?php echo $song->getAlbum(); ?></td>
                <td><?php echo $song->getWriter(); ?></td>
                <td class="btn-col"> 
                    
                    <!-- View Button -->
                    <form action="." method="post">
                        <input type="submit" value="View" class="item-action">
                        <input type="hidden" value="<?php echo $song->getID(); ?> " name="songID">
                        <input type="hidden" value="view_song" name="action" >
                    </form>
                    
                    <!-- Modify Button -->
                    <form action="." method="post">
                        <input type="submit" value="Modify" class="item-action">
                        <input type="hidden" value="<?php echo $song->getID(); ?> " name="rowID">
                        <input type="hidden" value="modify_song_page" name="action" >
                    </form>
                    
                    <!-- Delete Button -->
                    <form action="." method="post">
                        <input type="submit" value="Delete" class="item-action">
                        <input type="hidden" value="<?php echo $song->getID(); ?> " name="songID">
                        <input type="hidden" value="delete_song" name="action" >
                    </form> 
                </td>


                <?php
        } }
            ?>
        </tr>
    </tbody>
</table>
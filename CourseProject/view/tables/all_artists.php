<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Last Name</th>
            <th scope="col">Age</th>
            <th scope="col">Number of Songs</th>
            <th scope="col" class="btn-col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result->getArtists() as $artist) {
            //format dates for html input field

            $death_f = substr($artist->getDeathDate(), 0, 10);
            $birth_f = substr($artist->getBirthDate(), 0, 10);
            ?>
            <tr>
                <td><?php echo $artist->getArtistID(); ?> </td>
                <td><?php echo $artist->getLastName(); ?></td>
                <td><?php echo $artist->getAge(); ?></td>
                <td><?php echo $artist->getNumberOfSongs(); ?></td>
                <td class="btn-col"> 
                    
                    <!-- View Button -->
                    <form action="." method="post">
                        <input type="hidden" value="<?php echo $artist->getArtistID(); ?>" name ="artistID" > 
                        <input type="hidden" value="view_artist" name="action" >
                        <input type="submit" value="View" class="item-action"> 
                    </form>
                    
                    <!-- Modify Button -->
                    <form action="." method="post">
                        <input type="submit" value="Modify" class="item-action">
                        <input type="hidden" value="<?php echo $artist->getArtistID(); ?> " name ="rowID">
                        <input type="hidden" value="<?php echo $artist->getStageName(); ?> " name="stage_name" >
                        <input type="hidden" value="<?php echo $artist->getBirthName(); ?> " name="birth_name" >
                        <input type="hidden" value="<?php echo $artist->getHometown(); ?> " name="hometown" >
                        <input type="hidden" value="<?php echo $birth_f; ?> " name="birth_date" >
                        <input type="hidden" value="<?php echo $death_f; ?> " name="death_date" >
                        <input type="hidden" value="<?php echo $artist->getFact(); ?> " name="fact" >
                        <input type="hidden" value="modify_artist_page" name="action" >
                    </form>
                    
                    <!-- Delete Button -->
                    <!-- Only appears if the artist has no songs in the database -->
                    <?php if ($artist->getNumberOfSongs() == 0) { ?>
                    <form action="." method="post">
                        <input type="submit" value="Delete" class="item-action">
                        <input type="hidden" value="del_artist" name="action" >
                        <input type="hidden" value="<?php echo $artist->getAlbumID(); ?> " name ="artistID">            
                    </form> <?php } ?>
                </td>
                <?php
            }
            ?>
        </tr>

    </tbody>
</table>
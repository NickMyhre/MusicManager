<div class="single">
    <h1 class="display-3"><?php echo $song->getName(); ?></h1>
    <dl class="row">

        <dt class="col-sm-3 text-truncate">Song Artist(s)</dt>
        <dd class="col-sm-9"><?php echo $artist_string; ?></dd>

        <dt class="col-sm-3 text-truncate">Song Writer</dt>
        <dd class="col-sm-9"><?php echo $song->getWriter(); ?></dd>

        <dt class="col-sm-3 text-truncate">Song Length</dt>
        <dd class="col-sm-9"><?php echo $song->getLength(); ?></dd>

        <dt class="col-sm-3">Billboard Rank</dt>
        <dd class="col-sm-9">
            <p><?php echo $song->getbbRank(); ?></p>
        </dd>

        <dt class="col-sm-3">Billboard Rank Date</dt>
        
        <!-- slice time value off datetime -->
        <dd class="col-sm-9"><?php echo $song->getFormattedbbDate(); ?></dd>

        <dt class="col-sm-3">Comments</dt>
        <dd class="col-sm-9">
            <?php
            if (empty($song->getComments())) {
                $string = 'I have NOTHING to say here.';
            } else {
                $string = $song->getComments();
            }
            echo $string
            ?>
        </dd>

        <dt class="col-sm-3">Album</dt>
        <dl class="row">
            <dt class="col-sm-6"><?php echo $song->getAlbum(); ?></dt>
            <dt class="col-sm-3"><form action="." method="post">
                    <input type="submit" value="View Song Album">
                    <input type="hidden" value ="<?php echo $song->getAlbumID(); ?>" name="albumID">
                    <input type="hidden" value="view_album" name="action">
                </form></dt>
        </dl>
    </dl>
</div>
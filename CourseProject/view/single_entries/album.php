<div class="single">
<h1 class="display-3"><?php echo $album->getTitle() ; ?></h1>
<dl class="row">
    <dt class="col-sm-3">Artists</dt>
  <dd class="col-sm-9"><?php echo $album->getArtists(); ?></dd>
  
  <dt class="col-sm-3">Label</dt>
  <dd class="col-sm-9"><?php echo $album->getLabel() ; ?></dd>

  <dt class="col-sm-3">Genre</dt>
  <dd class="col-sm-9">
    <p><?php echo $album->getFact() ; ?></p>
  </dd>

  <dt class="col-sm-3">Release Date</dt>
  
  <!-- slice time value off datetime -->
  <dd class="col-sm-9"><?php echo substr($album->getReleaseDate(),0, 10) ; ?></dd>

  <dt class="col-sm-3 text-truncate">Neat Factoid</dt>
  <dd class="col-sm-9"><?php echo $album->getFact() ; ?></dd>

</dl>
</div>
<form action="." method="post" class="sort">
        <label>Sort By: </label>
        <select name="order">
            <option value="songName">Title</option>
            <option value="writer">Song Writer</option>
            <option value="bbRank">Billboard Ranking</option>
            <option value="length">Length</option>
        </select>
        <input type="submit" value="Sort">
        <input type="hidden" value="<?php echo $albumID; ?>" name="albumID">
        <input type='hidden' name='action' value='view_album'>
</form>
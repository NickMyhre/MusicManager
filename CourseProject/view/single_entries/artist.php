<div class="single">
<h1 class="display-3"><?php echo $artist->getBirthName(); ?></h1>
<dl class="row">
    <dt class="col-sm-3">Stage Name</dt>
    <dd class="col-sm-9">
        <?php 
        if (empty($artist->getStageName())) {
            $string = 'This person is too cool to have a stage name apparently.';
        } else {
            $string = $artist->getStageName();
        }
        echo $string
         ?></dd>

    <dt class="col-sm-3">Hometown</dt>
    <dd class="col-sm-9">
        <p><?php echo $artist->getHometown(); ?></p>
    </dd>

    <dt class="col-sm-3">Birth Date</dt>
    
    <!-- slice time value off datetime -->
    <dd class="col-sm-9"><?php echo substr($artist->getBirthDate(), 0, 10); ?></dd>

    <dt class="col-sm-3 text-truncate">Death Date</dt>
    <dd class="col-sm-9">
        <?php
        if (empty($artist->getDeathDate())) {
            $string = 'Still Alive. (probably)';
        } else {
            $string = substr($artist->getDeathDate(), 0, 10);
        }
        echo $string
        ?></dd>

    <dt class="col-sm-3 text-truncate">Neat Factoid</dt>
    <dd class="col-sm-9"><?php echo $artist->getFact(); ?></dd>

</dl>
</div>
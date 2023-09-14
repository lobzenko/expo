<div class="banner" <?php if (!empty($image->media)){?>style="background-image: url(<?=$image->media->showThumb(['w'=>1920])?>);"<?php }?>>
    <div class="container">
      <h1 class="mb-4"><?=$title?></h1>
      <a class="btn btn-primary btn-lg" href="<?=$link?>"><?=$button?></a>
    </div>
</div>
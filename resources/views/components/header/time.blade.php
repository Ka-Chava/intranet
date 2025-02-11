<?php
    $now = \Carbon\Carbon::now('America/New_York');
?>

<div class="header-pill">
    <div class="header-pill__info">
       &bull; <span>Local time</span><span>{{ $now->format('h:i:s A') }}</span>
    </div>
</div>



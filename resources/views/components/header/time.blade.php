<?php
    $now = \Carbon\Carbon::now('America/New_York');
?>

<div class="header-pill flex">
    <div class="header-pill__info">
        {{ $now->format('h:i:s A') }}
    </div>
</div>



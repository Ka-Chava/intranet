<?php
    $now = \Carbon\Carbon::now('America/New_York');
?>

<div class="header-pill">
    <span class="header-pill__desktop">
        <span class="header-pill__dot">&bull;</span>
        <span>Local time:</span>
    </span>

    <span>{{ $now->format('h:i A') }}</span>
</div>



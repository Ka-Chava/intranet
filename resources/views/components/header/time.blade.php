<?php
    $now = \Carbon\Carbon::now('America/New_York');
?>

<div class="card header-pill" x-data="{ time: '<?= $now->format('h:i A') ?>' }" x-init="setInterval(() => {
    const options = { timeZone: 'America/New_York', hour: '2-digit', minute: '2-digit', hour12: true };
    time = new Intl.DateTimeFormat('en-US', options).format(new Date());
}, 1000 * 5)">
    <span class="header-pill__desktop">
        <span class="header-pill__dot">&bull;</span>
        <span>Local time:</span>
    </span>

    <span x-text="time"></span>
</div>



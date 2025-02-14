<?php
    $user = Auth::user();
?>

<div class="pl-6 user-info flex items-center justify-between" x-data="{ status: false }">
    <div class="user-info__wrapper flex items-center">
        <div class="user-info__avatar">

        </div>
        <div class="user-info__details">
            <span class="font-bold">{{ $user->name }}</span>
        </div>
    </div>
    <button aria-label="Collapse Navigation" id="CollapseNavigation" @click="status === false ? status = true : status = false; $dispatch('user-info-collapse-navigation', { status: status })">></button>
</div>

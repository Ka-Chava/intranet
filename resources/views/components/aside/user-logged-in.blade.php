<?php
    $user = Auth::user();
?>
<div class="user-logged-in flex items-center justify-between" x-data>
    <div class="user-logged-in__wrapper flex items-center">
        <div class="user-logged-in__avatar">

        </div>
        <div class="user-logged-in__details">
            <span class="font-bold">{{ $user->name }}</span>
        </div>
    </div>
    <button aria-label="Collapse Navigation" id="CollapseNavigation" @click="$dispatch('collapse-navigation', { status: true })">></button>
</div>

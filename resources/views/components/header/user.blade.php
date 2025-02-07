<?php
    use \Illuminate\Support\Facades\Auth;
    $user = Auth::user();
?>

<div class="header-pill" data-user-id="{{ $user->id }}">
    <figure class="header-pill__avatar">
        <div role="img"></div>
    </figure>
    <div class="header-pill__info">
        {{ $user->name }}
    </div>
</div>



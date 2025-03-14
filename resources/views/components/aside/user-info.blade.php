<?php
    $user = Auth::user();
?>

<div class="user-info">
    <div class="user-info__wrapper">
        <div class="user-info__avatar">
            @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="" class="user-info__avatar-image" />
            @else
                <x:feather-user />
            @endif
        </div>

        <div class="user-info__details">
            {{ $user->name }}
        </div>
    </div>
</div>

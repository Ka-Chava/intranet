<?php
    $user = Auth::user();
?>

<div class="user-info pl-6">
    <div class="user-info__wrapper">
        <div class="user-info__avatar">
            @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="" class="user-info__avatar-image" />
            @else
                <x-heroicon-o-user />
            @endif
        </div>

        <div class="user-info__details">
            <div class="user-info__name">
                {{ $user->name }}
            </div>
        </div>
    </div>
</div>

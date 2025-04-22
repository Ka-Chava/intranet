<button {{ $attributes->only('class')->merge(['class' => 'card card--secondary helpdesk-request-card']) }} {{ $attributes }}>
    @if($request->icon)
        {{ svg($request->icon, 'min-w-6 min-h-6') }}
    @endif

    <div class="heading">
        <h3 class="heading__title helpdesk-request-card__title">
            {{ $request->name }}
        </h3>

        <p class="heading__subtitle helpdesk-request-card__subtitle">
            {{ $request->description }}
        </p>
    </div>
</button>

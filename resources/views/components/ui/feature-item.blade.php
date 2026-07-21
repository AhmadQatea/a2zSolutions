@props([
    'icon',
    'iconColor' => 'gold',
    'title',
    'description',
])

<div class="a2z-feature">
    <x-ui.icon :name="$icon" :color="$iconColor" />

    <div>
        <h4 class="a2z-feature__title">{{ $title }}</h4>
        <p class="a2z-feature__description">{{ $description }}</p>
    </div>
</div>

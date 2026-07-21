@props(['variant' => 'default'])

<div class="adm-skeleton adm-skeleton--{{ $variant }}" data-adm-skeleton aria-hidden="true">
    <div class="adm-skeleton__stats">
        @for ($i = 0; $i < 4; $i++)
            <div class="adm-skeleton__stat adm-skeleton__shimmer"></div>
        @endfor
    </div>

    <div class="adm-skeleton__toolbar adm-skeleton__shimmer"></div>

    <div class="adm-skeleton__grid">
        <div class="adm-skeleton__panel adm-skeleton__shimmer"></div>
        <div class="adm-skeleton__aside">
            <div class="adm-skeleton__panel adm-skeleton__shimmer adm-skeleton__panel--short"></div>
            <div class="adm-skeleton__panel adm-skeleton__shimmer adm-skeleton__panel--medium"></div>
        </div>
    </div>

    <div class="adm-skeleton__cards">
        @for ($i = 0; $i < 3; $i++)
            <div class="adm-skeleton__card adm-skeleton__shimmer"></div>
        @endfor
    </div>
</div>

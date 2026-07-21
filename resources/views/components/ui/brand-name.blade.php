@props([
    'tag' => 'span',
])

<{{ $tag }} {{ $attributes->merge(['class' => 'a2z-brand']) }}>
    <span class="a2z-brand__letter">{{ config('site.brand.letter_a', 'A') }}</span><span class="a2z-brand__middle">{{ config('site.brand.middle', '2') }}</span><span class="a2z-brand__letter">{{ config('site.brand.letter_z', 'Z') }}</span><span class="a2z-brand__middle">{{ config('site.brand.suffix', ' Solutions') }}</span>
</{{ $tag }}>

@php($hero = config('site.contact_page.hero'))

<section class="contact-hero">
    <div class="contact-hero__mesh" aria-hidden="true"></div>
    <div class="a2z-container contact-hero__inner">
        <h1 class="contact-hero__title">{{ $hero['title'] }}</h1>
        <p class="contact-hero__description">{{ $hero['description'] }}</p>
    </div>
</section>

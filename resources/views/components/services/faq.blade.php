@php($faq = config('site.services_page.faq'))

<section class="services-faq">
    <div class="a2z-container services-faq__inner">
        <div class="services-faq__header">
            <h2 class="services-faq__title">{{ $faq['title'] }}</h2>
            <p class="services-faq__description">{{ $faq['description'] }}</p>
        </div>

        <div class="services-faq__list" data-faq-list>
            @foreach ($faq['items'] as $item)
                <x-ui.faq-item
                    :question="$item['question']"
                    :answer="$item['answer']"
                />
            @endforeach
        </div>
    </div>
</section>

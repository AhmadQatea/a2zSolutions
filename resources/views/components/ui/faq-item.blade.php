@props([
    'question',
    'answer',
])

<div class="faq-item" data-faq-item>
    <button type="button" class="faq-item__trigger" data-faq-trigger aria-expanded="false">
        <span class="faq-item__question">{{ $question }}</span>
        <x-ui.icon name="expand_more" class="faq-item__icon" />
    </button>

    <div class="faq-item__panel" data-faq-panel>
        <p class="faq-item__answer">{{ $answer }}</p>
    </div>
</div>

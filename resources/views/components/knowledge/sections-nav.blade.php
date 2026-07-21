@php($nav = config('site.knowledge_page.sections_nav'))

<nav class="knowledge-nav" aria-label="أقسام مركز المعرفة">
    <div class="a2z-container">
        <div class="knowledge-nav__inner">
            @foreach ($nav as $item)
                <a href="#{{ $item['id'] }}" class="knowledge-nav__link">
                    <x-ui.icon :name="$item['icon']" size="sm" />
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</nav>

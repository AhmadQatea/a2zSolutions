@php($blog = config('site.knowledge_page.blog'))

<section id="blog" class="knowledge-blog">
    <div class="a2z-container">
        <div class="knowledge-blog__header">
            <h2 class="knowledge-blog__title">{{ $blog['title'] }}</h2>
            <p class="knowledge-blog__description">{{ $blog['description'] }}</p>
        </div>

        <div class="knowledge-blog__grid">
            @foreach ($blog['posts'] as $post)
                <article class="knowledge-blog__card">
                    <div class="knowledge-blog__media">
                        <x-ui.lazy-img :src="$post['image']" :alt="$post['image_alt']" class="knowledge-blog__image" />
                        <span class="knowledge-blog__category">{{ $post['category'] }}</span>
                    </div>
                    <div class="knowledge-blog__body">
                        <div class="knowledge-blog__meta">
                            <span>{{ $post['date'] }}</span>
                            <span>{{ $post['read_time'] }}</span>
                        </div>
                        <h3 class="knowledge-blog__post-title">{{ $post['title'] }}</h3>
                        <p class="knowledge-blog__excerpt">{{ $post['excerpt'] }}</p>
                        <a href="/contact" class="knowledge-blog__link">
                            اقرأ المزيد
                            <x-ui.icon name="arrow_back" size="sm" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

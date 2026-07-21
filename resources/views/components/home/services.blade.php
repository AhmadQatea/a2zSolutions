@php($services = config('site.services'))

<section id="services" class="a2z-services">
    <div class="a2z-container">
        <x-ui.section-header
            :title="$services['title']"
            :description="$services['description']"
            centered
        />

        <x-ui.services-slider :items="$services['items']" />
    </div>
</section>

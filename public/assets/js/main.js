document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', function (event) {
            const targetId = this.getAttribute('href');

            if (!targetId || targetId === '#') {
                return;
            }

            const target = document.querySelector(targetId);

            if (!target) {
                return;
            }

            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        });
    });

    const header = document.querySelector('[data-site-header]');

    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('a2z-header--scrolled');
            } else {
                header.classList.remove('a2z-header--scrolled');
            }
        });

        initMobileNav(header);
    }

    initScrollProgress();

    const swiper = document.querySelector('[data-services-swiper]');

    if (swiper) {
        initServicesSwiper(swiper);
    }

    initFaqAccordion();
});

function initMobileNav(header) {
    const mobileNav = document.querySelector('[data-mobile-nav]');
    const toggle = header.querySelector('[data-mobile-nav-toggle]');

    if (! mobileNav || ! toggle) {
        return;
    }

    const closeElements = mobileNav.querySelectorAll('[data-mobile-nav-close]');

    const openNav = () => {
        mobileNav.classList.add('a2z-mobile-nav--open');
        header.classList.add('a2z-header--nav-open');
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'إغلاق القائمة');
        mobileNav.setAttribute('aria-hidden', 'false');
        document.body.classList.add('a2z-nav-open');
    };

    const closeNav = () => {
        mobileNav.classList.remove('a2z-mobile-nav--open');
        header.classList.remove('a2z-header--nav-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'فتح القائمة');
        mobileNav.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('a2z-nav-open');
    };

    toggle.addEventListener('click', () => {
        if (mobileNav.classList.contains('a2z-mobile-nav--open')) {
            closeNav();
        } else {
            openNav();
        }
    });

    closeElements.forEach((element) => {
        element.addEventListener('click', closeNav);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && mobileNav.classList.contains('a2z-mobile-nav--open')) {
            closeNav();
        }
    });

    window.addEventListener('resize', () => {
        if (window.matchMedia('(min-width: 768px)').matches) {
            closeNav();
        }
    });
}

function initScrollProgress() {
    const bar = document.querySelector('[data-scroll-progress-bar]');

    if (! bar) {
        return;
    }

    const updateProgress = () => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const progress = scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0;

        bar.style.width = `${Math.min(progress, 100)}%`;
    };

    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
}

function initFaqAccordion() {
    const lists = document.querySelectorAll('[data-faq-list]');

    lists.forEach((list) => {
        list.querySelectorAll('[data-faq-item]').forEach((item) => {
            const trigger = item.querySelector('[data-faq-trigger]');
            const panel = item.querySelector('[data-faq-panel]');

            if (! trigger || ! panel) {
                return;
            }

            trigger.addEventListener('click', () => {
                const isOpen = item.classList.contains('faq-item--open');

                list.querySelectorAll('[data-faq-item]').forEach((otherItem) => {
                    const otherTrigger = otherItem.querySelector('[data-faq-trigger]');
                    const otherPanel = otherItem.querySelector('[data-faq-panel]');

                    otherItem.classList.remove('faq-item--open');
                    otherTrigger?.setAttribute('aria-expanded', 'false');
                    if (otherPanel) {
                        otherPanel.style.maxHeight = null;
                    }
                });

                if (! isOpen) {
                    item.classList.add('faq-item--open');
                    trigger.setAttribute('aria-expanded', 'true');
                    panel.style.maxHeight = `${panel.scrollHeight}px`;
                }
            });
        });
    });
}

function initServicesSwiper(root) {
    const track = root.querySelector('[data-services-track]');
    const slides = Array.from(root.querySelectorAll('[data-services-slide]'));
    const prevButton = root.querySelector('[data-services-prev]');
    const nextButton = root.querySelector('[data-services-next]');
    const dots = Array.from(root.querySelectorAll('[data-services-dot]'));
    const totalSlides = slides.length;

    if (!track || totalSlides === 0) {
        return;
    }

    const angleStep = 360 / totalSlides;
    const getRadius = () => (window.matchMedia('(min-width: 768px)').matches ? 300 : 210);

    const getSlideDistance = (index) => {
        const diff = Math.abs(index - currentIndex);

        return Math.min(diff, totalSlides - diff);
    };

    let currentIndex = 0;
    let autoplayTimer = null;
    let touchStartX = 0;
    let touchDeltaX = 0;

    const applySlideTransforms = () => {
        const radius = getRadius();

        slides.forEach((slide, index) => {
            const isActive = index === currentIndex;
            const depth = isActive ? radius + 50 : radius;
            const angle = index * angleStep;

            slide.style.transform = `rotateY(${angle}deg) translateZ(${depth}px)`;
            slide.classList.toggle('a2z-services-swiper__slide--distant', getSlideDistance(index) > 1);
        });
    };

    const goTo = (index) => {
        currentIndex = (index + totalSlides) % totalSlides;
        track.style.transform = `translate(-50%, -50%) rotateY(${-currentIndex * angleStep}deg)`;

        slides.forEach((slide, slideIndex) => {
            slide.classList.toggle('a2z-services-swiper__slide--active', slideIndex === currentIndex);
        });

        applySlideTransforms();

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('a2z-services-swiper__dot--active', dotIndex === currentIndex);
            dot.setAttribute('aria-current', dotIndex === currentIndex ? 'true' : 'false');
        });
    };

    const next = () => goTo(currentIndex + 1);
    const prev = () => goTo(currentIndex - 1);

    const startAutoplay = () => {
        stopAutoplay();
        autoplayTimer = window.setInterval(next, 5000);
    };

    const stopAutoplay = () => {
        if (autoplayTimer) {
            window.clearInterval(autoplayTimer);
            autoplayTimer = null;
        }
    };

    prevButton?.addEventListener('click', () => {
        prev();
        startAutoplay();
    });

    nextButton?.addEventListener('click', () => {
        next();
        startAutoplay();
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const index = Number(dot.dataset.servicesDot);

            if (!Number.isNaN(index)) {
                goTo(index);
                startAutoplay();
            }
        });
    });

    root.addEventListener('pointerdown', (event) => {
        touchStartX = event.clientX;
        touchDeltaX = 0;
        stopAutoplay();
    });

    root.addEventListener('pointermove', (event) => {
        if (touchStartX === 0) {
            return;
        }

        touchDeltaX = event.clientX - touchStartX;
    });

    root.addEventListener('pointerup', () => {
        if (Math.abs(touchDeltaX) > 48) {
            if (touchDeltaX > 0) {
                prev();
            } else {
                next();
            }
        }

        touchStartX = 0;
        touchDeltaX = 0;
        startAutoplay();
    });

    root.addEventListener('mouseenter', stopAutoplay);
    root.addEventListener('mouseleave', startAutoplay);

    window.addEventListener('resize', applySlideTransforms);

    goTo(0);
    startAutoplay();
}

document.addEventListener('DOMContentLoaded', () => {
    initSidebarToggle();
    initScrollProgress();
    initPageSkeleton();
    initPasswordToggle();
    initProjectFilters();
    initSearchFilters();
    initFeaturedToggles();
    initCaseStudyFocus();
    initLegalTabs();
    initBookingCalendar();
});

const SIDEBAR_STORAGE_KEY = 'adm-sidebar-open';

function initSidebarToggle() {
    const shell = document.querySelector('[data-adm-shell]');
    const toggle = document.querySelector('[data-adm-sidebar-toggle]');
    const icon = document.querySelector('[data-adm-sidebar-toggle-icon]');

    if (!shell || !toggle) {
        return;
    }

    const setOpen = (isOpen) => {
        shell.classList.toggle('is-sidebar-closed', !isOpen);
        toggle.setAttribute('aria-expanded', String(isOpen));

        if (icon) {
            icon.textContent = isOpen ? 'menu_open' : 'menu';
        }

        try {
            localStorage.setItem(SIDEBAR_STORAGE_KEY, isOpen ? '1' : '0');
        } catch {
            // Ignore storage errors.
        }
    };

    const stored = localStorage.getItem(SIDEBAR_STORAGE_KEY);
    setOpen(stored !== '0');

    toggle.addEventListener('click', (event) => {
        event.stopPropagation();
        const isOpen = !shell.classList.contains('is-sidebar-closed');
        setOpen(!isOpen);
    });
}

function initScrollProgress() {
    const bar = document.querySelector('[data-adm-scroll-progress-bar]');
    const scrollRoot = document.querySelector('.adm-content');

    if (!bar || !scrollRoot) {
        return;
    }

    const updateProgress = () => {
        const scrollable = scrollRoot.scrollHeight - scrollRoot.clientHeight;
        const progress = scrollable > 0 ? (scrollRoot.scrollTop / scrollable) * 100 : 0;

        bar.style.width = `${Math.min(progress, 100)}%`;
    };

    scrollRoot.addEventListener('scroll', updateProgress, { passive: true });
    window.addEventListener('resize', updateProgress);
    updateProgress();
}

function initPageSkeleton() {
    const page = document.querySelector('[data-adm-page]');

    if (!page) {
        return;
    }

    const minVisibleMs = 550;
    const startedAt = Date.now();

    const reveal = () => {
        const elapsed = Date.now() - startedAt;
        const delay = Math.max(0, minVisibleMs - elapsed);

        window.setTimeout(() => {
            page.classList.add('adm-page--ready');

            window.setTimeout(() => {
                page.classList.add('adm-page--skeleton-done');
            }, 380);
        }, delay);
    };

    if (document.readyState === 'complete') {
        reveal();
    } else {
        window.addEventListener('load', reveal, { once: true });
    }

    document.querySelectorAll('.adm-sidebar__link').forEach((link) => {
        link.addEventListener('click', () => {
            page.classList.remove('adm-page--ready', 'adm-page--skeleton-done');
        });
    });
}

function initPasswordToggle() {
    document.querySelectorAll('[data-adm-password-toggle]').forEach((button) => {
        const wrap = button.closest('.adm-field__input-wrap');
        const input = wrap?.querySelector('[data-adm-password-input]');
        const icon = button.querySelector('[data-adm-password-icon]');

        if (!input || !icon) {
            return;
        }

        button.addEventListener('click', () => {
            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';
            icon.textContent = isHidden ? 'visibility_off' : 'visibility';
            button.setAttribute('aria-label', isHidden ? 'إخفاء كلمة المرور' : 'إظهار كلمة المرور');
            button.setAttribute('aria-pressed', String(isHidden));
        });
    });
}

function initProjectFilters() {
    const filterContainer = document.querySelector('[data-adm-filters]');

    if (!filterContainer) {
        return;
    }

    const buttons = filterContainer.querySelectorAll('[data-adm-filter]');
    const cards = document.querySelectorAll('[data-adm-filterable]');

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-adm-filter');

            buttons.forEach((item) => item.classList.remove('adm-filter--active'));
            button.classList.add('adm-filter--active');

            cards.forEach((card) => {
                const type = card.getAttribute('data-adm-filterable');

                if (filter === 'all' || type === filter) {
                    card.classList.remove('is-hidden');
                } else {
                    card.classList.add('is-hidden');
                }
            });
        });
    });
}

function initSearchFilters() {
    const inputs = document.querySelectorAll('[data-adm-search]');

    inputs.forEach((input) => {
        input.addEventListener('input', () => {
            const listName = input.getAttribute('data-adm-search');
            const list = document.querySelector(`[data-adm-list="${listName}"]`);

            if (!list) {
                return;
            }

            const query = input.value.trim().toLowerCase();
            const items = list.querySelectorAll('[data-adm-searchable]');

            items.forEach((item) => {
                const text = item.getAttribute('data-adm-searchable')?.toLowerCase() ?? '';

                if (text.includes(query)) {
                    item.classList.remove('is-hidden');
                } else {
                    item.classList.add('is-hidden');
                }
            });
        });
    });
}

function initFeaturedToggles() {
    document.querySelectorAll('[data-adm-featured-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const isFeatured = button.classList.toggle('is-active');
            const card = button.closest('[data-adm-project-card]');
            const badge = card?.querySelector('[data-adm-featured-badge]');

            button.setAttribute('aria-pressed', String(isFeatured));

            const label = button.querySelector('[data-adm-featured-label]');
            if (label) {
                label.textContent = isFeatured ? 'مميز' : 'تمييز';
            }

            if (badge) {
                badge.hidden = !isFeatured;
            }
        });
    });
}

function initCaseStudyFocus() {
    document.querySelectorAll('[data-adm-case-focus]').forEach((group) => {
        const options = group.querySelectorAll('[data-adm-focus-option]');
        const card = group.closest('[data-adm-case-card]');

        if (!card) {
            return;
        }

        const problemFields = card.querySelector('[data-adm-focus-problem]');
        const goalFields = card.querySelector('[data-adm-focus-goal]');

        const update = (focus) => {
            if (problemFields) {
                problemFields.hidden = focus !== 'problem';
            }

            if (goalFields) {
                goalFields.hidden = focus !== 'goal';
            }
        };

        options.forEach((option) => {
            option.addEventListener('change', () => {
                if (option.checked) {
                    update(option.value);
                }
            });
        });

        const checked = group.querySelector('[data-adm-focus-option]:checked');
        update(checked?.value ?? 'problem');
    });
}

function initLegalTabs() {
    document.querySelectorAll('[data-adm-legal-tab]').forEach((tab) => {
        tab.addEventListener('click', () => {
            const key = tab.getAttribute('data-adm-legal-tab');

            document.querySelectorAll('[data-adm-legal-tab]').forEach((item) => {
                item.classList.remove('adm-filter--active');
            });

            tab.classList.add('adm-filter--active');

            document.querySelectorAll('[data-adm-legal-panel]').forEach((panel) => {
                panel.hidden = panel.getAttribute('data-adm-legal-panel') !== key;
            });
        });
    });
}

function initBookingCalendar() {
    const root = document.querySelector('[data-adm-booking-calendar]');

    if (!root) {
        return;
    }

    const monthLabel = root.querySelector('[data-adm-booking-month]');
    const daysContainer = root.querySelector('[data-adm-booking-days]');
    const prevButton = root.querySelector('[data-adm-booking-prev]');
    const nextButton = root.querySelector('[data-adm-booking-next]');

    const arabicMonths = [
        'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
        'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر',
    ];

    let viewDate = new Date();
    viewDate.setDate(1);

    const renderCalendar = () => {
        if (!daysContainer || !monthLabel) {
            return;
        }

        const year = viewDate.getFullYear();
        const month = viewDate.getMonth();

        monthLabel.textContent = `${arabicMonths[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        daysContainer.innerHTML = '';

        const startOffset = (firstDay + 1) % 7;

        for (let index = 0; index < startOffset; index += 1) {
            const empty = document.createElement('span');
            empty.className = 'adm-booking__day adm-booking__day--muted';
            daysContainer.appendChild(empty);
        }

        const bookedDays = (root.dataset.bookedDays || '').split(',').filter(Boolean);

        for (let day = 1; day <= daysInMonth; day += 1) {
            const date = new Date(year, month, day);
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'adm-booking__day';
            button.textContent = String(day);

            const dayOfWeek = date.getDay();
            const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            if (date < today || dayOfWeek === 5 || dayOfWeek === 6) {
                button.classList.add('adm-booking__day--disabled');
                button.disabled = true;
            }

            if (bookedDays.includes(dateKey)) {
                button.classList.add('adm-booking__day--booked');
            }

            daysContainer.appendChild(button);
        }
    };

    prevButton?.addEventListener('click', () => {
        viewDate.setMonth(viewDate.getMonth() - 1);
        renderCalendar();
    });

    nextButton?.addEventListener('click', () => {
        viewDate.setMonth(viewDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
}

document.addEventListener('DOMContentLoaded', () => {
    initProjectFilters();
    initCaseStudiesPagination();
    initSolutionsFinder();
    initCostCalculator();
});

function initCaseStudiesPagination() {
    const root = document.querySelector('[data-case-studies]');

    if (!root) {
        return;
    }

    const slides = Array.from(root.querySelectorAll('[data-case-slide]'));
    const dots = Array.from(root.querySelectorAll('[data-case-dot]'));
    const prevButton = root.querySelector('[data-case-prev]');
    const nextButton = root.querySelector('[data-case-next]');
    const counter = root.querySelector('[data-case-counter]');
    const total = slides.length;
    let currentIndex = 0;

    if (total <= 1) {
        prevButton?.setAttribute('disabled', 'true');
        nextButton?.setAttribute('disabled', 'true');

        return;
    }

    const goTo = (index) => {
        currentIndex = (index + total) % total;

        slides.forEach((slide, slideIndex) => {
            const isActive = slideIndex === currentIndex;

            slide.classList.toggle('projects-case__slide--active', isActive);
            slide.hidden = !isActive;
        });

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('projects-case__dot--active', dotIndex === currentIndex);
        });

        if (counter) {
            counter.textContent = `${currentIndex + 1} / ${total}`;
        }
    };

    prevButton?.addEventListener('click', () => goTo(currentIndex - 1));
    nextButton?.addEventListener('click', () => goTo(currentIndex + 1));

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const index = Number(dot.dataset.caseDot);

            if (!Number.isNaN(index)) {
                goTo(index);
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (!root.contains(document.activeElement) && document.activeElement !== document.body) {
            return;
        }

        if (event.key === 'ArrowRight') {
            goTo(currentIndex - 1);
        } else if (event.key === 'ArrowLeft') {
            goTo(currentIndex + 1);
        }
    });

    goTo(0);
}

function initProjectFilters() {
    const filtersRoot = document.querySelector('[data-project-filters]');

    if (!filtersRoot) {
        return;
    }

    const buttons = filtersRoot.querySelectorAll('[data-project-filter]');
    const cards = document.querySelectorAll('[data-project-card]');

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const category = button.dataset.projectFilter;

            buttons.forEach((item) => {
                item.classList.remove('projects-portfolio__filter--active');
            });

            button.classList.add('projects-portfolio__filter--active');

            cards.forEach((card) => {
                const matches = category === 'all' || card.dataset.category === category;

                card.classList.toggle('portfolio-card--hidden', !matches);

                if (matches) {
                    card.style.opacity = '0';
                    requestAnimationFrame(() => {
                        card.style.opacity = '1';
                    });
                }
            });
        });
    });
}

function initSolutionsFinder() {
    const root = document.querySelector('[data-solutions-finder]');

    if (!root) {
        return;
    }

    const servicesMap = JSON.parse(root.dataset.servicesMap || '{}');
    const steps = root.querySelectorAll('[data-finder-step]');
    const progressItems = root.querySelectorAll('[data-finder-progress-item]');
    const resultPanel = root.querySelector('[data-finder-result]');
    const resultsContainer = root.querySelector('[data-finder-results]');
    const restartButton = root.querySelector('[data-finder-restart]');
    const totalSteps = steps.length;
    const scores = {};
    let currentStep = 0;

    const showStep = (index) => {
        steps.forEach((step, stepIndex) => {
            step.classList.toggle('solutions-finder__step--active', stepIndex === index);
        });

        progressItems.forEach((item, itemIndex) => {
            item.classList.remove('solutions-finder__progress-item--active', 'solutions-finder__progress-item--done');

            if (itemIndex < index) {
                item.classList.add('solutions-finder__progress-item--done');
            } else if (itemIndex === index) {
                item.classList.add('solutions-finder__progress-item--active');
            }
        });

        if (resultPanel) {
            resultPanel.hidden = index !== totalSteps;
            resultPanel.classList.toggle('solutions-finder__step--active', index === totalSteps);
        }
    };

    const renderResults = () => {
        const ranked = Object.entries(scores)
            .sort((first, second) => second[1] - first[1])
            .slice(0, 2)
            .map(([slug]) => slug);

        if (!resultsContainer) {
            return;
        }

        resultsContainer.innerHTML = '';

        ranked.forEach((slug) => {
            const service = servicesMap[slug];

            if (!service) {
                return;
            }

            const card = document.createElement('div');
            card.className = 'solutions-finder__result-card';
            card.innerHTML = `
                <span class="solutions-finder__result-icon">
                    <span class="a2z-icon">${service.icon}</span>
                </span>
                <div>
                    <h4 class="solutions-finder__result-title">${service.title}</h4>
                    <p class="solutions-finder__result-desc">${service.description}</p>
                </div>
            `;

            resultsContainer.appendChild(card);
        });
    };

    const resetFinder = () => {
        Object.keys(scores).forEach((key) => {
            delete scores[key];
        });

        currentStep = 0;

        root.querySelectorAll('[data-finder-option]').forEach((option) => {
            option.classList.remove('solutions-finder__option--selected');
        });

        showStep(0);
    };

    root.querySelectorAll('[data-finder-option]').forEach((option) => {
        option.addEventListener('click', () => {
            const stepIndex = Number(option.dataset.step);
            const optionScores = JSON.parse(option.dataset.scores || '{}');

            if (stepIndex !== currentStep) {
                return;
            }

            const stepElement = steps[stepIndex];
            stepElement.querySelectorAll('[data-finder-option]').forEach((item) => {
                item.classList.remove('solutions-finder__option--selected');
            });

            option.classList.add('solutions-finder__option--selected');

            Object.entries(optionScores).forEach(([slug, value]) => {
                scores[slug] = (scores[slug] || 0) + value;
            });

            if (currentStep < totalSteps - 1) {
                currentStep += 1;
                showStep(currentStep);
            } else {
                renderResults();
                currentStep = totalSteps;
                showStep(totalSteps);
            }
        });
    });

    restartButton?.addEventListener('click', resetFinder);

    showStep(0);
}

function initCostCalculator() {
    const root = document.querySelector('[data-cost-calculator]');

    if (!root) {
        return;
    }

    const panels = root.querySelectorAll('[data-calc-step]');
    const nodes = root.querySelectorAll('[data-calc-node]');
    const lines = root.querySelectorAll('[data-calc-line]');
    const typeButtons = root.querySelectorAll('[data-calc-type]');
    const featureInputs = root.querySelectorAll('[data-calc-feature]');
    const scaleButtons = root.querySelectorAll('[data-calc-scale]');
    const prevButtons = root.querySelectorAll('[data-calc-prev]');
    const nextButtons = root.querySelectorAll('[data-calc-next]');
    const summaryType = root.querySelector('[data-calc-summary-type]');
    const summaryFeatures = root.querySelector('[data-calc-summary-features]');
    const summaryScale = root.querySelector('[data-calc-summary-scale]');
    const totalElement = root.querySelector('[data-calc-total]');

    const state = {
        step: 1,
        basePrice: 0,
        typeTitle: '—',
        featuresPrice: 0,
        featuresCount: 0,
        scaleMultiplier: 1,
        scaleTitle: '—',
    };

    const formatPrice = (value) => `$${Math.round(value).toLocaleString()}`;

    const updateSummary = () => {
        if (summaryType) {
            summaryType.textContent = state.typeTitle;
        }

        if (summaryFeatures) {
            summaryFeatures.textContent = String(state.featuresCount);
        }

        if (summaryScale) {
            summaryScale.textContent = state.scaleTitle;
        }

        if (totalElement) {
            const total = (state.basePrice + state.featuresPrice) * state.scaleMultiplier;
            totalElement.textContent = total > 0 ? formatPrice(total) : '$0';
        }
    };

    const updateStepper = () => {
        nodes.forEach((node) => {
            const nodeStep = Number(node.dataset.calcNode);
            node.classList.remove('cost-calculator__step-node--active', 'cost-calculator__step-node--done');

            if (nodeStep === state.step) {
                node.classList.add('cost-calculator__step-node--active');
            } else if (nodeStep < state.step) {
                node.classList.add('cost-calculator__step-node--done');
                node.textContent = '✓';
            } else {
                node.textContent = String(nodeStep);
            }
        });

        lines.forEach((line) => {
            const lineStep = Number(line.dataset.calcLine);
            line.classList.toggle('cost-calculator__step-line--filled', lineStep < state.step);
        });
    };

    const goToStep = (step) => {
        state.step = step;

        panels.forEach((panel) => {
            const panelStep = Number(panel.dataset.calcStep);
            const isActive = panelStep === step;

            panel.classList.toggle('cost-calculator__panel--active', isActive);
            panel.hidden = !isActive;
        });

        updateStepper();
    };

    typeButtons.forEach((button) => {
        button.addEventListener('click', () => {
            typeButtons.forEach((item) => {
                item.classList.remove('cost-calculator__type-card--active');
            });

            button.classList.add('cost-calculator__type-card--active');

            state.basePrice = Number(button.dataset.basePrice);
            state.typeTitle = button.dataset.title;

            updateSummary();
            goToStep(2);
        });
    });

    featureInputs.forEach((input) => {
        input.addEventListener('change', () => {
            const price = Number(input.dataset.featurePrice);

            if (input.checked) {
                state.featuresPrice += price;
                state.featuresCount += 1;
            } else {
                state.featuresPrice -= price;
                state.featuresCount -= 1;
            }

            updateSummary();
        });
    });

    scaleButtons.forEach((button) => {
        button.addEventListener('click', () => {
            scaleButtons.forEach((item) => {
                item.classList.remove('cost-calculator__scale-btn--active');
            });

            button.classList.add('cost-calculator__scale-btn--active');

            state.scaleMultiplier = Number(button.dataset.scaleMultiplier);
            state.scaleTitle = button.dataset.scaleTitle;

            updateSummary();
        });
    });

    prevButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (state.step > 1) {
                goToStep(state.step - 1);
            }
        });
    });

    nextButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (state.step < 3) {
                goToStep(state.step + 1);
            }
        });
    });

    updateSummary();
    updateStepper();
}

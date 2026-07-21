document.addEventListener('DOMContentLoaded', () => {
    initContactBooking();
});

function initContactBooking() {
    const root = document.querySelector('[data-contact-booking]');

    if (!root) {
        return;
    }

    const form = root.querySelector('[data-booking-form]');
    const monthLabel = root.querySelector('[data-booking-month]');
    const daysContainer = root.querySelector('[data-booking-days]');
    const slotsPanel = root.querySelector('[data-booking-slots]');
    const slotsTitle = root.querySelector('[data-booking-slots-title]');
    const timeButtons = root.querySelectorAll('[data-booking-time]');
    const confirmLink = root.querySelector('[data-booking-confirm]');
    const prevButton = root.querySelector('[data-booking-prev]');
    const nextButton = root.querySelector('[data-booking-next]');
    const dateInput = root.querySelector('[data-booking-date-input]');
    const timeInput = root.querySelector('[data-booking-time-input]');
    const slotInput = root.querySelector('[data-booking-slot-input]');
    const submitButton = root.querySelector('[data-booking-submit]');

    const whatsappBase = root.dataset.whatsappUrl || '';
    const whatsappMessage = root.dataset.whatsappMessage || '';
    const bookedDays = (root.dataset.bookedDays || '')
        .split(',')
        .map((value) => value.trim())
        .filter(Boolean);

    const arabicMonths = [
        'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
        'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر',
    ];

    let viewDate = new Date();
    viewDate.setDate(1);

    let selectedDate = null;
    let selectedTime = null;

    const formatIsoDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    };

    const formatDateLabel = (date) => {
        return `${date.getDate()} ${arabicMonths[date.getMonth()]} ${date.getFullYear()}`;
    };

    const updateHiddenFields = () => {
        if (dateInput) {
            dateInput.value = selectedDate ? formatIsoDate(selectedDate) : '';
        }

        if (timeInput) {
            timeInput.value = selectedTime?.label || '';
        }

        if (slotInput) {
            slotInput.value = selectedTime?.slotId || '';
        }
    };

    const updateConfirmLink = () => {
        if (!confirmLink || !selectedDate || !selectedTime) {
            return;
        }

        const text = `${whatsappMessage} — ${formatDateLabel(selectedDate)} الساعة ${selectedTime.label}`;
        confirmLink.href = `${whatsappBase}?text=${encodeURIComponent(text)}`;
    };

    const isBookedDay = (date) => {
        return bookedDays.includes(formatIsoDate(date));
    };

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
            empty.className = 'contact-booking__day contact-booking__day--muted';
            daysContainer.appendChild(empty);
        }

        for (let day = 1; day <= daysInMonth; day += 1) {
            const date = new Date(year, month, day);
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'contact-booking__day';
            button.textContent = String(day);

            const dayOfWeek = date.getDay();
            const isUnavailable = date < today || dayOfWeek === 5 || dayOfWeek === 6 || isBookedDay(date);

            if (isUnavailable) {
                button.classList.add('contact-booking__day--muted');

                if (isBookedDay(date)) {
                    button.classList.add('contact-booking__day--booked');
                    button.title = 'محجوز';
                }
            } else {
                button.classList.add('contact-booking__day--available');

                if (
                    selectedDate
                    && selectedDate.getFullYear() === year
                    && selectedDate.getMonth() === month
                    && selectedDate.getDate() === day
                ) {
                    button.classList.add('contact-booking__day--selected');
                }

                button.addEventListener('click', () => {
                    selectedDate = date;
                    selectedTime = null;

                    timeButtons.forEach((timeButton) => {
                        timeButton.classList.remove('contact-booking__time--selected');
                    });

                    if (slotsPanel) {
                        slotsPanel.hidden = false;
                    }

                    if (slotsTitle) {
                        slotsTitle.textContent = `الأوقات المتاحة ليوم ${formatDateLabel(date)}:`;
                    }

                    updateHiddenFields();
                    renderCalendar();
                    updateConfirmLink();
                });
            }

            daysContainer.appendChild(button);
        }
    };

    timeButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (!selectedDate) {
                return;
            }

            timeButtons.forEach((item) => {
                item.classList.remove('contact-booking__time--selected');
            });

            button.classList.add('contact-booking__time--selected');
            selectedTime = {
                label: button.dataset.bookingTimeLabel || button.textContent.trim(),
                slotId: button.dataset.bookingSlotId || '',
            };

            updateHiddenFields();
            updateConfirmLink();
        });
    });

    prevButton?.addEventListener('click', () => {
        viewDate.setMonth(viewDate.getMonth() - 1);
        renderCalendar();
    });

    nextButton?.addEventListener('click', () => {
        viewDate.setMonth(viewDate.getMonth() + 1);
        renderCalendar();
    });

    form?.addEventListener('submit', (event) => {
        if (!selectedDate || !selectedTime) {
            event.preventDefault();
            window.alert('يرجى اختيار التاريخ والوقت قبل تأكيد الحجز.');
            return;
        }

        updateHiddenFields();
    });

    if (dateInput?.value) {
        const parts = dateInput.value.split('-').map(Number);
        if (parts.length === 3) {
            selectedDate = new Date(parts[0], parts[1] - 1, parts[2]);
        }
    }

    if (timeInput?.value) {
        selectedTime = {
            label: timeInput.value,
            slotId: slotInput?.value || '',
        };

        timeButtons.forEach((button) => {
            if ((button.dataset.bookingTimeLabel || button.textContent.trim()) === timeInput.value) {
                button.classList.add('contact-booking__time--selected');
            }
        });

        if (slotsPanel && selectedDate) {
            slotsPanel.hidden = false;
        }
    }

    if (submitButton) {
        submitButton.disabled = false;
    }

    renderCalendar();
    updateHiddenFields();
    updateConfirmLink();
}

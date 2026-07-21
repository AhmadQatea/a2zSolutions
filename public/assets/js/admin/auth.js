document.addEventListener('DOMContentLoaded', () => {
    initPasswordToggle();
});

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

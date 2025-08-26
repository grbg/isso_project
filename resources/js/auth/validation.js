document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');
    const registerUrl = "/register";
    const loginUrl = "/login";

    const verificationNotice = document.getElementById('verification_notice');
    const registerContainer = document.getElementById('register_form_container');

    function addFocusListeners(form) {
        if (!form) return;
        form.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('focus', () => clearErrors(form));
        });
    }

    function clearErrors(form) {
        form.querySelectorAll('.error-message').forEach(el => el.innerText = '');
    }

    async function handleSubmit(form, url) {
        clearErrors(form);
        const formData = new FormData(form);

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const input = form.querySelector(`[name="${field}"]`);
                        const errorDiv = input?.closest('.__input')?.querySelector('.error-message');
                        if (errorDiv) {
                            errorDiv.innerText = messages[0];
                        }
                    });
                }
                return;
            }

            // Успешная регистрация или вход
            if (data.status === 'verification_required') {
                if (registerContainer) registerContainer.classList.add('hidden');
                if (verificationNotice) verificationNotice.classList.remove('hidden');
            } else {
                window.location.href = data.redirect || '/auth-toggle';
            }

        } catch (error) {
            console.error('Ошибка при отправке формы:', error);
        }
    }

    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSubmit(registerForm, registerUrl);
        });
        addFocusListeners(registerForm);
    }

    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSubmit(loginForm, loginUrl);
        });
        addFocusListeners(loginForm);
    }
});

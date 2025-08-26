document.addEventListener('DOMContentLoaded', () => {
  // ... остальной код валидации

  const toggleBtn = document.getElementById('toggleBtn');
  const registerForm = document.getElementById('register_form_container');
  const loginForm = document.getElementById('login_form_container');

  if (toggleBtn && registerForm && loginForm) {
    toggleBtn.addEventListener('click', () => {
      const isRegisterHidden = registerForm.classList.contains('hidden');

      if (isRegisterHidden) {
        registerForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
        toggleBtn.textContent = 'Перейти к авторизации';
      } else {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        toggleBtn.textContent = 'Перейти к регистрации';
      }
    });
  }
});

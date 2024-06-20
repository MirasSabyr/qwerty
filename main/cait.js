$(".theme-switch").on("click", () => {
    $("body").toggleClass("light-theme");
  });

  window.addEventListener("load", (event) => {
    // Проверяем значение cookie
    const authCookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith('auth='));
    if (authCookie) {
        const authValue = authCookie.split('=')[1];
        if (authValue === 'true') {
            console.log('Пользователь авторизован.');
            // Получаем элемент кнопки
            const signUpButton = document.getElementById('signUp');
            signUpButton.style.display = 'none';
            const logInButton = document.getElementById('logIn');
            logInButton.style.display = 'none';
            const exitButton = document.getElementById('exit');
            exitButton.style.display = 'block';
            const accountButton = document.getElementById('account');
            accountButtonButton.style.display = 'block';
            accountButton.textContent="тут должен быть логин";
            
            // При успешной авторизации меняем цвет фона
        } else {
            console.log('Пользователь НЕ авторизован.');
        }
    } else {
        console.log('нету печенек.');
    }
});
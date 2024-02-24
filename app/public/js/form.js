(() => {

    const togglePasswordButtonIcon = document.getElementById('toggle-password-button_icon');
    const inputTogglePassword = document.querySelector('#toggle-password-button_icon + input');
    let showPassword = 0;
    const pathIcons = [
        '/media/images/form/eye-password-show.svg',
        '/media/images/form/eye-password-hide.svg'
    ];

    if(togglePasswordButtonIcon && inputTogglePassword) {

        togglePasswordButtonIcon.addEventListener('click', () => {

            if(showPassword === 1) {
                showPassword = 0;
                inputTogglePassword.setAttribute('type', 'password');
            } else {
                showPassword = 1;
                inputTogglePassword.setAttribute('type', 'text');
            }

            togglePasswordButtonIcon.children[0].setAttribute('src', pathIcons[showPassword]);

        });

    }

})();

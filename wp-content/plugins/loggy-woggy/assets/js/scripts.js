/**
 * JS for clever girl plugin
 */

window.onload = function() {
    const registerChoices = document.getElementById('register-choices');
    const revealRegister = document.getElementById('reveal-register');
    const registerInputs = document.getElementById('register-inputs');
    const revealLogin = document.getElementById('reveal-login');
    const loginInputs = document.getElementById('login-inputs');
    console.log(revealLogin);
    console.log(revealLogin);

    if(revealRegister != null || revealRegister != 'undefined') {
        revealRegister.addEventListener('click', () => {
            if (registerInputs.style.display === 'none') {
                registerInputs.style.display = 'block';
                registerChoices.style.display = 'none';
            } else {
                registerInputs.style.display = 'none';
                registerChoices.style.display = 'flex';
            }
        });
    }

    if(revealLogin != null || revealLogin != 'undefined') {
        revealLogin.addEventListener('click', () => {
            if (loginInputs.style.display === 'none') {
                loginInputs.style.display = 'block';
                registerChoices.style.display = 'none';
            } else {
                loginInputs.style.display = 'none';
                registerChoices.style.display = 'flex';
            }
        });
    }
}
/**
 * Profile logic
 */

function revealEditingOptions() {

    const editProfile = document.getElementById('edit-profile');
    const editProfileOptions = document.getElementsByClassName('edit-profile-option');

    // Only execute if element exists
    if(editProfile) {
        editProfile.addEventListener('click', (e) => { 
            e.preventDefault();
            if(editProfileOptions) {
                Array.from(editProfileOptions).forEach(elm => {
                    if(elm.style.display === 'none') {
                        elm.style.display = "block";
                    } else {
                        elm.style.display = "none";
                    }
                });
            }
        });
    }
}
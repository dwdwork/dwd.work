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

function onLoad() {

    function updateFavTeamChoices() {
        const dropdown = document.getElementById('fav_team');
        for (const label in teams) {
            if(label) {
                const option = document.createElement('option');
                option.value = teams[label];
                option.text = label;
                dropdown.appendChild(option);
            }
        }
    }

    setTimeout(updateFavTeamChoices, 250);
}
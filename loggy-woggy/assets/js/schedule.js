/**
 * JS for Better Bets Gamblin' Game's simulation
 */

function revealTeamContents(e) {
    e.preventDefault;

    let nextSibling = e.nextElementSibling;
    let icon = e.querySelector('i');
    if(nextSibling) {
        if(!nextSibling.classList.contains('visible')) {
            icon.classList.remove('fa-caret-right');
            icon.classList.add('fa-caret-down');
            nextSibling.classList.add('visible');
        } else {
            icon.classList.add('fa-caret-right');
            icon.classList.remove('fa-caret-down');
            nextSibling.classList.remove('visible');
        }
    }
}

function getSchedule() {
    // Get div that will display results
    const scheduleDisplay = document.getElementById('display-schedule');
    const scheduleFile = './assets/sheets/NFLSchedule.csv';
    const data = {};

    if(!scheduleDisplay.classList.contains('visible')) {
        fetch(scheduleFile)
            .then(response => response.text())
            .then(csvString => {
                const rows = csvString.split('\n');
                let displayContent = '';
                let weeks = [];
                
                for (let i = 1; i < rows.length; i++) {
                    const columns = rows[i].split(',');
                    const label = columns[0];
                    const values = columns.slice(1);
                    let weeksText = '';

                    data[label] = values;

                    for (let j = 0; j < values.length; j++) {
                        weeks.push(values[j]);
                        let weekTitle = j + 1;
                        weeksText += '<p>Week ' + weekTitle + ': ' + values[j] + '</p>';
                    }

                    displayContent += `
                        <div class="team team-${label}">
                            <button id="${label}-button" class="team-${label}-button" onclick="revealTeamContents(this)"><i class="fa-solid fa-caret-right"></i><h3>${label}</h3></button>
                            <div class="weeks">
                                ${weeksText}
                            </div>
                        </div>`;
                }
                scheduleDisplay.innerHTML = displayContent;
                scheduleDisplay.classList.add('visible');
                
            })
        .catch(error => {
            console.error('Error loading CSV file:', error);
        });
    } else {
        scheduleDisplay.innerHTML = '';
        scheduleDisplay.classList.remove('visible');
    }
}
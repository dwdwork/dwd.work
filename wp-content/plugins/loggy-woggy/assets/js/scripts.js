/**
 * JS for clever girl plugin
 */
 
function basicAPIFetchForPlayers() {
    const options = {
        method: 'GET',
        url: 'https://api-american-football.p.rapidapi.com/players/statistics',
        params: {
          season: '2022',
          id: '1'
        },
        headers: {
          'X-RapidAPI-Key': 'da99e3fdc2msh758b1c38a83fdafp139db3jsn6ec58dd6378c',
          'X-RapidAPI-Host': 'api-american-football.p.rapidapi.com'
        }
      };
      
      // Function to convert params object to URL-encoded string
    const encodeParams = (params) => {
        return Object.entries(params)
        .map(([key, value]) => encodeURIComponent(key) + '=' + encodeURIComponent(value))
        .join('&');
    };
      
      try {
        const queryParams = encodeParams(options.params);
        const urlWithParams = `${options.url}?${queryParams}`;
        
        fetch(urlWithParams, {
            method: options.method,
            headers: options.headers
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.response[0].player.name);
            console.log(data.response[0].teams[0].groups[0].statistics);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } catch (error) {
        console.error('Error:', error);
    }
}
// basicAPIFetchForPlayers();

function calculateNFLGame() {
    console.log('====================================');
    console.log('\n');
    console.log('         +++ NFL SIMULATOR +++        ');
    console.log('\n');
    console.log('====================================');
    const resultsDisplay = document.getElementById('game-results');

    // Team names mapped into retrievalable object
    let teams = {
        'Arizona Cardinals': 'ARZC',
        'Atlanta Falcons': 'ATLF',
        'Baltimore Ravens': 'BLTR',
        'Buffalo Bills': 'BFBL',
        'Carolina Panthers': 'CARP',
        'Chicago Bears': 'CHBR',
        'Cincinnati Bengals': 'CINB',
        'Cleveland Browns': 'CLVB',
        'Dallas Cowboys': 'DALC',
        'Denver Broncos': 'DNVB',
        'Detroit Lions': 'DTLN',
        'Green Bay Packers': 'GBPK',
        'Houston Texans': 'HOUT',
        'Indiannapolis Colts': 'INDC',
        'Jaksonville Jaguars': 'JXVJ',
        'Kansas City Chiefs': 'KSCC',
        'Los Angeles Chargers': 'LACH',
        'Los Angeles Rams': 'LARM',
        'Las Vegas Raiders': 'LVRD',
        'Miami Dolphins': 'MIAD',
        'Minnesota Vikings': 'MNVK',
        'New England Patriots': 'NEPT',
        'New Orleans Saints': 'NOST',
        'New York Giants': 'NYGN',
        'New York Jets': 'NYJT',
        'Philadelphia Eagles': 'PHEA',
        'Pittsburgh Steelers': 'PTST',
        'San Francisco 49ers': 'SF49',
        'Seattle Seahawks': 'SEAS',
        'Tampa Bay Buccaneers': 'TBBC',
        'Tennessee Titans': 'TNTN',
        'Washington Commanders': 'WSCM'
    }

    // Turnover differential mapped into retrievalable object
    let turnoverMap = {
        ARZC:   -0.3,
        ATLF:   -0.2,
        BLTR:   0.2,
        BFBL:   -0.1,
        CARP:   -0.2,
        CHBR:   -0.1,
        CINB:   0.4,
        CLVB:   -0.1,
        DALC:   0.5,
        DNVB:   -0.1,
        DTLN:   0.4,
        GBPK:   0.1,
        HOUT:   -0.1,
        INDC:   -0.8,
        JXVJ:   -0.1,
        KSCC:   0.1,
        LACH:   0.6,
        LARM:   -0.1,
        LVRD:   -0.5,
        MIAD:   -0.3,
        MNVK:   0.1,
        NEPT:   0.4,
        NOST:   -0.6,
        NYGN:   0.1,
        NYJT:   -0.4,
        PHEA:   0.6,
        PTST:   0.2,
        SF49:   0.7,
        SEAS:   0.0,
        TBBC:   -0.2,
        TNTN:   -0.2,
        WSCM:   -0.3
    }

    function getTeamAbbr(teamName) {

        // Check if the parameter is found in the teams obj
        if (teams.hasOwnProperty(teamName)) {
            return teams[teamName];
        } else {
            return 'No team found';
        }
    }

    function getTeamTurnoverMargin(teamName) {

        // Get the mapped abbreviation
        let team = getTeamAbbr(teamName);

        // Check if the parameter is found in the turnoverMap obj
        if (turnoverMap.hasOwnProperty(team)) {
            let margin = turnoverMap[team];
            return margin;
        } else {
            return 'No team found';
        }
    }

    // Helper function to generate yards for different scenarios
    function generateYards(mean, deviation) {

        // Generate two random values between 0 and 1
        const r1 = Math.random();
        const r2 = Math.random();
      
        // Use the Box-Muller transform to convert the two random values into a single value
        const y = Math.sqrt(-2 * Math.log(r1)) * Math.cos(2 * Math.PI * r2);

        // Scale and shift the value (adjusted per type of play)
        const rYards = mean + deviation * y;
        const yards = rYards <= 0 ? rYards * -1 : rYards;

        // Round the value to the nearest whole number
        return Math.round(yards);
    }

    function callRunPlay() {
        let averageYPC = 3;
        let averageDeviation = 4;
        var yards = 0;
        var message = '';

        // Run plays are completed 55% of the time on average
        if (Math.random() * 100 <= 55) {
            yards = generateYards(averageYPC, averageDeviation);
            message = 'Ran ' + yards + ' yards';
        } else {
            message = 'No Gain';
        }

        return {
            yards,
            message
        };
    } 

    function callPassPlay() {

        // Declare variables to return
        let averageYPR = 5;
        let averageDeviation = 6;
        var yards = 0;
        var message = '';

        // Pass plays are completed 65% of the time on average
        if (Math.random() * 100 <= 65) {
            yards = generateYards(averageYPR, averageDeviation);
            message = 'Passed ' + yards + ' yards';
        } else {
            message = 'Pass Incomplete';
        }

        return {
            yards,
            message
        };
    } 

    function kickPunt(yardsToGoal) {

        // Declare variables to return
        let averageDeviation = 10;
        var yards = yardsToGoal > 80 ? generateYards(65, averageDeviation) : generateYards(45, averageDeviation);
        var message = '';

        if(yardsToGoal > 80) {
            yards = generateYards(65, averageDeviation);
        }
        if(yards >= yardsToGoal) {
            yardsToGoal = 80;
            message = 'Touchback. Opponent starts at their own 20';
        } else {
            yardsToGoal = 100 - (yardsToGoal - yards);
            message = 'Punted for ' + yards + ' yards. Opponent\'s start with ' + yardsToGoal + ' yards to their goal.';
        }

        return {
            yards,
            message,
            yardsToGoal
        }
    }

    function kickFieldGoal(yardsToGoal) {

        // Declare variables to return
        let attemptYards = yardsToGoal + 10;
        var message = attemptYards + ' yard attempt.';
        var success = false;

        // Success % affected by kick distance
        if(yardsToGoal < 9) {
            success = Math.random() * 100 < 99 ? true : false;
        } else if(yardsToGoal >= 9 && yardsToGoal < 19) {
            success = Math.random() * 100 < 97 ? true : false;
        } else if(yardsToGoal >= 19 && yardsToGoal < 29) {
            success = Math.random() * 100 < 90 ? true : false;
        } else if(yardsToGoal >= 29 && yardsToGoal < 39) {
            success = Math.random() * 100 < 80 ? true : false;
        } else if(yardsToGoal >= 39 && yardsToGoal < 49) {
            success = Math.random() * 100 < 65 ? true : false;
        } else {
            success = Math.random() * 100 < 45 ? true : false;
        }

        // Update returns
        if(success === true) {
            message += ' It\'s good!';
            yardsToGoal = 80;
        } else {
            yardsToGoal = 100 - yardsToGoal;
            message += ' Missed! Turnover on downs';
        }

        return {
            success,
            message,
            yardsToGoal
        };
    }

    function decidePlay(currentDown, yardsToFirst, yardsToGoal) {

        // Declare variables to return
        currentDown++;
        var downType = '';
        var yards = 0;
        var playType = '';
        var play = null;

        // Update play call according to current down
        if(currentDown === 4) {
            downType = '4th Down';
            if(yardsToGoal < 55) {
                play = kickFieldGoal(yardsToGoal);
                playType = 'Field Goal';
            } else {
                play = kickPunt(yardsToGoal);
                playType = 'Punt';
                yardsToGoal = play.yardsToGoal;
            }
        } else if(currentDown === 3) {
            downType = '3rd Down';
            if(yardsToFirst < 2) {
                if(Math.random() * 100 < 80) {
                    play = callRunPlay();
                    playType = 'Run';
                } else {
                    play = callPassPlay();
                    playType = 'Pass';
                }
            } else {
                if(Math.random() * 100 < 40) {
                    play = callRunPlay();
                    playType = 'Run';
                } else {
                    playType = 'Pass';
                    play = callPassPlay();
                }
            }
        } else {
            if(currentDown === 2) {
                downType = '2nd Down';
            } else if(currentDown === 1) {
                downType = '1st Down';
            }
            if(Math.random() * 100 < 45) {
                play = callRunPlay();
                playType = 'Run';
            } else {
                play = callPassPlay();
                playType = 'Pass';
            }
        }

        // Update returns
        if(playType === 'Punt') {
            yards = play.yards;
        } else {
            yards = playType != 'Field Goal' ? play.yards : 0;
        }

        return {
            downType,
            yards,
            playType,
            play
        };
    }

    function simulatePossession(yardsToGoal) {
        
        // Declare variables to return
        var down = 0;
        var message = '';
        var totalPlays = 0;
        var yardsGained = 0;
        var yardsToGoalStartingPossession = yardsToGoal;
        
        // Declare variables for overall possessoion
        var possession = {
            punt: false,
            td: false,
            fg: false,
            playsCalled: [],
        }

        // Declare set of downs outside of while loop
        var setOfDowns = {
            playsCalled: [],
            yardsToFirst: 10,
            yardsGained: 0,
        }

        // Run a repeatable function to simulate 4 downs 
        while (down < 4 && possession.td != true && possession.fg != true && possession.punt != true) {

            // While looping, push plays to setOfDowns.playsCalled 
            let currentPlay = decidePlay(down, setOfDowns.yardsToFirst, yardsToGoal); 
            setOfDowns.playsCalled.push(currentPlay);
            possession.playsCalled.push(currentPlay);

            // Update yards gained if play is run or pass
            if(currentPlay.playType === 'Run' || currentPlay.playType === 'Pass') {
                
                // Update for setOfDowns
                setOfDowns.yardsGained += currentPlay.play.yards;
                setOfDowns.yardsToFirst = 10 - setOfDowns.yardsGained;

                // Update for possession
                totalPlays++;
                yardsGained += currentPlay.play.yards;
                yardsToGoal = yardsToGoal - currentPlay.play.yards;
            }

            // Check for first down
            if(setOfDowns.yardsToFirst <= 0) {
                down = 0;
                setOfDowns.yardsGained = 0;
                setOfDowns.yardsToFirst = 10;
            } else {                
                down++;
            }

            // Check for change of possession
            possession.punt = currentPlay.playType === 'Punt' ? true : false;
            possession.fg = currentPlay.playType === 'Field Goal' && currentPlay.play.success === true ? true : false;
            possession.td = possession.punt != true && possession.fg != true && yardsToGoal < 0 ? true : false;
        }

        // Set variable to get results of last play
        let lastPlay = possession.playsCalled[possession.playsCalled.length - 1];

        // Update returns
        if(possession.td == false && possession.fg === false && possession.punt === false) {
            message = 'Turnover on Downs';
            yardsToGoal = 100 - lastPlay.play.yardsToGoal;
        } else {
            if(possession.td == true) {
                message = 'Touchdown!';
                yardsToGoal = 80;
            } 
            if(possession.fg === true) {
                message = 'Field Goal!';
                yardsToGoal = 80;
            }
            if(possession.punt === true) {
                message = 'Punt';
                yardsToGoal = lastPlay.play.yardsToGoal;
            }
        }

        return {
            yardsToGoalStartingPossession,
            message,
            yardsGained,
            yardsToGoal,
            possession,
        };        
    } 

    function simulateGame(possessions) {

        // Set yardsToGoal variable used for each team's possession
        let yardsToGoal = 0;

        // Set variables to hold stats for each team
        var allPossessions = [];
        var teamAPossessions = [];
        var teamBPossessions = [];
        var teamAStats = {
            tds: 0,
            fgs: 0,
            score: 0,
            totalPlays: 0,
            totalYards: 0,
            totalRunningYards: 0,
            totalPassingYards: 0,
            averageYPC: 0,
            averageYPCmp: 0,
            averageYPP: 0,
            possessions: teamAPossessions
        };
        var teamBStats = {
            tds: 0,
            fgs: 0,
            score: 0,
            totalPlays: 0,
            totalYards: 0,
            totalRunningYards: 0,
            totalPassingYards: 0,
            averageYPC: 0,
            averageYPCmp: 0,
            averageYPP: 0,
            possessions: teamBPossessions
        };
        var game = {
            winner: '',
            teamAStats: teamAStats,
            teamBStats: teamBStats
        }

        // Run the simulations and add possessions to separate array
        for(let i = 0; i < possessions; i++) {
            
            // Set yardsToGoal as 80 for kickoffs
            if(i === 0 || i === 13) {
                yardsToGoal = 80;
            } else {
                yardsToGoal = allPossessions[i - 1].yardsToGoal;
            }

            allPossessions.push(simulatePossession(yardsToGoal));
        }

        // Add stats to each team
        for(let i = 0; i < allPossessions.length; i++) {
            // console.log(allPossessions[i].possession.playsCalled.length);
            if(i % 2 === 0) {
                teamAPossessions.push(allPossessions[i]);
                teamAStats.totalYards += allPossessions[i].yardsGained;
                teamAStats.totalPlays += allPossessions[i].possession.playsCalled.length;

                if(allPossessions[i].message === 'Touchdown!') {
                    teamAStats.tds++;
                } else if(allPossessions[i].message === 'Field Goal!') {
                    teamAStats.fgs++;
                }   
            } else {
                teamBPossessions.push(allPossessions[i]);
                teamBStats.totalYards += allPossessions[i].yardsGained;
                teamBStats.totalPlays += allPossessions[i].possession.playsCalled.length;

                if(allPossessions[i].message === 'Touchdown!') {
                    teamBStats.tds++;
                } else if(allPossessions[i].message === 'Field Goal!') {
                    teamBStats.fgs++;
                }
            }
        }

        // Update scores
        teamAStats.score = (teamAStats.tds * 7) + (teamAStats.fgs * 3);
        teamAStats.averageYPP = Math.round((teamAStats.totalYards / teamAStats.totalPlays) * 10) / 10;
        teamBStats.score = (teamBStats.tds * 7) + (teamBStats.fgs * 3);
        teamBStats.averageYPP = Math.round((teamBStats.totalYards / teamBStats.totalPlays) * 10) / 10;

        console.log('\n-- Team A --' + 
            '\nTotal Yards: ' + teamAStats.totalYards +
            '\nAverage Yards per Play: ' + teamAStats.averageYPP +
            '\nTouchdowns: ' + teamAStats.tds + 
            '\nField Goals: ' + teamAStats.fgs + 
            '\nFinal Score: ' + teamAStats.score);

        console.log('\n-- Team B --' + 
            '\nTotal Yards: ' + teamBStats.totalYards +
            '\nAverage Yards per Play: ' + teamBStats.averageYPP +
            '\nTouchdowns: ' + teamBStats.tds + 
            '\nField Goals: ' + teamBStats.fgs + 
            '\nFinal Score: ' + teamBStats.score);

        if(teamAStats.score === teamBStats.score) {
            game.winner = 'Tie';
        } else {
            if(teamAStats.score > teamBStats.score) {
                game.winner = 'Team A Wins!';
            } else {
                game.winner = 'Team B Wins!';
            }
        }

        console.log(game);

        console.log('\n');
        console.log('         +++ ' + game.winner + ' +++       ');
        console.log('\n');

        // Set up JSON data for game
        const gameJSON = JSON.stringify(game);
        const teamAJSON = JSON.stringify(teamAStats);
        const teamBJSON = JSON.stringify(teamBStats);

        // Parse through the data
        const parsedGAME = JSON.parse(gameJSON);
        const parsedTEAMA = JSON.parse(teamAJSON);
        const parsedTEAMB = JSON.parse(teamBJSON);

        let displayContent = `
            <div class="results row">
                <div class="col col-12 winner">
                    <h2>${game.winner}</h2>
                </div>
                <div class="col col-12 col-md-6 team-a">
                    <h3>Team A Stats</h3>
                    <p>Total Yards: ${teamAStats.totalYards}</p>
                    <p>Average YPP: ${teamAStats.averageYPP}</p>
                    <p>TDs: ${teamAStats.tds}</p>
                    <p>FGs: ${teamAStats.fgs}</p>
                    <p><strong>Score: ${teamAStats.score}</strong></p>
                </div>
                <div class="col col-12 col-md-6 team-b">
                    <h3>Team B Stats</h3>
                    <p>Total Yards: ${teamBStats.totalYards}</p>
                    <p>Average YPP: ${teamBStats.averageYPP}</p>
                    <p>TDs: ${teamBStats.tds}</p>
                    <p>FGs: ${teamBStats.fgs}</p>
                    <p><strong>Score: ${teamBStats.score}</strong></p>
                </div>
                <div class="col col-12 additional-info">
                    <h4>Open the browser console to view more detailed stats!</h4>
                </div>
            </div>`;
        resultsDisplay.innerHTML = displayContent;

        return game;
    }
    simulateGame(24);
    
    
} 

window.onload = function() {
    const registerChoices = document.getElementById('register-choices');
    const revealRegister = document.getElementById('reveal-register');
    const registerInputs = document.getElementById('register-inputs');
    const revealLogin = document.getElementById('reveal-login');
    const loginInputs = document.getElementById('login-inputs');
    const editProfile = document.getElementById('edit-profile');
    const editProfileOptions = document.getElementsByClassName('edit-profile-option');
    const runNFLGame = document.getElementById('run-nfl-game');

    if(revealRegister) {
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

    if(revealLogin) {
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

    if(editProfile) {
        editProfile.addEventListener('click', () => { 
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

    if(runNFLGame) {
        runNFLGame.addEventListener('click', (e) => { 
            e.preventDefault();
            document.getElementById('game-results').classList.add('visible');
            calculateNFLGame();
        });
    }
}

/**
 * JS for clever girl plugin
 */

function calculateNFLGame() {
    console.log('==== NFL GAME ====');
    
    const teams = 2;
    var possessions = 12;
    var fieldLength = 100;
    var runPlay = false;
    var passPlay = false;
    var totalYards = 0;
    var totalYardsPerPossession = 0;
    var totalYardsPerSetOfDowns = 0;
    var totalTDs = 0;
    var totalFGs = 0;
    var totalPasses = 0;
    var totalRuns = 0;
    var teamAStats = {
        runs: '',
        runYards: '',
        passes: '',
        passYards: '',
        touchDowns: '',
        fieldGoals: '',
        punts: ''
    };
    var teamBStats = {
        runs: '',
        runYards: '',
        passes: '',
        passYards: '',
        touchDowns: '',
        fieldGoals: '',
        punts: ''
    };
    var gameResults = {
        teamA: teamAStats,
        teamB: teamBStats
    };

    function generateYards(mean) {
        // Generate two random values between 0 and 1
        const r1 = Math.random();
        const r2 = Math.random();
      
        // Use the Box-Muller transform to convert the two random values into a single value
        const y = Math.sqrt(-2 * Math.log(r1)) * Math.cos(2 * Math.PI * r2);

        // Scale and shift the value to the desired range
        const rYards = mean + 4 * y;
        const yards = rYards <= 0 ? rYards * -1 : rYards;

        // Round the value to the nearest whole number
        return Math.round(yards);
    }

    function callRunPlay() {
        var averageYPC = 4;
        var successTest = Math.random();

        // Check if the random number falls within the range
        if (successTest <= 0.55) {
            var yardsGained = generateYards(averageYPC);
            console.log('Ran ' + generateYards(averageYPC) + ' yards \n');
            return yardsGained;
        } else {
            console.log('No Gain \n');
            return false;
        }
    } 
    // callRunPlay();

    function callPassPlay() {
        var averageYPR = 8;
        var successTest = Math.random();

        // Check if the random number falls within the range
        if (successTest <= 0.65) {
            var yardsGained = generateYards(averageYPR);
            console.log('Passed ' + generateYards(averageYPR) + ' yards \n');
            return yardsGained;
        } else {
            console.log('Pass Incomplete \n');
            return false;
        }
    } 
    // callPassPlay();

    function simulateSetOfDowns() {
        var sum = 0;
        var attempts = 0;
        var yardsRemaining = 0;
      
        while (attempts < 4) {
            // Generate a random number between 0 and 10
            const randomNumber = Math.random() * 5;
        
            // Add the random number to the sum
            sum += randomNumber;
        
            // Check if the sum is greater than 10
            if (sum > 10) {
                console.log(`First Down! Total yards gained: ${sum.toFixed(2)}`);
            return; // End the function for a 1st down
            } else {
                console.log(`Yards gained on this play: ${randomNumber.toFixed(2)}`);
            }
      
          attempts++;
        }
      
        console.log(`No touchdown this drive. Total yards gained: ${sum.toFixed(2)}`);
    } 
    // simulateSetOfDowns();

    function run(totalYards, totalRuns, totalYardsPerSetOfDowns, totalTDs, score) {
        let results = {
            yardsGained,
            firstDown
        };
        if(Math.floor(Math.random() * 100) + 1 <= 60) {
            // Generate a random number for yards gained in run play
            console.log('Successful Run!');
            let yardsGainedOnPlay = Math.floor(Math.random() * 4) + 1;
            yardsGainedOnPlay += yardsGainedOnPlay;
            totalYardsPerSetOfDowns += yardsGainedOnPlay;
            totalYards += yardsGainedOnPlay;
            totalRuns++;
            runResults.push(yardsGainedOnPlay, totalRuns, totalYardsPerSetOfDowns);
            console.log('            Ran for: ' + yardsGainedOnPlay + ' yards\n');
            if(totalYards >= 100) {
                yardsGainedOnPlay = 0;
                totalTDs += 1;
                totalYards = 20;
                score = true;
                runResults.push(totalTDs, score);
            }
            if(totalYardsPerSetOfDowns > 10) {
                yardsGainedOnPlay = 0;
                console.log('            1st Down!\n');
            }
            return runResults;
        } else {
            console.log('Run failed.');
            return false;
        }
    }
      
    function pass() {
        // Generate a random number for yards gained in pass play with an average of 4.43
        let yardsGainedOnPlay = Math.floor(Math.random() * 9) + 1;
        yardsGainedOnPlay += yardsGainedOnPlay;
        totalYards += yardsGainedOnPlay;
        totalPasses++;
        if(yardsGainedOnPlay > 10) {
            yardsGainedOnPlay = 0; // Maintain the total yards gained
            return true; // Indicates that the index needs to be reset
        }
        if(totalYards >= 100) {
            yardsGainedOnPlay = 0; // Maintain the total yards gained
            totalTDs += 1;
            return true; // Indicates that the index needs to be reset
        }
        return false;
    }


    function punt() {
        const yardsPunted = Math.floor(Math.random() * 45) + 1;
        if(yardsPunted > yardsRemaining) {
            totalYards = 20;
        } else {
            totalYards = 100 - (yardsPunted + yardsRemaining);
        }
    }

    function fieldGoal() {
        let fieldGoalLength = yardsRemaining + 10;
        if(fieldGoalLength <= 29) {
            const successRate = Math.floor(Math.random() * 97) + 1;
            if(successRate <= 97) {
                scored = true;
                totalYards = 20;
                totalFGs += totalFGs;
            } else {
                scored = false;
                totalYards = 100 - totalYards;
            }
        } else if(fieldGoalLength > 29 && fieldGoalLength <= 39) {
            const successRate = Math.floor(Math.random() * 90) + 1;
            if(successRate <= 97) {
                scored = true;
                totalYards = 20;
                totalFGs += totalFGs;
                totalYards = 100 - totalYards;
            }
        } else if(fieldGoalLength > 39 && fieldGoalLength <= 49) {
            const successRate = Math.floor(Math.random() * 75) + 1;
            if(successRate <= 97) {
                scored = true;
                totalYards = 20;
                totalFGs += totalFGs;
                totalYards = 100 - totalYards;
            }
        } else if(fieldGoalLength > 49 && fieldGoalLength <= 59) {
            const successRate = Math.floor(Math.random() * 65) + 1;
            if(successRate <= 97) {
                scored = true;
                totalYards = 20;
                totalFGs += totalFGs;
                totalYards = 100 - totalYards;
            }
        } else if(fieldGoalLength > 59 && fieldGoalLength <= 69) {
            const successRate = Math.floor(Math.random() * 45) + 1;
            if(successRate <= 97) {
                scored = true;
                totalYards = 20;
                totalFGs += totalFGs;
                totalYards = 100 - totalYards;
            }
        }
        return;
    }

    function setOfDowns() {

        for(var d = 0; d < 4; d++) {
            let playCall = Math.floor(Math.radom() * 100) + 1;

            if(playCall < 53) {
                let playResult = callRunPlay();
                if(playResult) {
                    
                }
            }
        }
    }
    
    // for(let p = 0; p < possessions; p++) {
    //     let score = false;
    //     let turnover = false;
    //     let possesion = p + 1;
    //     if(p == 0) {
    //         totalYards = 20;
    //     }
    //     let yardsRemaining = 100 - totalYards;
    //     console.log('   ---- Possession: ' + possesion + ' ---- \n');
    //     console.log('      Starting Possesion at: ' + yardsRemaining + ' yard line.     \n');

    //     while(score == false || turnover == false) {
    //         for(let d = 0; d < 4; d++) {
    //             let totalYardsPerSetOfDowns = 0;
    //             let currentDown = d + 1;
    //             let result = false;
    //             console.log('        Down: ' + currentDown + '      \n');
    //             const decidePlay = Math.floor(Math.random() * 100) + 1;

    //             if(d == 4) {
    //                 if(totalYards >= 55) {
    //                     result = fieldGoal();
    //                     if(result == true) {
    //                         score = true;
    //                         break;
    //                     } else {
    //                         turnover = true;
    //                         break;
    //                     }
    //                 } else {
    //                     result = punt();
    //                     turnover = true;
    //                     break;
    //                 }
    //             } else {
    //                 if(decidePlay <= 53) {
                        
    //                 } else {
    //                     // Generate a random number for yards gained in pass play with an average of 4.43
    //                     let yardsGainedOnPlay = Math.floor(Math.random() * 9) + 1;
    //                     yardsGainedOnPlay += yardsGainedOnPlay;
    //                     totalYards += yardsGainedOnPlay;
    //                     totalYardsPerSetOfDowns += yardsGainedOnPlay;
    //                     totalPasses++;
    //                     console.log('            Passed for: ' + yardsGainedOnPlay + ' yards\n');
    //                     if(totalYards >= 100) {
    //                         yardsGainedOnPlay = 0;
    //                         totalTDs += 1;
    //                         score = true;
    //                         console.log('            TOUCHDOWN!!!\n');
    //                         break;
    //                     }
    //                     if(totalYardsPerSetOfDowns > 10) {
    //                         yardsGainedOnPlay = 0;
    //                         console.log('            1st Down!\n');
    //                         break;
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     for(let d = 0; d < 4; d++) {
    //         let totalYardsPerSetOfDowns = 0;
    //         let currentDown = d + 1;
    //         console.log('        Down: ' + currentDown + '      \n');
    //         const decidePlay = Math.floor(Math.random() * 100) + 1;
            
    //         if(totalYards >= 55) {
    //             if(d === 4) {
    //                 if(p < 10) {
    //                     let fieldGoalLength = yardsRemaining + 10;
    //                     if(fieldGoalLength <= 29) {
    //                         const successRate = Math.floor(Math.random() * 97) + 1;
    //                         if(successRate <= 97) {
    //                             scored = true;
    //                             totalYards = 20;
    //                             totalFGs += totalFGs;
    //                         } else {
    //                             scored = false;
    //                             totalYards = 100 - totalYards;
    //                         }
    //                     } else if(fieldGoalLength > 29 && fieldGoalLength <= 39) {
    //                         const successRate = Math.floor(Math.random() * 90) + 1;
    //                         if(successRate <= 97) {
    //                             scored = true;
    //                             totalYards = 20;
    //                             totalFGs += totalFGs;
    //                             totalYards = 100 - totalYards;
    //                         }
    //                     } else if(fieldGoalLength > 39 && fieldGoalLength <= 49) {
    //                         const successRate = Math.floor(Math.random() * 75) + 1;
    //                         if(successRate <= 97) {
    //                             scored = true;
    //                             totalYards = 20;
    //                             totalFGs += totalFGs;
    //                             totalYards = 100 - totalYards;
    //                         }
    //                     } else if(fieldGoalLength > 49 && fieldGoalLength <= 59) {
    //                         const successRate = Math.floor(Math.random() * 65) + 1;
    //                         if(successRate <= 97) {
    //                             scored = true;
    //                             totalYards = 20;
    //                             totalFGs += totalFGs;
    //                             totalYards = 100 - totalYards;
    //                         }
    //                     } else if(fieldGoalLength > 59 && fieldGoalLength <= 69) {
    //                         const successRate = Math.floor(Math.random() * 45) + 1;
    //                         if(successRate <= 97) {
    //                             scored = true;
    //                             totalYards = 20;
    //                             totalFGs += totalFGs;
    //                             totalYards = 100 - totalYards;
    //                         }
    //                     }
    //                 } else {
    //                     if(decidePlay <= 53) {
    //                         // Generate a random number for yards gained in run play
    //                         let yardsGainedOnPlay = Math.floor(Math.random() * 6) + 1;
    //                         yardsGainedOnPlay += yardsGainedOnPlay;
    //                         totalYardsPerSetOfDowns += yardsGainedOnPlay;
    //                         totalYards += yardsGainedOnPlay;
    //                         totalRuns++;
    //                         console.log('            Ran for: ' + yardsGainedOnPlay + ' yards\n');
    //                         if(totalYards >= 100) {
    //                             yardsGainedOnPlay = 0;
    //                             totalTDs += 1;
    //                             totalYards = 20;
    //                             break;
    //                         }
    //                         if(totalYardsPerSetOfDowns > 10) {
    //                             yardsGainedOnPlay = 0;
    //                             break;
    //                         }
    //                     } else {
    //                         // Generate a random number for yards gained in pass play with an average of 4.43
    //                         let yardsGainedOnPlay = Math.floor(Math.random() * 9) + 1;
    //                         yardsGainedOnPlay += yardsGainedOnPlay;
    //                         totalYards += yardsGainedOnPlay;
    //                         totalYardsPerSetOfDowns += yardsGainedOnPlay;
    //                         totalPasses++;
    //                         console.log('            Passed for: ' + yardsGainedOnPlay + ' yards\n');
    //                         if(totalYardsPerSetOfDowns > 10) {
    //                             yardsGainedOnPlay = 0;
    //                             console.log('            1st Down!\n');
    //                             break;
    //                         }
    //                         if(totalYards >= 100) {
    //                             yardsGainedOnPlay = 0;
    //                             totalTDs += 1;
    //                             console.log('            TOUCHDOWN!!!\n');
    //                             break;
    //                         }
    //                     }
    //                 }
    //             }
    //         } else {

    //             if(decidePlay <= 53) {
    //                 // Generate a random number for yards gained in run play
    //                 let yardsGainedOnPlay = Math.floor(Math.random() * 6) + 1;
    //                 yardsGainedOnPlay += yardsGainedOnPlay;
    //                 totalYardsPerSetOfDowns += yardsGainedOnPlay;
    //                 totalYards += yardsGainedOnPlay;
    //                 totalRuns++;
    //                 console.log('            Ran for: ' + yardsGainedOnPlay + ' yards\n');
    //                 if(totalYards >= 100) {
    //                     yardsGainedOnPlay = 0;
    //                     totalTDs += 1;
    //                     console.log('        TOUCHDOWN!!!\n');
    //                     break;
    //                 }
    //                 if(totalYardsPerSetOfDowns > 10) {
    //                     yardsGainedOnPlay = 0;
    //                     console.log('            1st Down!\n');
    //                     break;
    //                 }
    //             } else {
    //                 // Generate a random number for yards gained in pass play with an average of 4.43
    //                 let yardsGainedOnPlay = Math.floor(Math.random() * 9) + 1;
    //                 yardsGainedOnPlay += yardsGainedOnPlay;
    //                 totalYardsPerSetOfDowns += yardsGainedOnPlay;
    //                 totalYards += yardsGainedOnPlay;
    //                 totalPasses++;
    //                 console.log('            Passed for: ' + yardsGainedOnPlay + ' yards\n');
    //                 if(totalYards >= 100) {
    //                     yardsGainedOnPlay = 0;
    //                     totalTDs += 1;
    //                     console.log('            TOUCHDOWN!!!\n');
    //                     break;
    //                 }
    //                 if(totalYardsPerSetOfDowns > 10) {
    //                     yardsGainedOnPlay = 0;
    //                     console.log('            1st Down!\n');
    //                     break;
    //                 }
    //             }
    //             if(d == 4) {
    //                 const yardsPunted = Math.floor(Math.random() * 45) + 1;
    //                 if(yardsPunted > yardsRemaining) {
    //                     totalYards = 20;
    //                 } else {
    //                     totalYards = 100 - (yardsPunted + yardsRemaining);
    //                 }
    //                 console.log('            Punt for: ' + yardsPunted + ' yards\n');
    //                 break;
    //             }
    //         }
    //     }
    //     console.log('      Yards Gained: ' + totalYards + '      \n');
    // }
    
    console.log('TDs: ' + totalTDs + '\n');
    console.log('FGs: ' + totalFGs + '\n');
    console.log('==================');
} 
calculateNFLGame();
function calculateStats(attempts) {
    const S = 0.30; // Probability of success (30%)
    const F = 0.70; // Probability of failure (70%)
    const SS = 0.05; // Probability of scoring on a successful attempt (5%)
    const FT = 0.01; // Probability of a turnover on a failed attempt (1%)
    const NP = 0.99; // Probability of a punt on a failed attempt (99%)

    let tableData = '';

    for(let i = 0; i < attempts; i++) {
        // Check if the attempt is successful or not
        const isSuccess = Math.random() <= S;
        let score = 0;
        let turnover = 0;
        let punt = 0;

        if(isSuccess) {
            // Check if the successful attempt results in a score or not
            const isScore = Math.random() <= SS;
            if(isScore) {
            score = 1;
            }
        } else {
            // Check if the failed attempt results in a turnover or a punt
            const isTurnover = Math.random() <= FT;
            if(isTurnover) {
                turnover = 1;
            } else {
                punt = 1;
            }
        }

        // Add row to the table data
        tableData += `
            <tr>
                <th>Attempt</th>
                <th>Score</th>
                <th>Turnover</th>
                <th>Punt</th>
            </tr>
            <tr>
                <td>${i + 1}</td>
                <td>${score}</td>
                <td>${turnover}</td>
                <td>${punt}</td>
            </tr>
        `;
    }

    // Update the table body with the generated data
    document.getElementById('resultTable').innerHTML = tableData;
}

window.onload = function() {
    const registerChoices = document.getElementById('register-choices');
    const revealRegister = document.getElementById('reveal-register');
    const registerInputs = document.getElementById('register-inputs');
    const revealLogin = document.getElementById('reveal-login');
    const loginInputs = document.getElementById('login-inputs');

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
}

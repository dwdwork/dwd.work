/**
 * JS for Better Bets Gamblin' Game
 */

// Team names mapped into retrievalable object
const teams = {
    'Arizona Cardinals': 'ARI',
    'Atlanta Falcons': 'ATL',
    'Baltimore Ravens': 'BAL',
    'Buffalo Bills': 'BUF',
    'Carolina Panthers': 'CAR',
    'Chicago Bears': 'CHI',
    'Cincinnati Bengals': 'CIN',
    'Cleveland Browns': 'CLE',
    'Dallas Cowboys': 'DAL',
    'Denver Broncos': 'DEN',
    'Detroit Lions': 'DET',
    'Green Bay Packers': 'GB',
    'Houston Texans': 'HOU',
    'Indiannapolis Colts': 'IND',
    'Jaksonville Jaguars': 'JAX',
    'Kansas City Chiefs': 'KC',
    'Los Angeles Chargers': 'LAC',
    'Los Angeles Rams': 'LAR',
    'Las Vegas Raiders': 'LV',
    'Miami Dolphins': 'MIA',
    'Minnesota Vikings': 'MIN',
    'New England Patriots': 'NE',
    'New Orleans Saints': 'NO',
    'New York Giants': 'NYG',
    'New York Jets': 'NYJ',
    'Philadelphia Eagles': 'PHI',
    'Pittsburgh Steelers': 'PIT',
    'San Francisco 49ers': 'SF',
    'Seattle Seahawks': 'SEA',
    'Tampa Bay Buccaneers': 'TB',
    'Tennessee Titans': 'TEN',
    'Washington Commanders': 'WSH'
}

// Turnover differential mapped into retrievalable object
const turnoverMap = {
    ARI:   -0.3,
    ATL:   -0.2,
    BAL:   0.2,
    BUF:   -0.1,
    CAR:   -0.2,
    CHI:   -0.1,
    CIN:   0.4,
    CLE:   -0.1,
    DAL:   0.5,
    DEN:   -0.1,
    DET:   0.4,
    GB:   0.1,
    HOU:   -0.1,
    IND:   -0.8,
    JAX:   -0.1,
    KC:   0.1,
    LAC:   0.6,
    LAR:   -0.1,
    LV:   -0.5,
    MIA:   -0.3,
    MIN:   0.1,
    NE:   0.4,
    NO:   -0.6,
    NYG:   0.1,
    NYJ:   -0.4,
    PHI:   0.6,
    PIT:   0.2,
    SF:   0.7,
    SEA:   0.0,
    TB:   -0.2,
    TEN:   -0.2,
    WSH:   -0.3
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
            console.log(data.response);
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

function fetchSim() {
    // Function to handle the XML data
    function handleXML(xml) {
        // Parse the XML string into an XML document
        const xmlDoc = xml.responseXML;
  
        // Get all the 'item' elements from the XM
        const xmlObj = getElementsByTagName('xmile');

        // // Loop through each 'item' element and retrieve the data
        // for (let i = 0; i < items.length; i++) {
        //   const item = items[i];
        //   const name = item.getElementsByTagName('name')[0].textContent;
        //   const price = item.getElementsByTagName('price')[0].textContent;
  
        //   // Display the data
        //   console.log('Item Name:', name);
        //   console.log('Price:', price);
        // }
        console.log(xmlDoc);
      }

      // Function to load the XML file
      function loadXML() {
        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();
  
        // Set up the AJAX request
        xhr.open('GET', './assets/sims/FootballSim2000.xmile', true);
  
        // Define the callback function when the request is complete
        xhr.onload = function() {
          if (xhr.status === 200) {
            // Call the handleXML function to parse the XML data
            handleXML(xhr);
          } else {
            // Handle errors here if needed
            console.error('Failed to load XML:', xhr.status);
          }
        };
  
        // Send the request
        xhr.send();
      }
  
      // Call the loadXML function to start parsing the XML file
      loadXML();
}
// fetchSim();

window.onload = function() {
    const registerChoices = document.getElementById('register-choices');
    const revealRegister = document.getElementById('reveal-register');
    const registerInputs = document.getElementById('register-inputs');
    const revealLogin = document.getElementById('reveal-login');
    const loginInputs = document.getElementById('login-inputs');
    const backToLand = document.getElementsByClassName('back-to-landing');
    const runNFLGame = document.getElementById('run-nfl-game');
    
    // Updated when reveal buttons clicked
    let landing = true;

    // Only execute if element exists
    if(revealRegister) {

        revealRegister.addEventListener('click', () => {

            // Reveal register functions
            if (registerInputs.style.display === 'none') {
                registerInputs.style.display = 'block';
                registerChoices.style.display = 'none';
                landing = false;
            } else {
                registerInputs.style.display = 'none';
                registerChoices.style.display = 'flex';
                landing = true;
            }
        });
    }

    // Only execute if element exists
    if(revealLogin) {

        revealLogin.addEventListener('click', () => { 
            if (loginInputs.style.display === 'none') {
                loginInputs.style.display = 'block';
                registerChoices.style.display = 'none';
                landing = false;
            } else {
                loginInputs.style.display = 'none';
                registerChoices.style.display = 'flex';
                landing = true;
            }
        });
    }

    // Only execute if element exists
    if(backToLand) {

        Array.from(backToLand).forEach(elm => {
            elm.addEventListener('click', () => {
                if(landing === false) {
                    registerInputs.style.display = 'none';
                    loginInputs.style.display = 'none';
                    registerChoices.style.display = 'flex';
                    landing = true;
                }
            });
        });
    }

    if(runNFLGame) {
        runNFLGame.addEventListener('click', (e) => { 
            e.preventDefault();
            document.getElementById('game-results').classList.add('visible');
            calculateNFLGame();
        });
    }

    const addScripts = document.createElement('script');
    const profileBtn = document.getElementById('profile-button'); 
    const desktopProfileBtn = document.getElementById('desktop-profile-button'); 
    const dashboardBtn = document.getElementById('dashboard-button');
    const scheduleBtn = document.getElementById('schedule-button');
    const gameSimBtn = document.getElementById('game-simulator-button');
    const statsBtn = document.getElementById('stats-button');
    const appContents = document.getElementById('app-contents');
    

    function loadJSRemoveOthers(keep) {
        const fetchJS = ['dashboard', 'profile', 'game-simulator', 'schedule', 'stats'];

        for(let i = 0; i < fetchJS.length; i++) {
            let srcString = './assets/js/' + fetchJS[i] + '.js';

            if(fetchJS[i] === keep) {
                addScripts.src = srcString;
                addScripts.addEventListener('load', function() {
                    onLoad();
                });
                document.head.appendChild(addScripts);
            }
        }
    }

    function getFileContents(filename) {
        const xhr = new XMLHttpRequest();
        const fileSrc = './inc/app-parts/' + filename + '.php';
        
        xhr.open('GET', fileSrc, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = xhr.responseText;
                appContents.innerHTML = response;
            } else {
                console.log('Error loading file part');
            }
        };

        // Send the request
        xhr.send();
    }

    // Add an event listener for profile button
    profileBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Clear contents
        appContents.innerHTML = '';

        // Load contents
        getFileContents('profile');
        loadJSRemoveOthers('profile');
    });

    // Add an event listener for profile button
    desktopProfileBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Clear contents
        appContents.innerHTML = '';

        // Load contents
        getFileContents('profile');
        loadJSRemoveOthers('profile');
    });

    // Add an event listener for dashboard button
    dashboardBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Clear contents
        appContents.innerHTML = ''; 

        // Load contents
        // loadJSRemoveOthers('dashboard');
        getFileContents('dashboard');
    });

    // Add an event listener for schedule button
    scheduleBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Clear contents
        appContents.innerHTML = ''; 

        // Load contents
        // loadJSRemoveOthers('schedule');
        getFileContents('schedule');
    });

    // Add an event listener for game sim button
    gameSimBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Clear contents
        appContents.innerHTML = '';

        // Load contents
        // loadJSRemoveOthers('game-simulator');
        getFileContents('game-simulator');
    });

    // Add an event listener for schedule button
    statsBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Clear contents
        appContents.innerHTML = '';

        // Load contents
        // loadJSRemoveOthers('stats');
        getFileContents('stats');
    });
}
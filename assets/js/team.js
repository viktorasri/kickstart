const axios = require('axios');

let team = document.getElementById('team');
let validationResult = document.getElementById('teamValidation');
const validateTeam = function () {
    console.log(team.value)
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: team.value})
        .then(function(response) {
            if (response.data.valid) {
                validationResult.innerText = ":)";
            } else {
                validationResult.innerText = ":(";
            }
        })
        .catch(function (error) {
            validationResult.innerText = 'Error: ' + error;
        });
};

team.onkeyup = validateTeam;
team.onchange = validateTeam;
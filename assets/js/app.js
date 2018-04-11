require('bootstrap');
const axios = require('axios');

axios.get('/build/version.json')
    .then(function(response) {
        console.log(response.data);
    })
    .catch(function (error) {
        console.error(error);
    });
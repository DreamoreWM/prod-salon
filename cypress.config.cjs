const { defineConfig } = require("cypress");
const createBundler = require("@bahmutov/cypress-esbuild-preprocessor");
const preprocessor = require("@badeball/cypress-cucumber-preprocessor");
const createEsbuildPlugin = require("@badeball/cypress-cucumber-preprocessor/esbuild");
const { existsSync } = require("fs");
const mysql = require('mysql2');

let baseUrl = process.env.CYPRESS_APP_BASE_URL;


if (existsSync("./cypress.env.json")) {
    baseUrl = require("./cypress.env.json").APP_BASE_URL;
}



function queryTestDb(query, config) {
    // creates a new mysql connection using credentials from cypress.json env's
    const connection = mysql.createConnection({
        host: '127.0.0.1',
        port: 3306,
        user: 'root',
        password: '',
        database: 'salon'
    });
    // start connection to db
    connection.connect()
    // exec query + disconnect to db as a Promise
    return new Promise((resolve, reject) => {
        connection.query(query, (error, results) => {
            if (error) reject(error)
            else {
                connection.end()
                // console.log(results)
                return resolve(results)
            }
        })
    })
}


async function setupNodeEvents(on, config) {
    await preprocessor.addCucumberPreprocessorPlugin(on, config);

    on(
        "file:preprocessor", createBundler({
            plugins: [createEsbuildPlugin.default(config)],
        })
    );

    on('task', {
        queryDb: query => {
            return queryTestDb(query, config)
        },
    })

    return config;
}


module.exports = defineConfig({
    e2e: {
        specPattern: "**/*.feature",
        stepDefinitions: 'cypress/support/step_definitions/*.{js,ts}',
        setupNodeEvents,
        baseUrl,
        supportFile: "cypress/support/e2e.js",
    },
})

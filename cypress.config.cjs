const { defineConfig } = require("cypress");
const createBundler = require("@bahmutov/cypress-esbuild-preprocessor");
const preprocessor = require("@badeball/cypress-cucumber-preprocessor");
const createEsbuildPlugin = require("@badeball/cypress-cucumber-preprocessor/esbuild");
const { existsSync } = require("fs");
const mysql = require('mysql2/promise');

let baseUrl = process.env.CYPRESS_APP_BASE_URL;


if (existsSync("./cypress.env.json")) {
    baseUrl = require("./cypress.env.json").APP_BASE_URL;
}


async function setupNodeEvents(on, config) {
    await preprocessor.addCucumberPreprocessorPlugin(on, config);

    on(
        "file:preprocessor", createBundler({
            plugins: [createEsbuildPlugin.default(config)],
        })
    );

    on('task', {
        async queryDb(query, values) {
            const connection = await mysql.createConnection({
                host: 'localhost',
                user: 'root',
                password: '',
                database: 'salon'
            });

            const [rows] = await connection.execute(query, values);
            await connection.end();

            return rows;
        }
    });

    return config;
}


module.exports = defineConfig({
    e2e: {
        specPattern: "**/*.feature",
        stepDefinitions: 'cypress/support/step_definitions/*.{js,ts}',
        setupNodeEvents,
        baseUrl,

    },
})

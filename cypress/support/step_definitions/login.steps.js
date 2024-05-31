import { Given, When, Then } from '@badeball/cypress-cucumber-preprocessor';

Given('I am on the login page', () => {
    cy.visit('/login')
})

When('I enter my correct email and password', () => {
    cy.get('input[name=email]').type('test@test.test')
    cy.get('input[name=password]').type('test1234!')
})

When('I click on the login button', () => {
    cy.get('form').submit()
})

Then('I should be redirected to my home page', () => {
    cy.url().should('include', '/dashboard' )
})

When('I enter an incorrect email or password', () => {
    cy.get('input[name=email]').type('wrong@example.com')
    cy.get('input[name=password]').type('wrongpassword')
})

Then('I should see an error message', () => {
    cy.contains('Informations d\'identification incorrectes').should('be.visible')
})

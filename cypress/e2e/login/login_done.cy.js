describe('Login Page', function() {
    Cypress.on('uncaught:exception', (err, runnable) => {
        return false
    })

    it('Performs a successful login', function() {
        // Visitez la page de connexion
        cy.visit('127.0.0.1:8000/login')

        // Remplissez le formulaire
        cy.get('input[name=email]').type('test@test.test')
        cy.get('input[name=password]').type('test1234!')

        // Soumettez le formulaire
        cy.get('form').submit()

        // Vérifiez que vous êtes redirigé vers la page d'accueil
        cy.url().should('include', '127.0.0.1:8000/dashboard')
    })
})

describe('Login Page', function() {
    Cypress.on('uncaught:exception', (err, runnable) => {
        return false
    })

    it('Fails to login with incorrect credentials', function() {
        // Visitez la page de connexion
        cy.visit('127.0.0.1:8000/login')

        // Remplissez le formulaire avec des identifiants incorrects
        cy.get('input[name=email]').type('wronguser@example.com')
        cy.get('input[name=password]').type('wrongpassword')

        // Soumettez le formulaire
        cy.get('form').submit()

        // Vérifiez que vous êtes toujours sur la page de connexion
        cy.url().should('include', '/login')

        // Vérifiez que le message d'erreur est affiché
        cy.contains('Informations d\'identification incorrectes').should('be.visible')
    })
})

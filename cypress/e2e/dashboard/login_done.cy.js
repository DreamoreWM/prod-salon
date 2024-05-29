describe('Login Page', function() {
    it('Performs a successful login for a regular user', function() {
        // Visitez la page de connexion
        cy.visit('127.0.0.1:8000/login')

        // Remplissez le formulaire avec les informations du premier utilisateur
        cy.get('input[name=email]').type('test@test.test')
        cy.get('input[name=password]').type('test1234!')

        // Soumettez le formulaire
        cy.get('form').submit()

        // Vérifiez que vous êtes redirigé vers la page d'accueil
        cy.url().should('include', '127.0.0.1:8000/dashboard')

        // Vérifiez que l'utilisateur régulier voit seulement le lien d'accueil dans la barre de navigation
        cy.get('.menu-bar').should('contain', 'Accueil')
        cy.get('.menu-bar').should('not.contain', 'Coiffeurs')
        cy.get('.menu-bar').should('not.contain', 'Prestations')
        cy.get('.menu-bar').should('not.contain', 'Paramétres')
        cy.get('.menu-bar').should('not.contain', 'Calendrier')
        cy.get('.menu-bar').should('not.contain', 'Absences')
        cy.get('.menu-bar').should('not.contain', 'Photos')
    })

    it('Performs a successful login for an admin user', function() {
        // Visitez la page de connexion
        cy.visit('127.0.0.1:8000/login')

        // Remplissez le formulaire avec les informations de l'administrateur
        cy.get('input[name=email]').type('test.admin@test.test')
        cy.get('input[name=password]').type('testadmin1234!')

        // Soumettez le formulaire
        cy.get('form').submit()

        // Vérifiez que vous êtes redirigé vers la page d'accueil
        cy.url().should('include', '127.0.0.1:8000/dashboard')

        // Vérifiez que l'administrateur voit tous les liens dans la barre de navigation
        cy.get('.menu-bar').should('contain', 'Accueil')
        cy.get('.menu-bar').should('contain', 'Coiffeurs')
        cy.get('.menu-bar').should('contain', 'Prestations')
        cy.get('.menu-bar').should('contain', 'Paramétres')
        cy.get('.menu-bar').should('contain', 'Calendrier')
        cy.get('.menu-bar').should('contain', 'Absences')
        cy.get('.menu-bar').should('contain', 'Photos')
    })
})

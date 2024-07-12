// cypress/integration/navigation.spec.js

// cypress/integration/navigation.spec.js

describe('Navigation Test', () => {
    it('Vérifie les boutons de navigation pour un utilisateur connecté', () => {
        // Simule une connexion utilisateur
        cy.login('test@test.test', 'test123!');

        // Visite le tableau de bord
        cy.visit('/dashboard'); // Remplacez par l'URL de votre tableau de bord

        // Ouvre le menu de navigation
        cy.get('#menuButton').click(); // Remplacez par le sélecteur de votre bouton de menu

        // Vérifie que les boutons pour un utilisateur connecté sont présents
        cy.contains('Déconnexion').should('be.visible');

        cy.contains('Créer un compte').should('not.exist');

        // Ferme le menu de navigation
        cy.get('#closeButton').click(); // Remplacez par le sélecteur de votre bouton de fermeture
    });
});


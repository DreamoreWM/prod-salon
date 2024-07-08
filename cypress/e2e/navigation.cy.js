// cypress/integration/navigation.spec.js

describe('Navigation Test', () => {
    it('Vérifie les boutons de navigation pour un utilisateur non connecté', () => {
        cy.visit('/dashboard'); // Remplacez par l'URL de votre tableau de bord

        // Vérifie que les boutons pour un utilisateur non connecté sont présents
        cy.contains('Prendez rendez-vous').should('be.visible');
        cy.contains('Créer un compte').should('be.visible');
        cy.contains('Se connecter').should('be.visible');

        // Vérifie que les boutons pour un utilisateur connecté ne sont pas présents
        cy.contains('Déconnexion').should('not.exist');
        cy.contains('Coiffeurs').should('not.exist');
        cy.contains('Prestations').should('not.exist');
    });

    it('Vérifie les boutons de navigation pour un utilisateur connecté', () => {
        // Simule une connexion utilisateur (utilisez une commande personnalisée ou API pour vous connecter)
        cy.login('test@test.test', 'test123!'); // Implémentez la commande `cy.login`

        cy.visit('/dashboard'); // Remplacez par l'URL de votre tableau de bord

        // Vérifie que les boutons pour un utilisateur connecté sont présents
        cy.contains('Déconnexion').should('be.visible');

        cy.contains('Créer un compte').should('not.exist');
    });
});

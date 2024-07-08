// cypress/integration/navigation.spec.js

describe('Navigation Test', () => {
    it('Vérifie les boutons de navigation pour un utilisateur connecté', () => {
        // Simule une connexion utilisateur (utilisez une commande personnalisée ou API pour vous connecter)
        cy.login('test@test.test', 'test123!'); // Implémentez la commande `cy.login`

        cy.visit('/dashboard'); // Remplacez par l'URL de votre tableau de bord

        // Vérifie que les boutons pour un utilisateur connecté sont présents
        cy.contains('Déconnexion').should('be.visible');

        cy.contains('Créer un compte').should('not.exist');
    });
});

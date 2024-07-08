Cypress.Commands.add('login', (email, password) => {
    // Visiter la page de login pour obtenir le jeton CSRF et les cookies
    cy.visit('/login').then(() => {
        // Extraire le jeton CSRF de la balise meta
        cy.get('meta[name="csrf-token"]').then($meta => {
            const csrfToken = $meta.attr('content');

            // Faire la requête de connexion avec le jeton CSRF
            cy.request({
                method: 'POST',
                url: '/login',
                form: true,
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Ajouter le jeton CSRF dans les headers
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: {
                    _token: csrfToken,
                    email: email,
                    password: password
                }
            }).then((resp) => {
                // Afficher le contenu de resp.body pour le débogage
                console.log(resp.body);

                // S'assurer que la réponse contient le jeton de session attendu
                const sessionId = resp.headers['set-cookie'].find(cookie => cookie.startsWith('laravel_session')).split(';')[0].split('=')[1];
                if (sessionId) {
                    cy.setCookie('laravel_session', sessionId);
                } else {
                    throw new Error('La réponse ne contient pas de session_id');
                }
            });
        });
    });
});

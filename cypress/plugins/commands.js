beforeEach(() => {
        cy.task('queryDb', 'INSERT INTO users (name, email) VALUES (?, ?)', ['User 1', 'user1@example.com']);
        cy.task('queryDb', 'INSERT INTO users (name, email) VALUES (?, ?)', ['User 2', 'user2@example.com']);
    });

    afterEach(() => {
        cy.task('queryDb', 'DELETE FROM users WHERE email IN (?, ?)', ['user1@example.com', 'user2@example.com']);
    })

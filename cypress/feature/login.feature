Feature: Login

    Scenario: Successful login
        Given I am on the login page
        When I enter my correct email and password
        And I click on the login button
        Then I should be redirected to my home page

    Scenario: Failed login
        Given I am on the login page
        When I enter an incorrect email or password
        And I click on the login button
        Then I should see an error message

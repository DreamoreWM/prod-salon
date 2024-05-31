

# This is a feature file for the login page
    #  npx cypress run -e TAGS='@login and not @ignore' --headed --browser chrome
    # npx cypress run -e TAGS='@login and not @ignore' --headed --browser firefox
    # npx cypress run -e TAGS='@login and not @ignore' --headed --browser edge
    # npx cypress run -e TAGS='@login and not @ignore' --headed --browser electron
    # npx cypress run -e TAGS='@login and not @ignore' --headed --browser chromium
    # npx cypress run -e TAGS='@login and not @ignore' --headed --browser canary
    # npx cypress run cypress/feature/*.feature --headed --browser chrome
@login
Feature: Login
    @successful-login
    Scenario: Successful login
        Given I am on the login page
        When I enter my correct email and password
        And I click on the login button
        Then I should be redirected to my home page

    @failed-login @ignore
    Scenario: Failed login
        Given I am on the login page
        When I enter an incorrect email or password
        And I click on the login button
        Then I should see an error message

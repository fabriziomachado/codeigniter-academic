# features/signin_twitter.feature
Feature: Sign in with Twitter
    In order to use sytem administration
    As a user of system with a acocunt in twitter
    I need to be able of authetication using my twitter account

    Background: Authorize twitter page
       Given I am on "session/twitter"
       And I should see "Sau Online"
       And I should see "twitter"

    @javascript
    Scenario: Not Authorizing to use your account
        And I press "deny"
        And I should see "Autorizar Sau Online a usar sua conta?" 
        When I follow "Cancelar, e retornar ao aplicativo"
        Then I should see "O Twitter não pode autenticar este usuário"  

    @javascript
    Scenario: Authorizing to use your account
        When I fill in "username_or_email" with "fabriziocolombo"
        And I fill in "password" with "123456"
        And I press "allow"
        Then I should see "Fabrizio, está logado com sua conta do Twitter!"
      

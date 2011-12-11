# features/partials.feature
Feature: Partials
    To validate the operation of the library of partials
    As a Visitor of website 
    I need to be able to see the outputs of each individual partials of views

    Scenario: Acessing index page build with partials views
        Given I am on "people"
        Then I should see "Hello World, Michael"
        And I should see "Hello, Michael (1)"

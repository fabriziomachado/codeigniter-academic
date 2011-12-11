<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\Mink\Driver\GoutteDriver;    

//
// Require 3rd-party libraries here:
//

    require_once 'mink/autoload.php';
    // or, if you want to use phar from current dir:
    // require_once __DIR__ . '/mink.phar';

   require_once 'PHPUnit/Autoload.php';
   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
 class FeatureContext extends Behat\Mink\Behat\Context\MinkContext
//class FeatureContext extends BehatContext
{
####    /**
####     * Initializes context.
####     * Every scenario gets it's own context object.
####     *
####     * @param   array   $parameters     context parameters (set them up through behat.yml)
####     */
####    public function __construct(array $parameters)
####    {
####        // Initialize your context here
####    }


    /** @BeforeScenario */
    public function before($event)
    {
        
    }
    /** @AfterScenario */
    public function after($event)
    {
        chdir('..');
    }




    public function canIntercept()
        {
            $driver = $this->getSession()->getDriver();
            if (!$driver instanceof GoutteDriver) {
                throw new UnsupportedDriverActionException(
                    'You need to tag the scenario with '.
                    '"@mink:goutte" or "@mink:symfony". '.
                    'Intercepting the redirections is not '.
                    'supported by %s', $driver
                );
            }
        }

    /**
     * @When /^I follow the redirection$/
     * @Then /^I should be redirected$/
     */
    public function iFollowTheRedirection()
    {
        $this->canIntercept();
        $client = $this->getSession()->getDriver()->getClient();
        $client->followRedirects(true);
        $client->followRedirect();
    }

   /**
     * @Given /^I am in a directory "([^"]*)"$/
     */
    public function iAmInADirectory($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        chdir($dir);
    }

    /**
     * @Given /^I have a file named "([^"]*)"$/
     */
    public function iHaveAFileNamed($file)
    {
         touch($file);
    }

    /**
     * @When /^I run "([^"]*)"$/
     */
    public function iRun($command)
    {
        exec($command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /**
     * @Then /^I should get:$/
     */
    public function iShouldGet(PyStringNode $string)
    {
          echo $this->output;
          assertEquals((string) $string, $this->output);
         
#         if ((string) $string !== $this->output) {
#            throw new Exception(
#                "Actual output is:\n" . $this->output
#            );
#        }
    }



    /**
     * @Then /^I wait for the suggestion box to appear$/
     */
    public function iWaitForTheSuggestionBoxToAppear()
    {
        $this->getSession()->wait(5000,
            "$('.suggestions-results').children().length > 0"
        );
    }

}

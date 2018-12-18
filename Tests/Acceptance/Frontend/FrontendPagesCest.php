<?php
declare(strict_types = 1);
namespace OliverHader\RedCrossProject\Tests\Acceptance\Frontend;

use OliverHader\RedCrossProject\Tests\Acceptance\Support\AcceptanceTester;

class FrontendPagesCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function homePageIsRendered(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Community', 'h2');
        $I->see('Kids', 'h2');
        $I->see('Activities', 'h2');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function userLoginWorks(AcceptanceTester $I)
    {
        $I->wantTo('Ensure behavior of frontend user login ');
        $I->amOnPage('/');
        $I->click('My Red Cross', 'nav');

        $I->see('User login', 'h3');
        $I->dontSee('My Activities');
        $I->dontSee('All Activities');

        // either selecting field using XPath ...
        $I->fillField("//input[@name='user']", 'user-001');
        // ... or using attribute collection
        $I->fillField(['name' => 'pass'], 'password');
        $I->click('Login', 'form');

        $I->see('My Activities');
        $I->see('All Activities');

        $I->makeScreenshot('logged-in');
    }
}

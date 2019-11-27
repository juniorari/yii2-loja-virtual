<?php 

class LoginPageCest
{
    public function testandoAdminLogin(AcceptanceTester $I) {


        $I->amOnPage('/site/login.html');
        $I->fillField(['name' => 'LoginForm[username]'], 'admin');
        $I->fillField(['name' => 'LoginForm[password]'], 'admin123');
        $I->canSeeLink('Login');
        $I->click('#login-form button[type=submit]');
        $I->see('Olá, admin');

    }
}

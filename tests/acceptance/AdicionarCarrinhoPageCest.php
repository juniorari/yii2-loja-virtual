<?php 

class AdicionarCarrinhoPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {

        $I->amOnPage('/produtos/adicionar-carrinho.html?id=1');
        $I->see('{"color":"text-success","count":');

    }
}

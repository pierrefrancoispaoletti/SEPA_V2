<?php

require_once "autoload.php";

use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    public function testGetIbanCrediteur()
    {
        $transaction = new NationalTransaction(array(
            'ibanCrediteur' => 'FR1420041010050500013M02606',
        ));
        $this->assertEquals('FR1420041010050500013M02606', $transaction->getIbanCrediteur());
    }
    public function testSetIbanCrediteur()
    {

        $transaction = new NationalTransaction(array());

        $transaction->setIbanCrediteur('FR1420041010050500013M02606');
        $this->assertEquals('FR142004101005050001302606', $transaction->getIbanCrediteur());
    }
}

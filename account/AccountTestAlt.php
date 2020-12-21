<?php
require('Account.php');

class AccountTestAlt
{
    public function testCvu()
    {
        $account = new Account();

        $client = new Client();
        $client->setId('38888689');
        $client->setName('Italo André');

        $account->setClient($client);

        $cvu = $account->getCvu();

        return ($account->getCvu() == '38888689-ITALO.ANDRE');
    }

    public function testBalanceArs() {
        $account = new Account();

        $client = new Client();
        $client->setId('38888689');
        $client->setName('Italo André');

        $account->setClient($client);

        $account->addMovement(new Movement('USD',100));
        $account->addMovement(new Movement('ARS',100));
        $account->addMovement(new Movement('ARS',-50));
        
        return ($account->getBalance('ARS') == 50);
    }

    public function testBalanceUsd() {
        $account = new Account();

        $client = new Client();
        $client->setId('38888689');
        $client->setName('Italo André');

        $account->setClient($client);

        $account->addMovement(new Movement('USD',100));
        $account->addMovement(new Movement('ARS',100));
        $account->addMovement(new Movement('ARS',-50));
        $account->addMovement(new Movement('USD',100));
        $account->addMovement(new Movement('USD',-100));
        
        return ($account->getBalance('USD') == 100);
    }
}

$test = new AccountTestAlt;
$testCvu = $test->testCvu();
$testBalanceArs = $test->testBalanceArs();
$testBalanceUsd = $test->testBalanceUsd();

echo "Ejecutando AccountTestAlt\n";
echo "testCvu: ".( $testCvu ? "OK" : "ERROR, se esperaba CVU = 38888689-ITALO.ANDRE");
echo "\n";
echo "testBalanceArs: ". ( $testBalanceArs ? "OK" : "ERROR, se esperaba BALANCE ARS = 50");
echo "\n";
echo "testBalanceUsd: ". ( $testBalanceUsd ? "OK" : "ERROR, se esperaba BALANCE USD = 100");
echo "\n";

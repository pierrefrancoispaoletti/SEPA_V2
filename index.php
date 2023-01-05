<?php

require_once "autoload.php";


//ce sont les transactions que nous recevons depuis le config
$transactions = [
    [
        'ibanCrediteur' => 'FR7630001007941234567890185',
        'ibanDebiteur' => 'FR7630006000011234567890189',
        'bicCrediteur' => 'CCBPFRPPVER',
        'bicDebiteur' => 'CCBPFRPPNTE',
        'nomCrediteur' => 'John Doe',
        'amount' => 100.0,
        'nomInitiateur' => 'Jane Doe',
        'description' => 'Paiement de facture'
    ],
    [
        'ibanCrediteur' => 'FR7630001007941234867890185',
        'ibanDebiteur' => 'FR7630006000018234567890189',
        'bicCrediteur' => 'CCBPFRPPVER',
        'bicDebiteur' => 'CCBPFRPPNTE',
        'nomCrediteur' => 'Jean francois de burnemauves',
        'amount' => 50.0,
        'nomInitiateur' => 'Tulupiantu',
        'description' => 'Paiement de facture'
    ]
];


$Transactions = [];
foreach ($transactions as $transaction) {

    $Transactions[] = new NationalTransaction($transaction);
}

$formater = new TransactionFormatter($Transactions, new ClassicTransactionFormat());


$xml = $formater->format();

$exporter = new TransactionExporter($xml);

$exporter->export();

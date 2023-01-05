<?php

class TransactionFormatter
{
    public $transactions;
    private $format;

    public function __construct(array $transactions, TransactionFormat $format)
    {
        $this->transactions = $transactions;
        $this->format = $format;
    }

    public function format(): string
    {
        return $this->format->format($this->transactions);
    }
}

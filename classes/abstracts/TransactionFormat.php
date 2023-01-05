<?php

abstract class TransactionFormat
{
    abstract public function format(array $transactions): string;
}

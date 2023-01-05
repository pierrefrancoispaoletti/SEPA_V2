<?php

final class InterNationalTransaction extends Transaction
{
    public static function getType()
    {
        return "international";
    }
}

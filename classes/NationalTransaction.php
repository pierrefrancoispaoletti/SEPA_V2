<?php
final class NationalTransaction extends Transaction
{
    public static function getType()
    {
        return "national";
    }
}

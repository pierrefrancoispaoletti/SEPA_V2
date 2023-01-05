<?php

class TransactionExporter
{
    private $xml;

    public function __construct(string $xml)
    {
        $this->xml = $xml;
    }

    public function export(): void
    {
        // On envoie les entêtes HTTP
        header('Content-Type: text/xml');
        header('Content-Disposition: attachment; filename="export.xml"');

        // On envoie le XML
        echo $this->xml;
    }
}

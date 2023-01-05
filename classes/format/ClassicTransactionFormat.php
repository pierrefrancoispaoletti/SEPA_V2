<?php
class ClassicTransactionFormat extends TransactionFormat
{
    /*
    |--------------------------------------------------------------------------
    | Classic Transaction Format
    |--------------------------------------------------------------------------
    |
    | Format de transaction classique pour les virements SEPA
    | @TODO : implementer le type des transactions pour generer en sortie le format correspondant, on peut le recuperer avec $transaction->getType(), cela retourne national ou international
    | on pourrait envisager de coder une fonction getTemplate qui irait chercher le template correspondant en fonction du type et du nom de la classe qui l'appelle ( a coder dans la classe abstraite TransactionFormat pour le rendre dispo dans toutes les classes de formattage), par exemple avec un attribut template qui prends static::class pour le nom de la
    classe et une methode getTemplate($nomDuTemplate), la variable nom du template se contruirait comme ça : $nomDuTemplate = "{$this->template}" . "ucFirst($transaction->getType())"."template.php"
    |ou, on pourrait le faire en amont dans la classe abstraite setter le template et lui passer les infos...
    */



    public function format(array $transactions): string
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<Document xmlns="urn:iso:std:iso:20022:tech:xsd:pain.001.001.03">';
        $xml .= '<CstmrCdtTrfInitn>';
        $xml .= '<GrpHdr>';
        $xml .= '<MsgId>' . uniqid('id-', true) . '</MsgId>';
        $xml .= '<CreDtTm>' . date('Y-m-d\TH:i:s') . '</CreDtTm>';
        $xml .= '<NbOfTxs>' . count($transactions) . '</NbOfTxs>';
        $xml .= '<CtrlSum>' . array_sum(array_map(function ($t) {
            return $t->getAmount();
        }, $transactions)) . '</CtrlSum>';
        $xml .= '<InitgPty>';
        $xml .= '<Nm>' . $transactions[0]->getNomInitiateur() . '</Nm>';
        $xml .= '</InitgPty>';
        $xml .= '</GrpHdr>';

        foreach ($transactions as $transaction) {
            $xml .= '<PmtInf>';
            $xml .= '<PmtInfId>' . uniqid("trs-", true) . '</PmtInfId>';
            $xml .= '<PmtMtd>TRF</PmtMtd>';
            $xml .= '<BtchBookg>false</BtchBookg>';
            $xml .= '<NbOfTxs>' . count($transactions) . '</NbOfTxs>';
            $xml .= '<CtrlSum>' . array_sum(array_map(function ($t) {
                return $t->getAmount();
            }, $transactions)) . '</CtrlSum>';
            $xml .= '<PmtTpInf>';
            $xml .= '<InstrPrty>NORM</InstrPrty>';
            $xml .= '<SvcLvl>';
            $xml .= '<Cd>SEPA</Cd>';
            $xml .= '</SvcLvl>';
            $xml .= '<LclInstrm>';
            $xml .= '<Cd>TRF</Cd>';
            $xml .= '</LclInstrm>';
            $xml .= '<CtgyPurp>';
            $xml .= '<Cd>SUPP</Cd>';
            $xml .= '</CtgyPurp>';
            $xml .= '</PmtTpInf>';
            $xml .= '<ReqdExctnDt>' . date('Y-m-d') . '</ReqdExctnDt>';
            $xml .= '<Dbtr>';
            $xml .= '<Nm>' . $transaction->getNomDebiteur() . '</Nm>';
            $xml .= '</Dbtr>';
            $xml .= '<DbtrAcct>';
            $xml .= '<Id>';
            $xml .= '<IBAN>' . $transaction->getIbanDebiteur() . '</IBAN>';
            $xml .= '</Id>';
            $xml .= '<Ccy>' . $transaction->getCurrency() . '</Ccy>';
            $xml .= '</DbtrAcct>';
            $xml .= '<DbtrAgt>';
            $xml .= '<FinInstnId>';
            $xml .= '<BIC>' . $transaction->getBicDebiteur() . '</BIC>';
            $xml .= '</FinInstnId>';
            $xml .= '</DbtrAgt>';
            $xml .= '<CdtTrfTxInf>';
            $xml .= '<PmtId>';
            $xml .= '<EndToEndId>' . uniqid() . '</EndToEndId>';
            $xml .= '</PmtId>';
            $xml .= '<Amt>';
            $xml .= '<InstdAmt Ccy="' . $transaction->getCurrency() . '">' . $transaction->getAmount() . '</InstdAmt>';
            $xml .= '</Amt>';
            $xml .= '<CdtrAgt>';
            $xml .= '<FinInstnId>';
            $xml .= '<BIC>' . $transaction->getBicCrediteur() . '</BIC>';
            $xml .= '</FinInstnId>';
            $xml .= '</CdtrAgt>';
            $xml .= '<Cdtr>';
            $xml .= '<Nm>' . $transaction->getNomCrediteur() . '</Nm>';
            $xml .= '</Cdtr>';
            $xml .= '<CdtrAcct>';
            $xml .= '<Id>';
            $xml .= '<IBAN>' . $transaction->getIbanCrediteur() . '</IBAN>';
            $xml .= '</Id>';
            $xml .= '</CdtrAcct>';
            $xml .= '<RmtInf>';
            $xml .= '<Ustrd>' . $transaction->getDescription() . '</Ustrd>';
            $xml .= '</RmtInf>';
            $xml .= '</CdtTrfTxInf>';
            $xml .= '</PmtInf>';
        }

        $xml .= '</CstmrCdtTrfInitn>';
        $xml .= '</Document>';


        return $xml;
    }
}

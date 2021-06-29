<?php 
require_once __DIR__ . "/vendor/autoload.php";
    use AbaFileGenerator\Model\Transaction;
    use AbaFileGenerator\Model\TransactionCode;
    use AbaFileGenerator\Generator\AbaFileGenerator;

    
    $bsb_number = "032-898";
    $account_number ='12345678';
      $bank_name = 'CBA';
       $direct_entry_id = '175029';
        $description = 'Payroll';
         $amount = '152000';
          $reference = '122';
          $account_name = 'Femi Denton';
         
        $generator = new AbaFileGenerator(
            $bsb_number, // bsb
            $account_number, // account number
            $bank_name, // bank name
            'User Name',
            'Remitter',
            $direct_entry_id, // direct entry id for CBA
            $description // description
        );
        
    
        $transaction = new Transaction();  
        $transaction->setAccountName($account_name);
        $transaction->setAccountNumber($account_number);
        $transaction->setBsb($bsb_number);
        $transaction->setTransactionCode('13');
        $transaction->setReference($reference);
        $transaction->setAmount($amount);
    
    
        // Set a custom processing date if required
        //$generator->setProcessingDate('tomorrow');
    
        $abaString = $generator->generate($transaction); // $transaction could also be an array here
        file_put_contents(__DIR__.'/file.aba', $abaString);
    
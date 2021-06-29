<?php 
    require_once __DIR__ . "/vendor/autoload.php";
    use AbaFileGenerator\Model\Transaction;
    use AbaFileGenerator\Generator\AbaFileGenerator;
    
    function generateFile($bsb_number = "123-456", $account_number ='12345678', $bank_name = 'CBA', $direct_entry_id = '175029', $description = 'Payroll', $amount = '152000', $reference = '122')
    {
        $generator = new AbaFileGenerator(
            $bsb_number, // bsb
            $account_number, // account number
            $bank_name, // bank name
            'User Name',
            'Remitter',
            $direct_entry_id, // direct entry id for CBA
            $description // description
        );
        $account_name = 'Femi Denton';
    
        $transaction = new Transaction();
        $transaction->setAccountName($account_name);
        $transaction->setAccountNumber($account_number);
        $transaction->setBsb($bsb_number);
        $transaction->setTransactionCode('13');
        $transaction->setReference($reference);
        $transaction->setAmount($amount);
    
    
        // Set a custom processing date if required
        $generator->setProcessingDate('tomorrow');
    
        $abaString = $generator->generate($transaction); // $transaction could also be an array here
        file_put_contents(__DIR__.'/ABAFile '.date('m-d-Y').'.aba', $abaString);
    }

   if(filter_has_var(INPUT_POST, 'submit')){
        print('aa');
        generateFile();
        
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABA Test</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <button type="submit" name='submit'>Submit</button>
    </form>
</body>
</html> 
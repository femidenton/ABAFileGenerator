<?php 

    require_once __DIR__ . "/vendor/autoload.php";
    use AbaFileGenerator\Model\Transaction;
    use AbaFileGenerator\Generator\AbaFileGenerator;
    

    

/*Create a function to activate the connection . */

$connection = mysql_connect($dbSevername, $dbUsername, $dbPassword, $dbName );

    function generateFile($bsb_number  = "032-898", $account_number ='12345678', $bank_name  = 'CBA', $direct_entry_id = '175029', $description = 'PAYMENTS', $amount  = '152000', $reference = '122')
    {
        $generator = new AbaFileGenerator(
            $bsb_number, // bsb
            $account_number, // account number
            $bank_name, // bank name
            'Freo Machinery',
            'Freo Group Pty',
            $direct_entry_id, // direct entry id for CBA
            $description // description
        );
        $account_name = 'Freo Machinery';
    
        $transaction = new Transaction();
        $transaction->setAccountName($account_name);
        $transaction->setAccountNumber($account_number);
        $transaction->setBsb($bsb_number);
        $transaction->setTransactionCode('53');
        $transaction->setReference($reference);
        $transaction->setAmount($amount);
      
    
        // Set a custom processing date if required
        $generator->setProcessingDate('tomorrow');
    
        $abaString = $generator->generate($transaction); // $transaction could also be an array here
        file_put_contents(__DIR__.'/ABAFile '.date('m-d-Y-h-i-s').'.aba', $abaString);
    }

   if(filter_has_var(INPUT_POST, 'submit')){
        print('GENERATED!!');
      /*  $bsb_number = $_POST['bsb_number'];
        $account_number = $_POST['account_number'];
        $bank_name = $_POST['bank_name'];
        $direct_entry_id = $_POST['direct_entry_id'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $reference = $_POST['reference'];

       */
        
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
    <link rel="stylesheet" href="https://bootswatch.com/5/cosmo/bootstrap.min.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
       <!-- <input type="text" name="bsb_number" class="form-control" placeholder="Enter BSB Number">
        <input type="text" name="account_number" class="form-control" placeholder="Enter Account Number">
        <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name">
        <input type="text" name="direct_entry_id" class="form-control" placeholder="Enter Direct Entry ID">
        <input type="text" name="description" class="form-control" placeholder="Enter Description">
        <input type="text" name="amount" class="form-control" placeholder="Enter Amount">
        <input type="text" name="reference" class="form-control" placeholder="Enter Reference"> -->
        <button type="submit" name='submit' class="btn btn-default">Submit</button>
    </form>
</body>
</html> 
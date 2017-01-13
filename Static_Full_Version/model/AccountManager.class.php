<?php
include_once 'SuperManager.class.php';
require_once("BookTransaction.class.php");
require_once("BookBuilder.class.php");
class AccountManager extends SuperManager{
    public function __construct($user){
        parent::__construct($user);
    }
    public function accountOverview($boughtBooks, $soldBooks){
        $info = array();
        $spent = 0;
        $money_made = 0;
        foreach ($boughtBooks as $book) {
            $spent += $book->getBook()->getPrice();  
        }

        foreach ($soldBooks as $trans) {
            $money_made += $trans->getBook()->getPrice();    
        }
        $profit = $money_made - $spent;
        
        $info['books_bought'] = count($boughtBooks);
        $info['spent'] = $spent;
        $info['books_sold'] = count($soldBooks);
        $info['money_made'] = $money_made;
        $info['profit'] = $profit;
        
        return $info;
    }
}

?>

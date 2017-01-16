<?php
/**
 * 
 */
class AccountView{
    
    public function displayBought($trans){
        echo "<tr>";
        echo "<td class='fakeLink'> {$trans->getBook()->getTitle()}</td>";
        echo "<td> {$trans->getBook()->getIsbn()}</td>";
        echo "<td> <span class='label label-warning'>{$trans->getBook()->getCourseNum()}</span></td>";
        echo "<td>".'$'."{$trans->getBook()->getPrice()}.00</td>";
        $date = date("m/d/y",$trans->getTransDate());
        echo "<td class='text-right'> {$date}</td>";
        echo "<td class='text-right'><i data-id='{$trans->getBook()->getID()}' data-toggle='modal' data-target='#removePurchaseModal' class='fa fa-trash text-danger delete_purchase'></i></td>";
        echo "<td> {$trans->getBook()->getAuthors()}</td>";
        echo "<td> {$trans->getBook()->getCondition()}</td>";
        echo "<td> {$trans->getBook()->getNotes()}</td>";
        $seller = $_SESSION['loader']->getInfoController()->getUserInfo($trans->getSeller());
        echo "<td> {$seller->getName()}</td>";
        echo "<td> <a href='mailto:{$seller->getEmail()}'>{$seller->getEmail()}</a></td>";
        echo "<td> {$seller->getPhone()}</td>";
        echo "</tr>";
    }
    public function displaySold($trans){
        echo "<tr>";
        echo "<td class='fakeLink'> {$trans->getBook()->getTitle()}</td>";
        echo "<td> {$trans->getBook()->getIsbn()}</td>";
        echo "<td> <span class='label label-warning'>{$trans->getBook()->getCourseNum()}</span></td>";
        echo "<td>".'$'."{$trans->getBook()->getPrice()}.00</td>";
        $date = date("m/d/y",$trans->getTransDate());
        echo "<td class='text-right'> {$date}</td>";
        echo "<td> {$trans->getBook()->getAuthors()}</td>";
        echo "<td> {$trans->getBook()->getCondition()}</td>";
        echo "<td> {$trans->getBook()->getNotes()}</td>";
        $buyer = $_SESSION['loader']->getInfoController()->getUserInfo($trans->getBuyer());
        echo "<td> {$buyer->getName()}</td>";
        echo "<td> <a href='mailto:{$buyer->getEmail}'>{$buyer->getEmail()}</a></td>";
        echo "<td> {$buyer->getPhone()}</td>";
        echo "</tr>";
    }
    public function displayCurrentListings(){
        echo "<tr>";
        echo "<td class='fakeLink'> {$listing->getTitle()}</td>";
        echo "<td> {$listing->getIsbn()}</td>";
        echo "<td> <span class='label label-warning'>{$listing->getCourseNum()}</span></td>";
        echo "<td>".'$'."{$listing->getPrice()}.00</td>";
        echo "<td class='text-right'><i data-id='{$listing->getID()}' data-toggle='modal' data-target='#removeListingModal' class='fa fa-trash text-danger delete_listing'></i></td>";
        echo "<td> {$listing->getAuthors()}</td>";
        echo "<td> {$listing->getCondition()}</td>";
        echo "<td> {$listing->getNotes()}</td>";
        echo "</tr>";

    }
}
?>

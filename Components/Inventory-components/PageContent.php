<?php
    if(!isset($_GET['filter']) or $_GET['filter'] == '' or $_GET['filter'] == "list"){
        require "listItem.php";
        $items = getItemList();
        foreach($items as $item){
            generateItem($item);
        }
    }else{
        require "transactionItem.php";
        $transactions = getTransactions();
        foreach($transactions as $transaction){
            generateItem($transaction);
        }
    }
?>
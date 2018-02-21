/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global moneyMarketData */

'use strict';
/*
 * LINE CHART
 * ----------
 * for the money Market fund perfomance
 */
$(function () {
// Get context with jQuery - using jQuery's .get() method.
    var mmfCanvas = $("#money-market").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var moneyMarket = new Chart(mmfCanvas);

    //data for the sales chart 
    var rates = <?php echo json_encode[$rates]; ?> ;
            var equity = < ?php echo json_encode[$equity]; ? > ;
            var fixed = < ?php echo json_encode[$fixed]; ? > ;
            var balanced = < ?php echo json_encode[$balanced]; ? > ;
            moneyMarketData
    {
    "Labels": ['rates.date'];
    }
});

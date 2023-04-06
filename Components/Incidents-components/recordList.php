<div class="list">
    <?php 
        if(isset($_GET['filter']) and $_GET['filter'] == "curfew"){
            require "curfewItem.php";
            $violations = getCurfewViolators();
            foreach($violations as $violation){
                generateItem($violation);
            }
        }else{
            require "blottersItem.php";
            $blotters = getBlotters();
            foreach ($blotters as $blotter) {
            generateItem($blotter);
        }
        }
    ?>
</div>
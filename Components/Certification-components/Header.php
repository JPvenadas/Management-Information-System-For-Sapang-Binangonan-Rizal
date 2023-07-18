<div class="header">
    <div class="header-left">
        <p>Baranggay Certificate</p>
    </div>
    <div class="header-right">
        <?php
        if(!isset($_GET['transaction'])){?>
 
        <button onclick="printDiv('certificate')" class="print-button">
            <ion-icon name="print-sharp"></ion-icon>
            <p>Print</p>
        </button>

        <?php }?>
    </div>
</div>

<script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.classList.add('print-container')
                document.body.innerHTML = printContents;
                window.print();
                document.body.classList.remove('print-container')
                document.body.innerHTML = originalContents;
            }
</script>
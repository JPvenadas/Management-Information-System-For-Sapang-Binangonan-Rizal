<div class="header">
    <div class="header-left">
        <p><?php echo $_GET['content']?> Reports</p>
    </div>
    <div class="header-right">

        <button onclick="printDiv('certificate')" class="print-button">
            <ion-icon name="print-sharp"></ion-icon>
            <p>Print</p>
        </button>
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
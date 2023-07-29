<div class="tab-header">
    <div>
        <img src="../../Images/logo.png" class="logo" alt="">
        <h1 class="system-title">Management Information System for Barangay Sapang</h1>
    </div>
    <p class="date"></p>

    <script>
    function setDate() {
        let datetext = document.querySelector(".date")
        let date = new Date()
        datetext.innerHTML = date.toDateString() + " " + date.toLocaleTimeString();
    }
    setDate()
    setInterval(() => {
        setDate()
    }, 1000);
    </script>
    <h2 class="tab-title"><?php echo "Hello " . $_SESSION['firstName'] . ", Welcome to your dashboard"?></h2>
</div>
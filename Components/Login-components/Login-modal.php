<div class="modal-background-blur login-modal">
        <div class="modal-content">
            <div class="blue-line"></div>
            <button onclick="closeLoginModal()" class="modal-close-button">
                <ion-icon name="close"></ion-icon>
            </button>
            <div class="modal-texts">
                <h3>Sign in</h3>
                <p class="text-16px-gray">Welcome Back! Kabarangay!</p>
            </div>

            <form class="login-form"
                  action="Functions/login.php" 
                  method="POST">

                <label for="username" class="text-16px-gray" for="">Username</label>
                <input  class="input" 
                        id = "username" 
                        name="uname"
                        required
                        placeholder="ex. @JuanLegazpiDelaCruz" 
                        type="text">

                <label for="password" class="text-16px-gray" for="">Password</label>
                <input  class="input" 
                        id = "password"
                        name="password"
                        required
                        placeholder="Type your password here" 
                        type="password">
                
                <div class="show-password">
                    <input id="show" type="checkbox">
                    <label class="text-13px-gray" for="show">Show Password</label>
                </div>

                <button class="button-fill" type="submit" >Login</button>
                <a class="text-14px-blue-underline" href="Pages/Recovery/AccountRecovery.php">Forgot Password</a>
            </form>
            <div>
                <span class="text-16px-gray">Doesn't have an account?</span>
                <a class="text-14px-blue-underline" href="Pages/Register/RegistrationForm.php?step=1"> Register now</a>
            </div>
        </div>
    </div>
    <script>
    //appearing and disappearing of modal
    const loginModal =document.querySelector('.login-modal');
    const loginModalContent =document.querySelector('.modal-content');
    const body = document.querySelector('body');
    let openModal = false;

    function openLoginModal(){
        loginModal.style.display = 'flex';
        body.style.overflowY = 'hidden'
        openModal = true;
    }
    function closeLoginModal(){
        loginModal.style.display = 'none';
        body.style.overflowY = 'auto'
        openModal = false;
    }
   
    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (openModal && event.target === loginModal) {
            closeLoginModal();
        }
    });

    //password showing
    const showPasswordCheckbox = document.getElementById('show');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>
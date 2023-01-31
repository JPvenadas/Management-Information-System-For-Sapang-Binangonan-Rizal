<form action="?step=3" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Create an Account</h2>
        <p class="text">Please fill the necessary information below</p>

        <!-- FirstName input -->
        <label class="label" for="firstName">First Name</label>
        <input required placeholder="First Name" id="firstName" name="firstName" class="input" type="text"
        value="<?php inputContent('firstName'); ?>">

        <!-- MiddleName input -->
        <label class="label" for="middleName">Middle Name</label>
        <input required placeholder="Middle Name" id="middleName" name="middleName" class="input" type="text"
        value="<?php inputContent('middleName'); ?>">

        <!-- LastName input -->
        <label class="label" for="lastName">Last Name</label>
        <input required placeholder="Last Name" id="lastName" name="lastName" class="input" type="text"
        value="<?php inputContent('lastName'); ?>">

         <!-- Name Extension input -->
         <label class="label" for="extension">Name Extension</label>
        <input placeholder="Extension (Ex: Ma, Jr. 3rd)" id="extension" name="extension" class="input" type="text"
        value="<?php inputContent('extension'); ?>">

         <!-- Name Extension input -->
         <label class="label" for="Birthdate">Birth Date</label>
        <input required placeholder="Birth Date" onfocus="(this.type = 'date')" id="BirthDate" name="birthDate" class="input" type="text"
        value="<?php inputContent('birthDate'); ?>">
    </div>
    <div class="button-group">
        <a href="?step=1" class="action-button">
            <p>Previous</p>
        </a>
        <button name="next2" type="submit" class="action-button">
            <p>Next</p>
        </button>
    </div>
</form>

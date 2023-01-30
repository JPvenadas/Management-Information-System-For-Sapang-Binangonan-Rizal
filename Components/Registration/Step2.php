<form action="?step=3" method="POST" class="form">
    <div class="limit-width">
        <h2 class="form-title">Create an Account</h2>
        <p class="text">Please fill the necessary information below</p>
        <!-- FirstName input -->
        <label class="label" for="firstName">First Name</label>
        <input placeholder="First Name" id="firstName" class="input" type="text">
        <!-- MiddleName input -->
        <label class="label" for="middleName">Middle Name</label>
        <input placeholder="Middle Name" id="middleName" class="input" type="text">
        <!-- LastName input -->
        <label class="label" for="lastName">Last Name</label>
        <input placeholder="Last Name" id="lastName" class="input" type="text">
         <!-- Name Extension input -->
         <label class="label" for="extension">Name Extension</label>
        <input placeholder="Extension (Ex: Ma, Jr. 3rd)" id="extension" class="input" type="text">
         <!-- Name Extension input -->
         <label class="label" for="Birthdate">Birth Date</label>
        <input placeholder="Birth Date" onfocus="(this.type = 'date')" id="BirthDate" class="input" type="text">
    </div>
    <div class="button-group">
        <a href="?step=1" class="action-button">
            <p>Previous</p>
        </a>
        <button type="submit" class="action-button">
            <p>Next</p>
        </button>
    </div>
</form>

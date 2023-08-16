<div class="contact-us">
    <div class="container">
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <h1 class="text-33px-navy">Contact us</h1>
            <p class="text-16px-gray-2">For general inquiries, feedback, or any non-urgent matters, feel free to reach
                out
                to us through email or our online contact form. We value your input and will respond to your queries as
                promptly as possible. While most of our interactions occur online, you're welcome to visit our physical
                office for more personalized assistance. Our friendly staff will be happy to address your questions and
                concerns.</p>
            <div>
                <p class="text-16px-gray-2">Email: <?php echo $contacts['email']?></p>
                <p class="text-16px-gray-2">Address: <?php echo $contacts['address']?></p>

            </div>
        </div>
        <form action="https://formsubmit.co/jaypheevenadas18@gmail.com" method="POST">
            <div style="display: flex; gap: 10px">
                <div style="width: 50%">
                    <label class="text-13px-gray" for="">Full Name</label>
                    <input required name="Name" class="input background-white" placeholder="Full Name" type="text">
                </div>
                <div style="width: 50%">
                    <label class="text-13px-gray" for="">Email</label>
                    <input required name="Email" class="input background-white" placeholder="Email" type="text">
                </div>
            </div>
            <div>
                    <label class="text-13px-gray" for="">Subject</label>
                    <input required name="Subject" class="input background-white" placeholder="Subject" type="text">
                </div>
            <div>
                <label class="text-13px-gray" for="">Message</label>
                <textarea required name="Message" class="long-input background-white" placeholder="Message" name=""></textarea>

            </div>
            <div>
                <button class="button">Submit</button>
            </div>
        </form>
        <p class="text-16px-gray-2"></p>
    </div>
</div>
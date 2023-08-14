<section class="section-2">
            <div class="section-2-container">
                <h3 class="text-33px-navy">Register now Kabarangay!</h3>
                <p class="text-18px-gray">As a valued resident, this is your chance to access tailored services and information, enhancing engagement and unity within our community.</p>
                <div class="feature-container">
                    <?php
                    include "Components/Login-components/feature-item.php";
                    
                    $features = array(
                        array(
                            "title" => "Seamless Updates",
                            "description" => "Effortlessly keep your information up-to-date. Ensure the barangay always has accurate and current details about you.",
                            "img-src" => "Images/feature-info.png"
                        ),
                        array(
                            "title" => "Stay Informed",
                            "description" => "Receive essential barangay announcements directly to your account or through SMS so you never miss crucial information.",
                            "img-src" => "Images/feature-notif.png"
                        ),
                        array(
                            "title" => "Access Services",
                            "description" => "Conveniently online service feature and skip lines and paperwork. Streamline your Barangay service experience.",
                            "img-src" => "Images/feature-services.png"
                        ),
                        array(
                            "title" => "Track Transactions",
                            "description" => "Effortlessly track your transactions and maintain a comprehensive record. Stay organized with easy access to your interaction history.",
                            "img-src" => "Images/feature-transac.png"
                        )
                    );
                    
                    foreach($features as $feature){
                        generateFeatureItem($feature);
                    }
                    ?>
                </div>
            </div>
        </section>
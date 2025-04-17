<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinnaCafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar section-content">
            <a href="#" class="nav-logo">
                <h2 class="logo-text">CinnaCafe</h2>
                <ul class="nav-menu">
                    <button id="menu-close-button" class="fas fa-times"></button>

                    <li class="nav-item">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#menu" class="nav-link">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#testimonials" class="nav-link">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a href="#gallery" class="nav-link">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">Profile</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                    <?php } ?>
                </ul>
            </a>
            <button id="menu-open-button" class="fas fa-bars"></button>
        </nav>
    </header>

    <main>
        <!-- hero section -->
        <section class="hero-section">
            <div class="section-content">
                <div class="hero-details">
                    <h2 class="title">Best Dessert</h2>
                    <h3 class="subtitle">Make your day great with our special desserts!</h3>
                    <p class="description">Welcome to our dessert paradise, where every bite tells a story and every plate sparks joy.</p>
                    <div class="buttons">
                        <a href="table_reservation.php" class="button contact-us">Book a Table!</a>
                    </div>
                </div>
                <div class="hero-image-wrapper">
                    <img src="images/cinnamoroll1.png" alt="Hero" class="hero-immage-wrapper">
                </div>
            </div>
        </section>

        <!-- about section -->
        <section class="about-section" id="about">
            <div class="section-content">
                <div class="about-image-wrapper">
                    <img src="images/cinnamoroll3.jpg" alt="About" class="about-image">
                </div>
                <div class="about-details">
                    <h2 class="section-title">About Us</h2>
                    <p class="text">CinnaCafe is a warm and inviting spot where the aroma of freshly brewed coffee fills the air and every cup tells a story.
                         With Cinnamoroll themed interiors, soft lighting, and a curated selection of pastries, sandwiches, and specialty drinks, it’s the perfect place to catch up with friends, 
                         get some work done, or simply unwind. Whether you're a coffee connoisseur or a tea lover, our cozy atmosphere and friendly staff will make you feel right at home.
                    <div class="social-link-list">
                        <a href="https://www.facebook.com/share/1PsTKMPGti/" class="social-link"> <i class="fa-brands fa-facebook"></i></a>
                        <a href="https://instagram.com/softsquad_pplg1" class="social-link"> <i class="fa-brands fa-instagram"></i></a>
                        <a href="https://youtube.com/@smknegeri1cirebonofficial472?si=FteGkL4FyH6PqShb" class="social-link"> <i class="fa-brands fa-youtube"></i></a>
                    </div>
                  </p>
                </div>
            </div>
        </section>

        <!-- menu section -->
        <section class="menu-section" id="menu">
            <h2 class="section-title">Our Menu</h2>
            <div class="section-content">
                <ul class="menu-list">
                    <li class="menu-item">
                        <img src="images/hot-beverages.png" alt="Hot Beverages" class="menu-image">
                        <h3 class="name">Hot Beverages</h3>
                        <p class="text">Wide range of Steaming hot coffee to make you fresh and light.</p>
                    </li>
                    <li class="menu-item">
                        <img src="images/cold-beverages.png" alt="Cold Beverages" class="menu-image">
                        <h3 class="name">Cold Beverages</h3>
                        <p class="text">Creamy and frothy cold coffee to make you cool.</p>
                    </li>
                    <li class="menu-item">
                        <img src="images/refreshment.png" alt="Refreshment" class="menu-image">
                        <h3 class="name">Refreshment</h3>
                        <p class="text">Fruit and icy refreshing drink to make feel refresh.</p>
                    </li>
                    <li class="menu-item">
                        <img src="images/special-combo.png" alt="Special Combos" class="menu-image">
                        <h3 class="name">Special Combos</h3>
                        <p class="text">Your favorite food and drink combinations.</p>
                    </li>
                    <li class="menu-item">
                        <img src="images/desserts.png" alt="Dessert" class="menu-image">
                        <h3 class="name">Desserts</h3>
                        <p class="text">Satiate your plate and take you on a culinary treat.</p>
                    </li>
                    <li class="menu-item">
                        <img src="images/burger-frenchfries.png" alt="Burger & French Fries" class="menu-image">
                        <h3 class="name">Burger & French Fries</h3>
                        <p class="text">Quick bites to satisfy your small size hunger.</p>
                    </li>
                </ul>
            </div>
        </section>

        <!-- testimonials section -->
        <section class="testimonials-section" id="testimonials">
            <h2 class="section-title">Testimonials</h2>
            <div class="section-content">
                <div class="slider-container swiper">
                    <div class="slider-wrapper">
                        <ul class="testimonials-list swiper-wrapper">
                            <li class="testimonial swiper-slide">
                                <img src="images/kokomi.jpg" alt="User" class="user-image">
                                <h3 class="name">Kokomi</h3>
                                <i class="feedback">"Loved the French Roast. Perfectly balanced and rich. Will order again!"</i>
                            </li>
                            <li class="testimonial swiper-slide">
                                <img src="images/ganyu.jpg" alt="User" class="user-image">
                                <h3 class="name">Ganyu</h3>
                                <i class="feedback">"Great espresso blend! Smooth and bold flavor. Fast shipping too!"</i>
                            </li>
                            <li class="testimonial swiper-slide">
                                <img src="images/wriothesley.jpg" alt="User" class="user-image">
                                <h3 class="name">Wriothesley</h3>
                                <i class="feedback">"Fantastic mocca flavor. Fresh and aromatic. Quick shipping!"</i>
                            </li>
                            <li class="testimonial swiper-slide">
                                <img src="images/shenhe.jpg" alt="User" class="user-image">
                                <h3 class="name">Shenhe</h3>
                                <i class="feedback">"Excellent quality! Fresh beans and quick delivery. Highly reccomend."</i>
                            </li>
                            <li class="testimonial swiper-slide">
                                <img src="images/ayaka.jpg" alt="User" class="user-image">
                                <h3 class="name">Ayaka</h3>
                                <i class="feedback">"Best decaf i've tried! Smooth and flavorful."</i>
                            </li>
                        </ul> 
 
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev swiper-slide-button"></div>
                        <div class="swiper-button-next swiper-slide-button"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- gallery section -->
        <section class="gallery-section" id="gallery">
            <h2 class="section-title">Gallery</h2>
            <div class="section-content">
                <ul class="gallery-list">
                    <li class="gallery-item">
                        <img src="images/gallery1.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="images/gallery2.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="images/gallery3.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="images/gallery4.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="images/gallery5.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="images/gallery6.jpg" alt="Gallery" class="gallery-image">
                    </li>
                </ul>
            </div>
        </section>

        <!-- contact section -->
        <section class="contact-section" id="contact">
            <h2 class="section-title">Contact Us</h2>
            <div class="section-content">
                <ul class="contact-info-list">
                    <li class="contact-info">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <p>123 Campsite Avenue, Wilderness, CA 98765</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-envelope"></i>
                        <p>info@cinnacafe.com</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-solid fa-phone"></i>
                        <p>(+62) 882-0007-68044</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-clock"></i>
                        <p>Monday - Friday: 9:00 AM - 11:30 PM</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-clock"></i>
                        <p>Saturday: 10:00 AM - 12:00 AM</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-clock"></i>
                        <p>Sunday: Closed</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-solid fa-globe"></i>
                        <p>www.cinnacafe.com</p>
                    </li>
                </ul>

                <form action="#" class="contact-form">
                    <input type="text" placeholder="Your name" class="form-input" required>
                    <input type="email" placeholder="Your email" class="form-input" required>
                    <textarea placeholder="Your message" class="form-input" required></textarea>
                    <button class="submit-button">Submit</button>
                </form>
            </div>
        </section>

        <!-- footer section -->
        <footer class="footer-section">
            <div class="section-content">
                <p class="copyright-text">© 2024 CinnaCafe</p>

                <div class="social-link-list">
                    <a href="https://www.facebook.com/share/1PsTKMPGti/" class="social-link"> <i class="fa-brands fa-facebook"></i></a>
                    <a href="https://instagram.com/softsquad_pplg1" class="social-link"> <i class="fa-brands fa-instagram"></i></a>
                    <a href="https://youtube.com/@smknegeri1cirebonofficial472?si=FteGkL4FyH6PqShb" class="social-link"> <i class="fa-brands fa-youtube"></i></a>
                </div>

                <p class="policy-text">
                    <a href="privacy_policy.php" class="policy-link">Privacy Policy</a>
                    <span class="separator">•</span>
                    <a href="refund_policy.php" class="policy-link">Refund Policy</a>
                </p>
            </div>
        </footer>
    </main>

    <!-- linking swiper script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- linking custom script -->
    <script src="script.js"></script>
</body>
</html
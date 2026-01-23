    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>LPM - Web Solutions</h5>
                    <p>Leading the way in web development and digital innovation. We create exceptional digital experiences that drive business growth and success.</p>
                    <div class="social-icons mt-3">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f">📘</i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter">🐦</i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in">💼</i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram">📷</i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="<?= base_url() ?>#home">Home</a></li>
                        <li><a href="<?= base_url() ?>#about">About</a></li>
                        <li><a href="<?= base_url() ?>#services">Services</a></li>
                        <li><a href="<?= base_url() ?>#portfolio">Portfolio</a></li>
                        <li><a href="<?= base_url() ?>#contact">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Our Services</h5>
                    <ul>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Mobile Applications</a></li>
                        <li><a href="#">E-Commerce Solutions</a></li>
                        <li><a href="#">Cloud Services</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Digital Marketing</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Information</h5>
                    <p>📍 123 Business Street<br>Tech City, TC 12345</p>
                    <p>📞 +1 (555) 123-4567</p>
                    <p>✉️ info@lpmweb.com</p>
                    <p>🌐 www.lpmweb.com</p>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <?= date('Y') ?> LPM Web Solutions. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="me-3">Privacy Policy</a>
                        <a href="#" class="me-3">Terms of Service</a>
                        <a href="#">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Custom JavaScript -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>

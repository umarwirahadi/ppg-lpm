    <!-- Simple Modern Footer -->
    <footer class="footer-gradient">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <span class="footer-logo">
                        <img src="<?= base_url('assets/img/logo.png') ?>" alt="LPM Logo" style="height:64px;width:auto;vertical-align:middle;margin-right:8px;">
                        LPM
                    </span>
                    <span class="footer-desc">Politeknik Piksi Ganesha &copy; <?= date('Y') ?></span>
                </div>
                <nav class="footer-links">
                    <a href="<?= base_url() ?>#home">Home</a>
                    <a href="<?= base_url() ?>#about">About</a>
                    <a href="<?= base_url() ?>#services">Services</a>
                    <a href="<?= base_url() ?>#contact">Contact</a>
                </nav>
                <nav class="footer-links">
                    <span class="footer-link-title">References</span>
                    <a href="https://www.kemdikbud.go.id/" target="_blank" rel="noopener">Kemdikbud</a>
                    <a href="https://banpt.or.id/" target="_blank" rel="noopener">BAN-PT</a>
                    <a href="https://pddikti.kemdikbud.go.id/" target="_blank" rel="noopener">PDDIKTI</a>
                </nav>
                <div class="footer-contact">
                    <span class="footer-link-title">Contact</span>
                    <address>
                        Jl. Jend. Gatot Subroto 301 Bandung 40274<br>
                        Telp: (022) 87340030<br>
                        Email: <a href="mailto:info@lpmweb.com">lpm@piksi.ac.id</a>
                    </address>
                </div>
                <div class="footer-social">
                    <a href="#" title="Facebook" aria-label="Facebook">📘</a>
                    <a href="#" title="Twitter" aria-label="Twitter">🐦</a>
                    <a href="#" title="LinkedIn" aria-label="LinkedIn">💼</a>
                    <a href="#" title="Instagram" aria-label="Instagram">📷</a>
                </div>
            </div>
            <div class="footer-bottom">
                <span>All rights reserved.</span>
                <span class="footer-policy-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms</a>
                </span>
            </div>
        </div>
    </footer>

    <style>
    html, body {
        height: 100%;
        min-height: 100%;
    }
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .footer-gradient {
        background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);
        font-size: 1rem;
        color: #2d225a;
        margin-top: auto;
        border-top: none;
        box-shadow: 0 -2px 16px 0 rgba(160, 140, 209, 0.08);
    }
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem 1rem 1rem;
    }
    .footer-main {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 2.5rem 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.18);
        padding-bottom: 1.2rem;
    }
    .footer-brand {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        min-width: 180px;
    }
    .footer-logo {
        font-weight: 700;
        font-size: 1.5rem;
        color: #6d28d9;
        letter-spacing: 1px;
    }
    .footer-desc {
        font-size: 1rem;
        color: #4b3869;
    }
    .footer-links {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        min-width: 140px;
    }
    .footer-link-title {
        font-weight: 600;
        color: #6d28d9;
        margin-bottom: 0.2rem;
    }
    .footer-links a {
        color: #2d225a;
        text-decoration: none;
        transition: color 0.18s;
        font-size: 1rem;
    }
    .footer-links a:hover {
        color: #a18cd1;
    }
    .footer-contact {
        min-width: 180px;
        font-size: 1rem;
        color: #2d225a;
    }
    .footer-contact address {
        font-style: normal;
        line-height: 1.6;
        color: #2d225a;
    }
    .footer-contact a {
        color: #6d28d9;
        text-decoration: underline;
    }
    .footer-social {
        display: flex;
        gap: 0.7rem;
        font-size: 1.3rem;
        margin-top: 0.5rem;
    }
    .footer-social a {
        color: #4b3869;
        transition: color 0.18s, transform 0.18s;
    }
    .footer-social a:hover {
        color: #a18cd1;
        transform: scale(1.18);
    }
    .footer-bottom {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        padding-top: 1.2rem;
        font-size: 0.97rem;
        color: #4b3869;
    }
    .footer-policy-links a {
        color: #4b3869;
        margin-left: 1.2rem;
        text-decoration: none;
        transition: color 0.18s;
    }
    .footer-policy-links a:hover {
        color: #a18cd1;
    }
    @media (max-width: 900px) {
        .footer-main { flex-direction: column; align-items: flex-start; gap: 1.5rem; }
        .footer-bottom { flex-direction: column; gap: 0.5rem; align-items: flex-start; }
    }
    </style>

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Custom JavaScript -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>

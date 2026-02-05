<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>404 - Page Not Found</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style type="text/css">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.container {
    text-align: center;
    max-width: 600px;
    width: 100%;
}

.error-illustration {
    margin-bottom: 30px;
}

.error-code {
    font-size: clamp(120px, 20vw, 200px);
    font-weight: 700;
    color: rgba(255, 255, 255, 0.15);
    line-height: 1;
    position: relative;
    text-shadow: 
        0 1px 0 #ccc,
        0 2px 0 #c9c9c9,
        0 3px 0 #bbb,
        0 4px 0 #b9b9b9,
        0 5px 0 #aaa,
        0 6px 1px rgba(0,0,0,.1),
        0 0 5px rgba(0,0,0,.1),
        0 1px 3px rgba(0,0,0,.3),
        0 3px 5px rgba(0,0,0,.2),
        0 5px 10px rgba(0,0,0,.25),
        0 10px 10px rgba(0,0,0,.2),
        0 20px 20px rgba(0,0,0,.15);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.error-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 50px 40px;
    box-shadow: 
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.1);
    transform: translateY(-60px);
}

.error-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.error-icon svg {
    width: 40px;
    height: 40px;
    fill: white;
}

h1 {
    color: #1a1a2e;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 15px;
    letter-spacing: -0.5px;
}

.message {
    color: #64748b;
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 30px;
}

.message p {
    margin: 0;
}

.btn-group {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
}

.btn-secondary {
    background: #f1f5f9;
    color: #475569;
}

.btn-secondary:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
}

.decoration {
    position: fixed;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: pulse 4s ease-in-out infinite;
}

.decoration-1 {
    width: 300px;
    height: 300px;
    top: -100px;
    left: -100px;
}

.decoration-2 {
    width: 200px;
    height: 200px;
    bottom: -50px;
    right: -50px;
    animation-delay: 1s;
}

.decoration-3 {
    width: 150px;
    height: 150px;
    top: 50%;
    right: 10%;
    animation-delay: 2s;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.1; }
    50% { transform: scale(1.1); opacity: 0.2; }
}

@media (max-width: 480px) {
    .error-card {
        padding: 35px 25px;
        border-radius: 20px;
    }
    
    h1 {
        font-size: 22px;
    }
    
    .btn {
        padding: 12px 24px;
        font-size: 14px;
        width: 100%;
        justify-content: center;
    }
    
    .btn-group {
        flex-direction: column;
    }
}
</style>
</head>
<body>
    <div class="decoration decoration-1"></div>
    <div class="decoration decoration-2"></div>
    <div class="decoration decoration-3"></div>
    
    <div class="container">
        <div class="error-illustration">
            <div class="error-code">404</div>
        </div>
        
        <div class="error-card">
            <div class="error-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="none"/>
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </div>
            
            <h1><?php echo $heading; ?></h1>
            
            <div class="message">
                <?php echo $message; ?>
            </div>
            
            <?php
            // Build base URL without CI helper
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
            $script_path = dirname($_SERVER['SCRIPT_NAME']);
            $base = $protocol . $host . $script_path;
            $base = rtrim($base, '/') . '/';
            ?>
            
            <div class="btn-group">
                <a href="<?php echo $base; ?>" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    Kembali ke Beranda
                </a>
                <button onclick="history.back()" class="btn btn-secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Halaman Sebelumnya
                </button>
            </div>
        </div>
    </div>
</body>
</html>

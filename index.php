<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">My Portfolio</div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Me</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
        </ul>
    </nav>

    <!-- Home Section -->
    <section id="home" class="hero-section">
        <div class="hero-text">
            <h1>HELLO, I'm <span class="white-text"><?php echo htmlspecialchars($_SESSION['fullname']); ?></span></h1>
            <p class="role-subtitle">Future Web Developer</p>
            <a href="#projects" class="btn-primary-hero">View My Work</a>
        </div>
        <div class="hero-image-container">
            <?php if (!empty($_SESSION['profile_image']) && file_exists('uploads/' . $_SESSION['profile_image'])): ?>
                <img src="uploads/<?php echo htmlspecialchars($_SESSION['profile_image']); ?>" alt="Profile Picture" class="glow-avatar">
            <?php else: ?>
                <img src="uploads/default-avatar.png" alt="Default Avatar" class="glow-avatar">
            <?php endif; ?>
        </div>
    </section>

    <!-- About Me Section -->
    <section id="about" class="section">
        <h2>About <span class="accent-text">Me</span></h2>
        <div class="about-card-main">
            <div class="about-text-content">
                <p class="sub-greeting">Hello, I'm</p>
                <h3><?php echo htmlspecialchars($_SESSION['fullname']); ?></h3>
                <p class="about-desc">
                    Hello! My name is <strong><?php echo htmlspecialchars($_SESSION['fullname']); ?></strong>, currently a second-year BSCS student at Kolehiyo ng Subic. I am passionate about learning programming and web development while continuously improving my skills and understanding of computer science.
                </p>
                <a href="#projects" class="btn-primary-hero">View Projects</a>
            </div>
            <div class="about-image-side">
                <?php if (!empty($_SESSION['profile_image']) && file_exists('uploads/' . $_SESSION['profile_image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($_SESSION['profile_image']); ?>" alt="Profile Picture" class="glow-avatar-small">
                <?php else: ?>
                    <img src="uploads/default-avatar.png" alt="Default Avatar" class="glow-avatar-small">
                <?php endif; ?>
            </div>
        </div>

        <!-- Info Boxes Grid -->
        <div class="info-boxes-grid">
            <div class="info-box">
                <div class="icon-box">📁</div>
                <div class="info-details">
                    <span>TOTAL PROJECTS</span>
                    <h4>3</h4>
                </div>
            </div>
            <div class="info-box">
                <div class="icon-box">🎓</div>
                <div class="info-details">
                    <span>COURSE & SCHOOL</span>
                    <h4>BSCS - KNS</h4>
                </div>
            </div>
            <div class="info-box">
                <div class="icon-box">🌐</div>
                <div class="info-details">
                    <span>EXPERIENCE</span>
                    <h4>Student</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section">
        <h2>My <span class="accent-text">Skills</span></h2>
        <div class="skills-grid">
            <div class="skill-card">HTML</div>
            <div class="skill-card">CSS</div>
            <div class="skill-card">PHP</div>
            <div class="skill-card">MySQL</div>
            <div class="skill-card">Python</div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section">
        <h2><span class="accent-text">Projects</span></h2>
        <div class="projects-grid">
            <div class="project-card">
                <h3>Student Information System</h3>
                <p>Displays student information using PHP variables and HTML/CSS.</p>
                <div class="badge-tags">PHP • HTML • CSS</div>
            </div>
            <div class="project-card">
                <h3>Sign-Up and Sign-In System</h3>
                <p>A basic login and registration system that accepts user input.</p>
                <div class="badge-tags">PHP • HTML • CSS</div>
            </div>
            <div class="project-card">
                <h3>Personal Portfolio Website</h3>
                <p>A personal website showcasing my skills, achievements, and projects.</p>
                <div class="badge-tags">HTML • CSS • PHP • MySQL</div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    
<section id="contact" class="contact-section">
        <div class="contact-left">
            <h2>Contact <span class="accent-text">Me</span></h2>
            <p class="contact-intro">Let's build something great together. Have a project in mind or just want to chat about web tech? I'm always open to discussing new opportunities, creative ideas, or ways to help your vision come to life.</p>
            
            <div class="contact-box-item">
                <div class="contact-icon">📞</div>
                <div>
                    <h4>My Phone</h4>
                    <p>09810346320</p>
                </div>
            </div>

            <div class="contact-box-item">
                <div class="contact-icon">✉️</div>
                <div>
                    <h4>My Email</h4>
                    <p>hannashaneternida4@gmail.com</p>
                </div>
            </div>

            <div class="contact-box-item">
                <div class="contact-icon">🌐</div>
                <div>
                    <h4>My Facebook</h4>
                    <p>Shane ternida</p>
                </div>
            </div>

    </section>
    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 Paul Vincent Baluyo. All rights reserved.</p>
    </footer>
</body>
</html>
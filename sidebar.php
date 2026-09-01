<div class="sidebar">
    <div class="top-logo">
        <img src="images/logo1.jpg" alt="Madhawa Premaratne">
    </div>

    <nav class="nav-menu">
        <ul>
            <?php 
                $page = isset($currentPage) ? trim(strtolower($currentPage)) : ''; 
                $current_filter = isset($_GET['filter']) ? trim(strtolower($_GET['filter'])) : 'all';
            ?>

            <?php if ($page == 'portfolio'): ?>
                <li><a href="index.php">‹ Back</a></li>
                <li><a href="portfolio.php?filter=all" class="<?php echo ($current_filter == 'all' || $current_filter == '') ? 'active' : ''; ?>">Show All</a></li>
                <li><a href="portfolio.php?filter=residential" class="<?php echo ($current_filter == 'residential') ? 'active' : ''; ?>">Residential</a></li>
                <li><a href="portfolio.php?filter=commercial" class="<?php echo ($current_filter == 'commercial') ? 'active' : ''; ?>">Commercial</a></li>
                <li><a href="portfolio.php?filter=leisure" class="<?php echo ($current_filter == 'leisure') ? 'active' : ''; ?>">Leisure</a></li>
                <li><a href="portfolio.php?filter=industrial" class="<?php echo ($current_filter == 'industrial') ? 'active' : ''; ?>">Industrial</a></li>
                <li><a href="portfolio.php?filter=public" class="<?php echo ($current_filter == 'public') ? 'active' : ''; ?>">Public</a></li>

            <?php elseif ($page == 'in-progress' || $page == 'inprogress'): ?>
                <li><a href="index.php">‹ Back</a></li>
                <li><a href="in-progress.php?filter=all" class="<?php echo ($current_filter == 'all' || $current_filter == '') ? 'active' : ''; ?>">Show All</a></li>
                <li><a href="in-progress.php?filter=residential" class="<?php echo ($current_filter == 'residential') ? 'active' : ''; ?>">Residential</a></li>
                <li><a href="in-progress.php?filter=commercial" class="<?php echo ($current_filter == 'commercial') ? 'active' : ''; ?>">Commercial</a></li>
                <li><a href="in-progress.php?filter=industrial" class="<?php echo ($current_filter == 'industrial') ? 'active' : ''; ?>">Industrial</a></li>

            <?php else: ?>
                <li><a href="index.php" class="<?php echo ($page == 'home') ? 'active' : ''; ?>">Home</a></li>
                <li><a href="about.php" class="<?php echo ($page == 'about') ? 'active' : ''; ?>">About Us</a></li>
                <li><a href="portfolio.php">Portfolio ></a></li>
                <li><a href="in-progress.php">In Progress ></a></li>
                <li><a href="contact.php" class="<?php echo ($page == 'contact') ? 'active' : ''; ?>">Contact Us</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="bottom-section">
        <div class="bottom-logo"><img src="images/main_logo.jpg" alt="Design Duo"></div>
        <div class="social-icons">
            <a href="https://www.facebook.com/" target="_blank">f</a>
            <a href="https://www.youtube.com/" target="_blank"><svg width="11" height="11" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></a>
            <a href="https://www.linkedin.com/" target="_blank">in</a>
        </div>
        <p class="sidebar-copyright"><b>&copy; <?php echo date("Y"); ?> Design Duo.All Rights Reserved.</b></p>
    </div>
</div>
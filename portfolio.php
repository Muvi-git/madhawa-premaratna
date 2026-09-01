<?php 

include 'db_config.php'; 


$filter = isset($_GET['filter']) ? trim(strtolower($_GET['filter'])) : 'all';


if ($filter == 'all' || $filter == '') {
    $sql = "SELECT * FROM portfolio_projects ORDER BY id DESC";
} else {
    $safe_filter = $conn->real_escape_string($filter);
    $sql = "SELECT * FROM portfolio_projects WHERE LOWER(category) = '$safe_filter' ORDER BY id DESC";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Portfolio | Design Duo</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
      
        body { margin: 0; padding: 0; background: #ffffff; font-family: Arial, sans-serif; height: 100vh; overflow: hidden; }
        .portfolio-layout-wrapper { display: flex; width: 100%; height: 100vh; }
        
      
        .sidebar-container-box { 
            width: 260px; 
            flex-shrink: 0; 
            height: 100vh; 
            overflow: hidden; 
            border-right: 1px solid #eee;
        }
        
     
        .portfolio-main-content { 
            flex-grow: 1; 
            height: 100vh; 
            overflow-y: auto; 
            padding: 40px 50px; 
            display: flex; 
            flex-direction: column; 
            box-sizing: border-box; 
        }
        
     
        .portfolio-filter-tabs { display: flex; gap: 30px; margin-bottom: 30px; align-items: center; }
        .tab-item-btn { 
            text-decoration: none; 
            color: #555; 
            font-size: 14px; 
            font-weight: bold; 
            padding: 8px 16px; 
            transition: all 0.3s ease;
        }
        .tab-item-btn.active { 
            background-color: #1e293b; 
            color: #ffffff; 
            border-radius: 4px; 
        }
        
        .portfolio-items-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-bottom: 50px; }
        .portfolio-item-card { text-decoration: none; color: inherit; }
        .item-image-holder { width: 100%; height: 280px; background: #f0f0f0; overflow: hidden; position: relative; }
        .item-image-holder img { width: 100%; height: 100%; object-fit: cover; }
        
     
        .portfolio-fixed-footer { margin-top: auto; padding: 20px 0; border-top: 1px solid #e5e8ec; text-align: center; font-size: 11px; color: #666; }
    </style>
</head>
<body>

    <div class="portfolio-layout-wrapper">
        <aside class="sidebar-container-box">
            <?php $currentPage = 'portfolio'; include 'sidebar.php'; ?>
        </aside>

        <main class="portfolio-main-content">
            <div class="portfolio-filter-tabs">
                <a href="portfolio.php?filter=all" class="tab-item-btn <?php echo ($filter == 'all') ? 'active' : ''; ?>">Show All</a>
                <a href="portfolio.php?filter=residential" class="tab-item-btn <?php echo ($filter == 'residential') ? 'active' : ''; ?>">Residential</a>
                <a href="portfolio.php?filter=commercial" class="tab-item-btn <?php echo ($filter == 'commercial') ? 'active' : ''; ?>">Commercial</a>
                <a href="portfolio.php?filter=leisure" class="tab-item-btn <?php echo ($filter == 'leisure') ? 'active' : ''; ?>">Leisure</a>
                <a href="portfolio.php?filter=industrial" class="tab-item-btn <?php echo ($filter == 'industrial') ? 'active' : ''; ?>">Industrial</a>
                <a href="portfolio.php?filter=public" class="tab-item-btn <?php echo ($filter == 'public') ? 'active' : ''; ?>">Public</a>
            </div>

            <div class="portfolio-items-grid">
                <?php 
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $img_src = !empty($row['image']) ? "images/" . htmlspecialchars($row['image']) : "https://via.placeholder.com/600x450";
                ?>
                    <a href="project-detail.php?p=<?php echo htmlspecialchars($row['slug']); ?>" class="portfolio-item-card">
                        <div class="item-image-holder">
                            <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        </div>
                        <h4 style="margin: 15px 0 5px 0;"><?php echo htmlspecialchars($row['title']); ?></h4>
                        <p style="margin: 0; color: #777; font-size: 13px;"><?php echo htmlspecialchars($row['location']); ?></p>
                    </a>
                <?php 
                    }
                } else {
                    echo "<p>No projects found in this category.</p>";
                }
                ?>
            </div>

            <footer class="portfolio-fixed-footer">
                COPYRIGHT © <?php echo date("Y"); ?> Design Duo. All Rights Reserved. Powered by SLT-DIGITAL
            </footer>
        </main>
    </div>

</body>
</html>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_config.php'; 


$filter = isset($_GET['filter']) ? trim(strtolower($_GET['filter'])) : 'all';


if ($filter == 'all' || $filter == '') {
    $sql = "SELECT * FROM inprogress_projects ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM inprogress_projects WHERE category = '$filter' ORDER BY id DESC";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Progress Projects | Design Duo</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .arch-filter-btn {
            background: none !important;
            border: none !important;
            color: #555555 !important;
            font-size: 14px !important;
            font-family: Arial, sans-serif !important;
            cursor: pointer !important;
            padding: 8px 16px !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: inline-block;
        }
        .arch-filter-btn.active {
            background: #1e293b !important;
            color: #ffffff !important;
            border-radius: 4px !important;
            font-weight: bold !important;
        }
        .arch-project-card {
            text-decoration: none !important;
            color: inherit !important;
            display: block !important;
            transition: transform 0.3s ease !important;
        }
        .arch-project-card:hover {
            transform: translateY(-5px) !important;
        }
    </style>
</head>

<body style="margin: 0 !important; padding: 0 !important; background-color: #ffffff !important; font-family: Arial, sans-serif !important;">

    <div style="display: flex !important; width: 100vw !important; min-height: 100vh !important; overflow-x: hidden !important; align-items: flex-start !important; justify-content: flex-start !important; box-sizing: border-box !important;">
        
        <div style="width: 260px !important; flex-shrink: 0 !important; min-height: 100vh !important; background: #ffffff !important; box-sizing: border-box !important;">
            <?php 
            $currentPage = 'inprogress'; 
            include 'sidebar.php'; 
            ?>
        </div>

        <div style="flex-grow: 1 !important; min-width: 0 !important; height: 100vh !important; overflow-y: auto !important; display: flex !important; flex-direction: column !important; background: #ffffff !important; box-sizing: border-box !important;">
            
            <div style="display: flex !important; gap: 15px !important; padding: 35px 50px 20px 50px !important; background: #ffffff !important; align-items: center !important;">
                <a href="in-progress.php?filter=all" class="arch-filter-btn <?php echo ($filter == 'all') ? 'active' : ''; ?>">Show All</a>
                <a href="in-progress.php?filter=residential" class="arch-filter-btn <?php echo ($filter == 'residential') ? 'active' : ''; ?>">Residential</a>
                <a href="in-progress.php?filter=commercial" class="arch-filter-btn <?php echo ($filter == 'commercial') ? 'active' : ''; ?>">Commercial</a>
                <a href="in-progress.php?filter=industrial" class="arch-filter-btn <?php echo ($filter == 'industrial') ? 'active' : ''; ?>">Industrial</a>
            </div>

            <div style="display: grid !important; grid-template-columns: repeat(3, 1fr) !important; gap: 30px !important; padding: 20px 50px 45px 50px !important; background: #ffffff !important; box-sizing: border-box !important;">
                
                <?php 
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $img_file = !empty($row['image']) ? trim($row['image']) : '';
                        $img_src = !empty($img_file) ? "images/" . htmlspecialchars($img_file) : "https://via.placeholder.com/600x450?text=" . urlencode($row['title']);
                        ?>
                        
                        <a href="in-progress-detail.php?p=<?php echo htmlspecialchars($row['slug']); ?>" class="arch-project-card">
                            <div style="width: 100% !important; height: 280px !important; background: #f0f0f0 !important; overflow: hidden !important; border-radius: 2px !important;">
                                <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" style="width: 100% !important; height: 100% !important; object-fit: cover !important;" onerror="this.src='https://via.placeholder.com/600x450?text=Image+Not+Found';">
                            </div>
                            <h4 style="font-size: 15px !important; font-weight: bold !important; color: #111111 !important; margin: 15px 0 0 0 !important; font-family: Arial, sans-serif !important; text-transform: capitalize !important;">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </h4>
                        </a>

                        <?php 
                    }
                } else {
                    echo "<p style='grid-column: span 3 !important; font-size: 14px !important; color: #777777 !important; font-family: Arial, sans-serif !important;'>No in-progress projects found.</p>";
                }
                ?>
            </div>

            <footer style="margin-top: auto !important; background-color: #f0f2f5 !important; padding: 22px 50px !important; border-top: 1px solid #e5e8ec !important; text-align: center !important; box-sizing: border-box !important;">
                <p style="font-size: 11px !important; color: #666666 !important; margin: 0 !important; letter-spacing: 0.5px !important; font-family: Arial, sans-serif !important;"><b><strong>COPYRIGHT ©</strong></b> <?php echo date("Y"); ?> Design Duo. All Rights Reserved. Powered by SLT-DIGITAL</p>
            </footer>

        </div>
    </div>
</body>
</html>
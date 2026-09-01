<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_config.php'; 

$project = null;
$next_slug = '#';
$prev_slug = '#'; 
$current_table = 'portfolio_projects'; 

if (isset($_GET['p'])) {
    $slug = $conn->real_escape_string($_GET['p']);
    
  
    $sql = "SELECT * FROM portfolio_projects WHERE slug = '$slug' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $project = $result->fetch_assoc();
        $current_table = 'portfolio_projects';
    } else {
    
        $sql = "SELECT * FROM inprogress_projects WHERE slug = '$slug' LIMIT 1";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $project = $result->fetch_assoc();
            $current_table = 'inprogress_projects';
        }
    }
    

    if ($project) {
        $current_id = $project['id'];
        
       
        $next_sql = "SELECT slug FROM $current_table WHERE id > $current_id ORDER BY id ASC LIMIT 1";
        $next_result = $conn->query($next_sql);
        
        if ($next_result && $next_result->num_rows > 0) {
            $next_project = $next_result->fetch_assoc();
            $next_slug = $next_project['slug'];
        } else {
            $first_sql = "SELECT slug FROM $current_table ORDER BY id ASC LIMIT 1";
            $first_result = $conn->query($first_sql);
            if($first_result && $first_result->num_rows > 0) {
                $first_project = $first_result->fetch_assoc();
                $next_slug = $first_project['slug'];
            }
        }

      
        $prev_sql = "SELECT slug FROM $current_table WHERE id < $current_id ORDER BY id DESC LIMIT 1";
        $prev_result = $conn->query($prev_sql);
        
        if ($prev_result && $prev_result->num_rows > 0) {
            $prev_project = $prev_result->fetch_assoc();
            $prev_slug = $prev_project['slug'];
        } else {
            $last_sql = "SELECT slug FROM $current_table ORDER BY id DESC LIMIT 1";
            $last_result = $conn->query($last_sql);
            if($last_result && $last_result->num_rows > 0) {
                $last_project = $last_result->fetch_assoc();
                $prev_slug = $last_project['slug'];
            }
        }
    }
}

if (!$project) {
    header("Location: portfolio.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['title']); ?> | Design Duo</title>
    <link rel="stylesheet" href="style.css">
</head>






<body style="margin: 0 !important; padding: 0 !important; background-color: #ffffff !important; font-family: Arial, sans-serif !important;">




    <div style="display: flex !important; width: 100vw !important; min-height: 100vh !important; overflow-x: hidden !important; align-items: flex-start !important; justify-content: flex-start !important; box-sizing: border-box !important;">
        
        <div style="width: 260px !important; flex-shrink: 0 !important; min-height: 100vh !important; background: #ffffff !important; box-sizing: border-box !important;">
            <?php 
         
            $currentPage = ($current_table === 'inprogress_projects') ? 'inprogress' : 'portfolio'; 
            include 'sidebar.php'; 
            ?>
        </div>

        <div style="flex-grow: 1 !important; min-width: 0 !important; display: flex !important; flex-direction: column !important; background: #ffffff !important; box-sizing: border-box !important;">
            
            <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 35px 50px !important; background-color: #f5f5f5 !important; border-bottom: 1px solid #eaeaea !important; position: relative !important; box-sizing: border-box !important;">
                
                <?php if(isset($prev_slug) && $prev_slug !== '#'): ?>
                    <a href="project-detail.php?p=<?php echo $prev_slug; ?>" style="font-size: 12px !important; font-weight: bold !important; color: #333333 !important; text-decoration: none !important; letter-spacing: 0.5px !important; text-transform: uppercase !important; font-family: Arial, sans-serif !important; position: absolute !important; left: 50px !important;">
                        ◀ PREVIOUS PROJECT
                    </a>
                <?php else: ?>
                    <a href="portfolio.php" style="font-size: 12px !important; font-weight: bold !important; color: #333333 !important; text-decoration: none !important; letter-spacing: 0.5px !important; text-transform: uppercase !important; font-family: Arial, sans-serif !important; position: absolute !important; left: 50px !important;">◀ BACK TO PORTFOLIO</a>
                <?php endif; ?>

                <h1 style="font-size: 32px !important; font-weight: bold !important; color: #111111 !important; margin: 0 auto !important; text-align: center !important; flex-grow: 1 !important; font-family: Arial, sans-serif !important; text-transform: uppercase !important; letter-spacing: 0.5px !important;"><?php echo htmlspecialchars($project['title']); ?></h1>
                
                <?php if($next_slug !== '#'): ?>
                    <a href="project-detail.php?p=<?php echo $next_slug; ?>" style="font-size: 12px !important; font-weight: bold !important; color: #333333 !important; text-decoration: none !important; letter-spacing: 0.5px !important; text-transform: uppercase !important; font-family: Arial, sans-serif !important; position: absolute !important; right: 50px !important;">
                        NEXT PROJECT ▶
                    </a>
                <?php else: ?>
                    <a href="portfolio.php" style="font-size: 12px !important; font-weight: bold !important; color: #333333 !important; text-decoration: none !important; letter-spacing: 0.5px !important; text-transform: uppercase !important; font-family: Arial, sans-serif !important; position: absolute !important; right: 50px !important;">BACK TO PORTFOLIO ▶</a>
                <?php endif; ?>
            </div>

            <div style="display: grid !important; grid-template-columns: repeat(4, 1fr) !important; padding: 25px 50px !important; background: #ffffff !important; border-bottom: 1px solid #eeeeee !important; box-sizing: border-box !important; gap: 15px !important;">
                <div style="font-size: 13px !important; font-family: Arial, sans-serif !important;">
                    <span style="color: #000000 !important; font-weight: bold !important; margin-right: 5px !important;">CLIENT :</span>
                    <span style="color: #555555 !important;"><?php echo htmlspecialchars($project['client']); ?></span>
                </div>
                <div style="font-size: 13px !important; font-family: Arial, sans-serif !important;">
                    <span style="color: #000000 !important; font-weight: bold !important; margin-right: 5px !important;">LOCATION :</span>
                    <span style="color: #555555 !important;"><?php echo htmlspecialchars($project['location']); ?></span>
                </div>
                <div style="font-size: 13px !important; font-family: Arial, sans-serif !important;">
                    <span style="color: #000000 !important; font-weight: bold !important; margin-right: 5px !important;">AREA :</span>
                    <span style="color: #555555 !important;"><?php echo htmlspecialchars($project['area']); ?></span>
                </div>
                <div style="font-size: 13px !important; font-family: Arial, sans-serif !important;">
                    <span style="color: #000000 !important; font-weight: bold !important; margin-right: 5px !important;">COMPLETION :</span>
                    <span style="color: #555555 !important;"><?php echo isset($project['completed_year']) ? htmlspecialchars($project['completed_year']) : 'In Progress'; ?></span>
                </div>
            </div>

            <div style="position: relative !important; width: 100% !important; height: 530px !important; background: #fafafa !important; overflow: hidden !important; box-sizing: border-box !important;">
                <div style="width: 100% !important; height: 100% !important; position: relative !important;">
                    <?php 
                    $all_slides = [];
                    if (!empty($project['image'])) {
                        $all_slides[] = trim($project['image']);
                    }
                    if(!empty($project['slider_images'])) {
                        $img_parts = explode(',', $project['slider_images']);
                        foreach ($img_parts as $part) {
                            $part_trim = trim($part);
                            if (!empty($part_trim) && !in_array($part_trim, $all_slides)) {
                                $all_slides[] = $part_trim;
                            }
                        }
                    }

                  
                    if (empty($all_slides)) {
                        $all_slides[] = "https://via.placeholder.com/1200x600?text=No+Project+Images+Available";
                        $is_placeholder = true;
                    } else {
                        $is_placeholder = false;
                    }

                    foreach ($all_slides as $i => $s_img) {
                        $active_class = ($i === 0) ? 'display: block !important; opacity: 1 !important;' : 'display: none !important; opacity: 0 !important;';
                        echo "<div class='arch-custom-slide' data-index='" . $i . "' style='position: absolute !important; top: 0 !important; left: 0 !important; width: 100% !important; height: 100% !important; transition: opacity 0.4s ease-in-out !important; " . $active_class . "'>";
                        
                        $img_src = ($is_placeholder) ? $s_img : "images/" . htmlspecialchars($s_img);
                        echo "<img src='" . $img_src . "' alt='Project Image' style='width: 100% !important; height: 100% !important; object-fit: cover !important;' onerror=\"this.src='https://via.placeholder.com/1200x600?text=Image+Not+Found';\">";
                        echo "</div>";
                    }
                    ?>
                </div>

                <?php if(count($all_slides) > 1): ?>
                    <button onclick="changeSlide(-1)" style="position: absolute !important; top: 50% !important; transform: translateY(-50%) !important; left: 20px !important; background: rgba(0, 0, 0, 0.4) !important; color: #ffffff !important; border: none !important; font-size: 24px !important; padding: 12px 16px !important; cursor: pointer !important; z-index: 10 !important; border-radius: 4px !important;">«</button>
                    <button onclick="changeSlide(1)" style="position: absolute !important; top: 50% !important; transform: translateY(-50%) !important; right: 20px !important; background: rgba(0, 0, 0, 0.4) !important; color: #ffffff !important; border: none !important; font-size: 24px !important; padding: 12px 16px !important; cursor: pointer !important; z-index: 10 !important; border-radius: 4px !important;">»</button>
                    
                    <div style="position: absolute !important; bottom: 20px !important; width: 100% !important; display: flex !important; justify-content: center !important; gap: 10px !important; z-index: 11 !important;">
                        <?php 
                        foreach ($all_slides as $i => $s_img) {
                            $bg_dot = ($i === 0) ? '#000000' : 'rgba(255, 255, 255, 0.6)';
                            echo "<span class='arch-dot-bullet' data-dot-idx='" . $i . "' onclick='goToSlide(" . $i . ")' style='width: 10px !important; height: 10px !important; background: " . $bg_dot . " !important; border: 1px solid rgba(0, 0, 0, 0.3) !important; border-radius: 50% !important; cursor: pointer !important; display: inline-block !important;'></span>";
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <div style="padding: 45px 50px !important; background: #ffffff !important; box-sizing: border-box !important;">
                <h3 style="font-size: 18px !important; color: #111111 !important; margin: 0 0 15px 0 !important; font-weight: bold !important; text-transform: uppercase !important; letter-spacing: 0.5px !important; font-family: Arial, sans-serif !important;">Project Description</h3>
                <p style="font-size: 14px !important; color: #444444 !important; line-height: 1.8 !important; margin: 0 !important; font-family: Arial, sans-serif !important;"><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
            </div>

            <footer style="margin-top: auto !important; background-color: #f0f2f5 !important; padding: 22px 50px !important; border-top: 1px solid #e5e8ec !important; text-align: center !important; box-sizing: border-box !important;">
                <p style="font-size: 11px !important; color: #666666 !important; margin: 0 !important; letter-spacing: 0.5px !important; font-family: Arial, sans-serif !important;"><b><strong>COPYRIGHT ©</strong></b> <?php echo date("Y"); ?> Design Duo. All Rights Reserved. Powered by SLT-DIGITAL</p>
            </footer>

        </div>
    </div>

<script>
    let currentSlideIdx = 0;
    const slides = document.querySelectorAll('.arch-custom-slide');
    const dots = document.querySelectorAll('.arch-dot-bullet');
    let autoScrollTimer;

    function updateSliderDisplay() {
       
        if(slides.length === 0) return;
        
        slides.forEach((s, idx) => {
            s.style.setProperty('display', 'none', 'important');
            s.style.setProperty('opacity', '0', 'important');
        });
        dots.forEach(d => {
            d.style.setProperty('background', 'rgba(255, 255, 255, 0.6)', 'important');
        });

        const activeSlide = document.querySelector(`.arch-custom-slide[data-index='${currentSlideIdx}']`);
        if(activeSlide) {
            activeSlide.style.setProperty('display', 'block', 'important');
            setTimeout(() => {
                activeSlide.style.setProperty('opacity', '1', 'important');
            }, 10);
        }
        
        const activeDot = document.querySelector(`.arch-dot-bullet[data-dot-idx='${currentSlideIdx}']`);
        if(activeDot) {
            activeDot.style.setProperty('background', '#000000', 'important');
        }
    }

    function changeSlide(step) {
        if(slides.length <= 1) return;
        currentSlideIdx += step;
        if (currentSlideIdx >= slides.length) { currentSlideIdx = 0; }
        if (currentSlideIdx < 0) { currentSlideIdx = slides.length - 1; }
        updateSliderDisplay();
        resetAutoScroll();
    }

    function goToSlide(idx) {
        currentSlideIdx = idx;
        updateSliderDisplay();
        resetAutoScroll();
    }

    function startAutoScroll() {
        if(slides.length <= 1) return;
        autoScrollTimer = setInterval(() => {
            currentSlideIdx++;
            if (currentSlideIdx >= slides.length) { currentSlideIdx = 0; }
            updateSliderDisplay();
        }, 4000);
    }

    function resetAutoScroll() {
        clearInterval(autoScrollTimer);
        startAutoScroll();
    }

    updateSliderDisplay();
    startAutoScroll();
</script>
</body>
</html>
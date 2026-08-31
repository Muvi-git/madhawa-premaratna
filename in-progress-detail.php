<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_config.php'; 

$project = null;
$next_slug = '#';
$prev_slug = '#'; 

if (isset($_GET['p'])) {
    $slug = $conn->real_escape_string($_GET['p']);
    
 
    $sql = "SELECT * FROM inprogress_projects WHERE slug = '$slug' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $project = $result->fetch_assoc();
    }
    
    if ($project) {
        $current_id = $project['id'];
        
        // NEXT PROJECT LOGIC
        $next_sql = "SELECT slug FROM inprogress_projects WHERE id > $current_id ORDER BY id ASC LIMIT 1";
        $next_result = $conn->query($next_sql);
        
        if ($next_result && $next_result->num_rows > 0) {
            $next_project = $next_result->fetch_assoc();
            $next_slug = $next_project['slug'];
        } else {
            $first_sql = "SELECT slug FROM inprogress_projects ORDER BY id ASC LIMIT 1";
            $first_result = $conn->query($first_sql);
            if($first_result && $first_result->num_rows > 0) {
                $first_project = $first_result->fetch_assoc();
                $next_slug = $first_project['slug'];
            }
        }

        // PREVIOUS PROJECT LOGIC
        $prev_sql = "SELECT slug FROM inprogress_projects WHERE id < $current_id ORDER BY id DESC LIMIT 1";
        $prev_result = $conn->query($prev_sql);
        
        if ($prev_result && $prev_result->num_rows > 0) {
            $prev_project = $prev_result->fetch_assoc();
            $prev_slug = $prev_project['slug'];
        } else {
            $last_sql = "SELECT slug FROM inprogress_projects ORDER BY id DESC LIMIT 1";
            $last_result = $conn->query($last_sql);
            if($last_result && $last_result->num_rows > 0) {
                $last_project = $last_result->fetch_assoc();
                $prev_slug = $last_project['slug'];
            }
        }
    }
}

if (!$project) {
    header("Location: in-progress.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['title']); ?> | In Progress</title>
    <link rel="stylesheet" href="style.css">
    <style>
   
        .arch-fade-slide {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out !important;
            z-index: 1;
        }
        .arch-fade-slide.active {
            opacity: 1 !important;
            visibility: visible !important;
            z-index: 2;
        }
     
        .slider-nav-btn {
            position: absolute !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            background: rgba(0, 0, 0, 0.15) !important;
            color: #ffffff !important;
            border: none !important;
            font-size: 24px !important;
            padding: 12px 16px !important;
            cursor: pointer !important;
            z-index: 10 !important;
            transition: background 0.3s ease !important;
        }
        .slider-nav-btn:hover {
            background: rgba(0, 0, 0, 0.6) !important;
        }
    </style>
</head>






<body style="margin: 0 !important; padding: 0 !important; background-color: #ffffff !important; font-family: Arial, sans-serif !important; height: 100vh !important; overflow: hidden !important;">





    <div style="display: flex !important; width: 100vw !important; height: 100vh !important; overflow: hidden !important; align-items: flex-start !important; justify-content: flex-start !important; box-sizing: border-box !important;">
        
        <div style="width: 260px !important; flex-shrink: 0 !important; height: 100vh !important; background: #ffffff !important; box-sizing: border-box !important; border-right: 1px solid #f0f0f0 !important;">
            <?php 
            $currentPage = 'inprogress'; 
            include 'sidebar.php'; 
            ?>
        </div>

        <div style="flex-grow: 1 !important; min-width: 0 !important; height: 100vh !important; display: flex !important; flex-direction: column !important; background: #ffffff !important; box-sizing: border-box !important;">
            
            <div style="padding: 20px 30px !important; box-sizing: border-box !important; flex-shrink: 0 !important;">
                <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 20px 40px !important; height: 75px !important; background-color: #f5f5f7 !important; border-radius: 4px !important; box-sizing: border-box !important; border: 1px solid #eef0f2 !important;">
                    
                    <?php if($prev_slug !== '#'): ?>
                        <a href="in-progress-detail.php?p=<?php echo $prev_slug; ?>" style="font-size: 11px !important; font-weight: bold !important; color: #777777 !important; text-decoration: none !important; letter-spacing: 1px !important; text-transform: uppercase; font-family: Arial, sans-serif !important; display: flex !important; align-items: center !important; gap: 8px !important;">
                            <span style="font-size: 14px !important;">◀</span> PREVIOUS PROJECT
                        </a>
                    <?php else: ?>
                        <div style="width: 130px;"></div>
                    <?php endif; ?>

                    <h1 style="font-size: 30px !important; font-weight: bold !important; color: #111111 !important; margin: 0 !important; text-align: center !important; font-family: Arial, sans-serif !important; letter-spacing: -0.5px !important;">Our Projects</h1>
                    
                    <?php if($next_slug !== '#'): ?>
                        <a href="in-progress-detail.php?p=<?php echo $next_slug; ?>" style="font-size: 11px !important; font-weight: bold !important; color: #777777 !important; text-decoration: none !important; letter-spacing: 1px !important; text-transform: uppercase; font-family: Arial, sans-serif !important; display: flex !important; align-items: center !important; gap: 8px !important;">
                            NEXT PROJECT <span style="font-size: 14px !important;">▶</span>
                        </a>
                    <?php else: ?>
                        <div style="width: 130px;"></div>
                    <?php endif; ?>
                </div>
            </div>

            <div style="flex-grow: 1 !important; display: grid !important; grid-template-columns: 1.25fr 1fr !important; gap: 50px !important; padding: 0 50px !important; background: #ffffff !important; box-sizing: border-box !important; align-items: center !important; justify-content: center !important; overflow: hidden !important;">
                
                <div style="position: relative !important; width: 100% !important; height: 75% !important; max-height: 440px !important; background: #fbfbfb !important; overflow: hidden !important; border: 1px solid #eeeeee !important; box-sizing: border-box !important; border-radius: 3px !important;">
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
                            $all_slides[] = "https://via.placeholder.com/800x550?text=Design+Duo+Image+Coming+Soon";
                            $is_placeholder = true;
                        } else {
                            $is_placeholder = false;
                        }

                        foreach ($all_slides as $i => $s_img) {
                            $active_class = ($i === 0) ? 'active' : '';
                            echo "<div class='arch-fade-slide " . $active_class . "' data-index='" . $i . "'>";
                            $img_src = ($is_placeholder) ? $s_img : "images/" . htmlspecialchars($s_img);
                            echo "<img src='" . $img_src . "' alt='In Progress Gallery' style='width: 100% !important; height: 100% !important; object-fit: cover !important;' onerror=\"this.src='https://via.placeholder.com/800x550?text=Image+Not+Found';\">";
                            echo "</div>";
                        }
                        ?>
                    </div>

                    <?php if(count($all_slides) > 1): ?>
                        <button onclick="changeSlide(-1)" class="slider-nav-btn" style="left: 0 !important; border-radius: 0 4px 4px 0 !important;">‹</button>
                        <button onclick="changeSlide(1)" class="slider-nav-btn" style="right: 0 !important; border-radius: 4px 0 0 4px !important;">›</button>
                    <?php endif; ?>
                </div>

                <div style="display: flex !important; flex-direction: column !important; justify-content: center !important; height: 75% !important; max-height: 440px !important; box-sizing: border-box !important; padding-right: 20px !important;">
                    <h3 style="font-size: 22px !important; color: #111111 !important; margin: 0 0 18px 0 !important; font-weight: bold !important; font-family: Arial, sans-serif !important; letter-spacing: -0.3px !important;">
                        Project <span style="font-weight: normal !important; color: #666666 !important;">Description</span>
                    </h3>
                    <p style="font-size: 14.5px !important; color: #444444 !important; line-height: 1.8 !important; margin: 0 !important; font-family: Arial, sans-serif !important; text-align: justify !important;">
                        <?php echo nl2br(htmlspecialchars($project['description'])); ?>
                    </p>
                </div>

            </div>

            <footer style="background-color: #f0f2f5 !important; padding: 20px 50px !important; border-top: 1px solid #e5e8ec !important; text-align: center !important; box-sizing: border-box !important; flex-shrink: 0 !important; height: 60px !important;">
                <p style="font-size: 11px !important; color: #666666 !important; margin: 0 !important; letter-spacing: 0.5px !important; font-family: Arial, sans-serif !important;"><b><strong>COPYRIGHT ©</strong></b> <?php echo date("Y"); ?> Design Duo. All Rights Reserved. Powered by SLT-DIGITAL</p>
            </footer>

        </div>
    </div>

<script>
    let currentSlideIdx = 0;
    const slides = document.querySelectorAll('.arch-fade-slide');
    let autoScrollTimer;

    function updateSliderDisplay() {
        if(slides.length === 0) return;
        
        slides.forEach((s) => {
            s.classList.remove('active');
        });

        const activeSlide = document.querySelector(`.arch-fade-slide[data-index='${currentSlideIdx}']`);
        if(activeSlide) {
            activeSlide.classList.add('active');
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
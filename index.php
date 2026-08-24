<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Home | Design Duo (Pvt) Ltd</title>
    <link rel="stylesheet" href="style.css">
</head>

<div class="preloader" id="preloader">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
</div>
<script>
  
    window.addEventListener('load', function () {
        const preloader = document.getElementById('preloader');
        

        if (preloader) {
            preloader.classList.add('fade-out');
        }
    });
</script>





<script>
  
    window.addEventListener('load', function () {
        const preloader = document.getElementById('preloader');
        

        if (preloader) {
            preloader.classList.add('fade-out');
        }
    });
</script>


<body>



    <?php 
    $currentPage = 'home'; 
    include 'sidebar.php'; 
    ?>

    <div class="main-content">
        
        <div class="slider-area">
            <div class="slider-images">
                <?php
                for ($i = 1; $i <= 8; $i++) {
                    $activeClass = ($i === 1) ? 'active' : '';
                    echo '<img src="images/' . $i . '.jpg" alt="Slide ' . $i . '" class="slider-image ' . $activeClass . '">';
                }
                ?>
                <div class="right-arrow">&rsaquo;</div>
            </div>

            <div class="slider-dots">
                <?php
                for ($i = 1; $i <= 8; $i++) {
                    $activeDot = ($i === 1) ? 'active' : '';
                    echo '<div class="dot ' . $activeDot . '" data-index="' . ($i - 1) . '"></div>';
                }
                ?>
            </div>
        </div>

        <div class="home-info-section">
            <h2>Home</h2>
            <p>Design duo predominately specialise in residential architecture, but is increasingly taking on community and commercial projects, with a special interest in eco-friendly boutique hotels. Our current projects are in different range in scale and proximity. We work locally and our architecture have an impact on improving the social life of local community.</p>
        </div>

        <div class="main-footer">
            <p><strong>COPYRIGHT</strong> &copy; <?php echo date("Y"); ?> Design Duo. All Rights Reserved. Powered by SLT-DIGITAL</p>
        </div>

    </div>
    

    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll('.slider-image');
        const dots = document.querySelectorAll('.dot');
        const totalImages = images.length;
        const scrollSpeed = 4000;

        function changeSlide(index) {
            images.forEach(img => img.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            images[index].classList.add('active');
            dots[index].classList.add('active');
            currentIndex = index;
        }

        function nextSlide() {
            let nextIndex = (currentIndex + 1) % totalImages;
            changeSlide(nextIndex);
        }

        let autoScrollTimer = setInterval(nextSlide, scrollSpeed);

        document.querySelector('.right-arrow').addEventListener('click', () => {
            nextSlide();
            resetTimer();
        });

        dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                let clickedIndex = parseInt(e.target.getAttribute('data-index'));
                changeSlide(clickedIndex);
                resetTimer();
            });
        });

        function resetTimer() {
            clearInterval(autoScrollTimer);
            autoScrollTimer = setInterval(nextSlide, scrollSpeed);
        }
    </script>

</body>
</html>
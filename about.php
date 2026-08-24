<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Design Duo (Pvt) Ltd</title>
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


<body>



    <?php 
    $currentPage = 'about'; 
    include 'sidebar.php'; 
    ?>

    <div class="main-content">
        
        <div class="about-text-section">
            <h2>We Love What We Do</h2>
            <div class="about-content">
                <p>Design duo is an architecture firm based on Colombo, Srilanka headed by Archt.Madhawa Premaratne. We thrive on design challenges and are known for producing climatic responsive, highly resolved architecture for different client categories.</p>
                <p>Building up close relationships with clientele, understanding their aspirations, offering personal attention towards each individual client’s problems and give them environment friendly, cost effective, innovative design solutions which will create positive influences on their life styles.</p>
                <p>Design duo predominately specialise in residential architecture, but is increasingly taking on community and commercial projects, with a special interest in eco-friendly boutique hotels. Our current projects are in different range in scale and proximity. We work locally and our architecture have an impact on improving the social life of local community.</p>
                <p>At the core of our ethos and aesthetic is simplicity; our buildings are functional, beautiful, sustainable and engaged. Award winning and widely published design duo, values our strong reputation for both architecture and professional integrity spanning over several decades.</p>
            </div>
        </div>

        <div class="about-gallery-section">
            <button class="gallery-btn prev" id="btn-prev">&lsaquo;</button>
            
            <div class="about-gallery-container">
                <div class="about-gallery-track" id="gallery-track">
                    <?php
                    for ($i = 1; $i <= 7; $i++) {
                        echo '<img src="images/' . $i . '.jpg" alt="Architecture Project ' . $i . '">';
                    }
                    ?>
                </div>
            </div>

            <button class="gallery-btn next" id="btn-next">&rsaquo;</button>
        </div>

        <div class="main-footer">
            <p><strong>COPYRIGHT</strong> &copy; <?php echo date("Y"); ?> Design Duo. All Rights Reserved. Powered by SLT-DIGITAL</p>
        </div>

    </div>

    <script>
        const track = document.getElementById('gallery-track');
        const prevBtn = document.getElementById('btn-prev');
        const nextBtn = document.getElementById('btn-next');
        const totalItems = 7; 
        const itemsPerView = 5; 
        const maxScrollIndex = totalItems - itemsPerView; 
        let galleryIndex = 0;
        const scrollSpeed = 3000;

        function updateGalleryPosition() {
            let percentage = (galleryIndex * 20);
            track.style.transform = `translateX(-${percentage}%)`;
        }

        function nextSlide() {
            if (galleryIndex < maxScrollIndex) {
                galleryIndex++;
            } else {
                galleryIndex = 0; 
            }
            updateGalleryPosition();
        }

        function prevSlide() {
            if (galleryIndex > 0) {
                galleryIndex--;
            } else {
                galleryIndex = maxScrollIndex; 
            }
            updateGalleryPosition();
        }

        let autoScrollTimer = setInterval(nextSlide, scrollSpeed);

        function resetTimer() {
            clearInterval(autoScrollTimer);
            autoScrollTimer = setInterval(nextSlide, scrollSpeed);
        }

        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetTimer();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetTimer();
        });
    </script>

</body>
</html>
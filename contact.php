<?php
$statusMessage = "";
$statusClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_config.php';

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            $statusMessage = "Your message has been sent successfully!";
            $statusClass = "alert-success";
        } else {
            $statusMessage = "Error: Unable to submit your message.";
            $statusClass = "alert-error";
        }
    } else {
        $statusMessage = "All fields are required.";
        $statusClass = "alert-error";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Design Duo (Pvt) Ltd</title>
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
    $currentPage = 'contact'; 
    include 'sidebar.php'; 
    ?>

    <div class="main-content">
        
        <div class="contact-section">
            <h2>Feel Free To Contact us</h2>
            
            <?php if (!empty($statusMessage)): ?>
                <div class="alert-message <?php echo $statusClass; ?>">
                    <?php echo $statusMessage; ?>
                </div>
            <?php endif; ?>

            <div class="contact-grid">
                
                <div class="contact-left">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.962773413819!2d79.95759909999999!3d6.8950091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae257218671424b%3A0x67394d1b712c9bf!2sDesign%20Duo%20(Pvt)%20Ltd!5e0!3m2!1sen!2slk!4v1719999999999!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="contact-details">
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            <span>Gonawatte Rd, Malabe</span>
                        </div>
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                            <span>0112 762 359 / 0777 311 185</span>
                        </div>
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            <span>designduo4u@gmail.com</span>
                        </div>
                    </div>
                </div>

                <div class="contact-right">
                    <p class="contact-description">Design duo is an architecture firm based on Colombo, Srilanka headed by Archt.Madhawa Premaratne. We thrive on design challenges and are known for producing climatic responsive, highly resolved architecture for different client categories.</p>
                    
                    <form action="contact.php" method="POST" class="contact-form">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your E-Mail" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Message" required></textarea>
                        </div>
                        <div class="submit-btn-container">
                            <button type="submit" class="submit-btn">Send Message</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="main-footer">
            <p><strong>COPYRIGHT</strong> &copy; <?php echo date("Y"); ?> Design Duo. All Rights Reserved. Powered by SLT-DIGITAL</p>
        </div>

    </div>

</body>
</html>
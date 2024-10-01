<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contactUs.css">
   
</head>
<body>


    <div class="nav-bar-container">
        <div class="main-logo">ExamCore</div>
        <div class="navigation-bar">
          <ul>
            <a href="../../../homePage.html"><li>Home</li></a>
            <a href="./aboutUs.html"><li>About</li></a>
            <a href="./SupportPage.html"
              ><li>Support</li></a
            >
            <a href="#"
              ><li>Contact Us</li></a
            >
          </ul>
        </div>
      </div>

      <header>
        <h1>Contact Us</h1>
    </header>

    <div class="container">
        <!-- Left Section: Contact Details -->
        <div class="contact-details">
            
            <img src="../../Images/client.png" width="300px" height="300px"/>
            <p><strong>Email:</strong><i>ExamCore@gmail.com</i></p>
            <p><strong>Phone:</strong> +94 71 1111 122/123</p>
            <p><strong>Address:</strong> 123 Rajagiriya, Colombo, Sri Lanka</p>
        </div>

        <!-- Right Section: Contact Form -->
        <div class="contact-form">
            <h2>Send Us a Message</h2>

            <form id="contact-form" action="contactUs_insert.php" method="POST">

                <label for="name">Name:</label>
                <input type="text"  name="name" placeholder="Mr/Mrs/miss" required>
                 <br>
                <label for="phone">Phone Number:</label>
                <input type="tel" name="phone" placeholder="0xx xxxxxxx" required>
                 <br>
                <label for="message">Your Message:</label>
                <textarea  name="message" rows="5" required placeholder="Type your message here"></textarea>

                <button class="button-sub" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
      const form = document.getElementById('contact-form');

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('You have submitted your message successfully!');
        form.submit();
      });
    </script>
    
</body>
</html>

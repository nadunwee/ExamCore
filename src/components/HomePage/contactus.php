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
            <p><strong>Email:</strong><i>emailus@gmail.com</i></p>
            <p><strong>Phone:</strong> +94 xx xxx xx xx</p>
            <p><strong>Address:</strong> 123 Street Name, City, Country</p>
        </div>

        <!-- Right Section: Contact Form -->
        <div class="contact-form">
            <h2>Send Us a Message</h2>

            <form action="submit_form.php" method="POST">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Mr/Mrs/miss" required>
                 <br>
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="0xx xxxxxxx" required>
                 <br>
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="5" required placeholder="Type your message here"></textarea>

                <button class="button-sub" type="submit">Submit</button>
            </form>
        </div>
    </div>
    
</body>
</html>

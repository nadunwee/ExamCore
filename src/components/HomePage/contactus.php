<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <title>Contact Us</title>
  <link rel="stylesheet" href="contactUs.css">

</head>

<body>


  <div class="nav-bar-container">
    <div class="main-logo">ExamCore</div>
    <div class="navigation-bar">
      <ul>
        <a href="../../../homePage.html">
          <li>Home</li>
        </a>
        <a href="./aboutUs.html">
          <li>About</li>
        </a>
        <a href="./SupportPage.html">
          <li>Support</li>
        </a>
        <a href="#">
          <li>Contact Us</li>
        </a>
      </ul>
    </div>
  </div>

  <header>
    <h1>Contact Us</h1>
  </header>

  <div class="container">
    <!-- Left Section: Contact Details -->
    <div class="contact-details">

<<<<<<< HEAD
        <!-- Right Section: Contact Form -->
        <div class="contact-form">
            <h2>Send Us a Message</h2>

            <form id="contact-form" action="contactUs_insert.php" method="POST">

               <label for="ID">Conatcting ID:</label>
               <input type="text"  name="ID" >

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

    <!--<script>
      const form = document.getElementById('contact-form');

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('You have submitted your message successfully!');
        form.submit();
      });
    </script> -->
   
=======
      <img src="../../Images/client.png" width="300px" height="300px" />
      <p><strong>Email:</strong><i>ExamCore@gmail.com</i></p>
      <p><strong>Phone:</strong> +94 71 1111 122/123</p>
      <p><strong>Address:</strong> 123 Rajagiriya, Colombo, Sri Lanka</p>
    </div>

    <!-- Right Section: Contact Form -->
    <div class="contact-form">
      <h2>Send Us a Message</h2>

      <form id="contact-form" action="contactUs_insert.php" method="POST">

        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Mr/Mrs/miss" required>
        <br>
        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" placeholder="0xx xxxxxxx" required>
        <br>
        <label for="message">Your Message:</label>
        <textarea name="message" rows="5" required placeholder="Type your message here"></textarea>

        <button class="button-sub" type="submit">Submit</button>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function(event) {
      event.preventDefault();
      alert('You have submitted your message successfully!');
      form.submit();
    });
  </script>

>>>>>>> cf7aa9e0946e3fe378bd504dc6b5649363f7d1da
</body>

</html>
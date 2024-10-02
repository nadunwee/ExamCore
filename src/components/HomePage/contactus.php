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

      <img src="../../Images/client.png" width="300px" height="300px" />
      <div class="contactUs_page_description">
          <i>We value your feedback and are here to assist you with any inquiries,
             concerns, or support you may need. Whether you have questions about our services, 
             need technical assistance, or simply want to provide feedback, our team is ready to help.<br />
             Feel free to reach out to us using the contact form below, and we'll get back to you as soon as possible. Alternatively, you can contact us via phone or email, or visit us at our office. We strive to provide prompt and effective responses to ensure your satisfaction.
             We look forward to hearing from you!
          </i>
        </div>
      <p><strong>Email:</strong><i>ExamCore@gmail.com</i></p>
      <p><strong>Phone:</strong> +94 71 1111 122/123</p>
      <p><strong>Address:</strong> 123 Rajagiriya, Colombo, Sri Lanka</p>
    </div>

    <!-- Right Section: Contact Form -->
    <div class="contact-form">
      <h2>Send Us a Message</h2>

      <form id="contact-form" action="contactUs_insert.php" method="POST">

        <label for="ID">Contacting ID:</label>
        <input type="text" name="ID" placeholder="This will be auto incremented" >
        <br>
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Mr/Mrs/miss._ _ _ _ _ _ _ _" required>
        <br>
        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" placeholder="+xx xxxxxxxxx" required>
        <br>
        <label for="message">Your Message:</label>
        <textarea name="message" rows="5" required placeholder="Type your message here"></textarea>

        <button class="button-sub" type="submit">Submit</button>
       
      </form>

      <h2>Delete the Message</h2>
    <form id="delete-form" action="message_delete.php" method="POST">
        <label for="deleteID">Enter ID to Delete:</label>
        <input type="text" name="ID" placeholder="Enter the ID of the message">
        <button class="button-sub" type="submit">Delete</button>
    </form>

    <h2>Edit the Message</h2>
      <form id="edit-form" action="message_edit.php" method="POST">
        <label for="dID">Enter ID to Edit:</label>
        <input type="text" name="ID" placeholder="Enter the ID of the message" required>
        <br>
        <label for="name">Enter New Name:</label>
        <input type="text" name="name" placeholder="Enter the new name" required>
        <br>
        <label for="phone">Enter New Phone Number:</label>
        <input type="tel" name="phone" placeholder="Enter the new phone number" required>
        <br>
        <label for="message">Enter New Message:</label>
        <textarea name="message" rows="5" required placeholder="Enter the new message"></textarea>
        <button class="button-sub" type="submit">Edit</button>
      </form>

    </div>
  </div>

  <!--<script>
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function(event) {
      event.preventDefault();
      alert('You have submitted your message successfully!');
      form.submit();
    });
  </script>-->

</body>

</html>
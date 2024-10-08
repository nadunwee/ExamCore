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
        <input type="text" name="ID" placeholder="Type any number You prefer" >
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

<!--delete form-->
      <h2>Delete the Message</h2>
    <form id="delete-form" action="message_delete.php" method="POST">
        <label for="deleteID">Enter ID to Delete:</label>
        <input type="text" name="ID" placeholder="Enter the ID of the message">
        <button class="button-sub" type="submit">Delete</button>
    </form>

<!--Edit form-->
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

  <div class="message-display">
  <h2>Messages Received</h2>

  <?php
  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'exam_core');

  // Check connection
  if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
  }

  // SQL query to select messages
  $sql = "SELECT m_ID, m_name, m_con_num, m_message FROM message";
  $result = $conn->query($sql);

 
  if ($result === false) {
   
    echo "Error: " . $conn->error;
  } else {
    if ($result->num_rows > 0) {
      
      echo "<table border='1'>";
      echo "<tr><th>ID</th><th>Name</th><th>Contact Number</th><th>Message</th></tr>";

      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["m_ID"] . "</td>";
        echo "<td>" . $row["m_name"] . "</td>";
        echo "<td>" . $row["m_con_num"] . "</td>";
        echo "<td>" . $row["m_message"] . "</td>";
        echo "</tr>";
      }

      echo "</table>";
    } else {
      
      echo "No messages found.";
    }
  }
  $conn->close();
  ?>
</div>



  <!--<script>
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function(event) {
      event.preventDefault();
      alert('You have submitted your message successfully!');
      form.submit();
    });
  </script>-->

  <script>
    function validateContactForm() {
        var id = document.querySelector('input[name="ID"]').value;
        var name = document.querySelector('input[name="name"]').value;
        var phone = document.querySelector('input[name="phone"]').value;

        // Regular expressions for validation
        var idRegex = /^[0-9]+$/;
        var nameRegex = /^[a-zA-Z\s]*$/;
        var phoneRegex = /^\+\d{2} \d{9}$/;

        // ID validation
        if (!idRegex.test(id)) {
            alert("ID can only contain numbers.");
            return false;
        }

        // Name validation
        if (!nameRegex.test(name)) {
            alert("Name can only contain letters and spaces.");
            return false;
        }

        // Phone Number validation
        if (!phoneRegex.test(phone)) {
            alert("Phone Number must be in the format '+xx xxxxxxxxx'.");
            return false;
        }

        return true;
    }

    document.getElementById('contact-form').addEventListener('submit', function(event) {
        if (!validateContactForm()) {
            event.preventDefault();
        } else {
            alert('You have submitted your message successfully!');
        }
    });
</script>


<script>
  
  // Delete confirmation
  const deleteForm = document.getElementById('delete-form');

  deleteForm.addEventListener('submit', function(event) {
    event.preventDefault();
    if (confirm('Are you sure you want to delete this message?')) {
      alert('The message has been deleted successfully!');
      deleteForm.submit();
    } else {
      alert('Message deletion canceled.');
    }
  });

  // Edit confirmation
  const editForm = document.getElementById('edit-form');

  editForm.addEventListener('submit', function(event) {
    event.preventDefault();
    if (confirm('Are you sure you want to edit this message?')) {
      alert('The message has been edited successfully!');
      editForm.submit();
    } else {
      alert('Message editing canceled.');
    }
  });
</script>



</body>

</html>
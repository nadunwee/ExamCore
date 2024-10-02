<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Examiner's Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="examinerHome.css" />
    <link
      rel="stylesheet"
      href="../../styles/commonNavbarAndFooterStyles.css"
    />
  </head>
  <body>
    <div class="container">
      <!-- Sidebar -->
      <aside class="sidebar">
        <h1>ExamCore</h1>
        <ul>
          <li><a href="examinerHome.php">Home</a></li>
          <li>
            <a href="../ExaminerPages/ExaminerExam/examinerExam.php">Exams</a>
          </li>
          <li>
            <a href="../ExaminerPages/ExaminerResult/examierResult.html"
              >Results</a
            >
          </li>
          <li>
            <a
              href="../ExaminerPages/ExaminerNotification/ExaminerNotification.php"
              >Notifications</a
            >
          </li>
        </ul>
        <a href="../ExaminerPages/ExaminerProfile/examinerProfile.php"
          ><button class="profile-btn">Examiner Profile</button></a
        >
      </aside>

      <!-- Main content -->
      <main class="main-content">
        <div class="image-placeholder">
          <img src="../../Images/examinerUp.jpg" />
        </div>

        <div class="name-placeholder">
          <h1>HELLO EXAMINER !</h1>
          <br><br>
        </div>

        <!-- Flex container for exam info, history, and quote -->
        <div class="content-area">
          <div class="exam-section">
            <!-- Ongoing Exam Section -->
            <section class="exam-info">
              <h3>Total number of students </h3>
              <div class="exam-details">
                <p>Total Students: 
                  <?php
                   $conn = new mysqli('localhost', 'root', '', 'exam_core');

                   if ($conn->connect_error) {
                     die('Connection Error : ' . $conn->connect_error);
                   }
                    // Query to count the total number of students
                    $sql = "SELECT COUNT(*) AS total_students FROM students";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      // Output data of each row
                      $row = $result->fetch_assoc();
                      echo $row["total_students"];
                    } else {
                      echo "0";
                    }

                    // Close the database connection
                    $conn->close();
                  ?>
                </p>
                
              </div>
            </section>

            <!-- Exam History Section -->
            <section class="exam-history">
              <h3>Ongoing Exams</h3>
              <ul>
                <li> Exam 1 </li>
                <li> Exam 2 </li>
                <li> Exam 3 </li>
              </ul>
            </section>
          </div>

          <!-- Quote Section -->
          <div class="quote-section">
            <img
              class="quote-image"
              src="../../Images/teacher-ex1.png"
              alt="Inspirational Quote Image"
            />
            <img
              class="quote-image"
              src="../../Images/teacher3.png"
              alt="Inspirational Quote Image"
              style="display: none;"  <!-- Hide the other images initially -->
            />
            <img
              class="quote-image"
              src="../../Images/online-teacher.png"
              alt="Inspirational Quote Image"
              style="display: none;"
            />
            <p class="quote">
              "Ensuring Integrity, Fostering Growth, Empowering Success."
            </p>
          </div>
          
        </div>
      </main>

      <footer class="page-footer">
        <p>
          Copyright ©️ 2024 ExamCore. All rights reserved. |
          <a href="#">Terms & Conditions </a>| <a href="#">Privacy Policy</a>
        </p>
      </footer>
    </div>

    <script>
      let currentImageIndex = 0;
      const images = document.querySelectorAll('.quote-image');
      //selects all elements in the document that have the same class
      //return  like an array
    
      function showNextImage() {
        // Hide the current image and shows the next one
        images[currentImageIndex].style.display = 'none';
    
        // Calculate the next image index
        //currentImageIndex = (0 + 1) % 3 = 1
        //currentImageIndex = (1 + 1) % 3 = 2
        currentImageIndex = (currentImageIndex + 1) % images.length;
    
        // Show the next image
        images[currentImageIndex].style.display = 'block';
      }
    
      // Automatically switch images every 3 seconds
      setInterval(showNextImage, 3000);

      //setInterval is a built-in JavaScript function that  
      //repeatedly calls a specified function at a given interval
    </script>
    
  </body>
</html>

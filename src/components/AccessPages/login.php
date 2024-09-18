<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../styles/studentRegister.css" />
    <link rel="stylesheet" href="../../styles/login.css" />
    <title>Registration</title>
  </head>
  <body>
    <p class="student-register-logo"><a href="../../../homePage.html">ExamCore</a></p>

    <div class="student-register-main-container">
        <div class="signup-methods">
          <span>Log in</span>

          <div class="social-logins">
            <div class="social-login-btn">
              <img src="../../Images/google.png" alt="" srcset="">
              <p>Continue with Google</p>
            </div>
            <div class="social-login-btn">
              <img src="../../Images/facebook.png" alt="" srcset="">
              <p>Continue with Facebook</p>
            </div>
            <div class="social-login-btn">
              <img src="../../Images/apple-logo.png" alt="" srcset="">
              <p>Continue with Apple</p>
            </div>
          </div>

          <div class="student-email-register">
            <form action="http://localhost/quizcore/src/components/accesspages/userRegister.php" method="POST">
              <div class="input-container">
                <label for="type">Log in As</label>
                <select name="types" id="types">
                  <option value="student" default>Student</option>
                  <option value="examiner">Examiner</option>
                </select>
              </div>

              <div class="input-container">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="input-field" placeholder="Enter Your Email..." required />
              </div>

              <div class="input-container">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="input-field" placeholder="Enter Your Password..." required />
              </div>

              <input type="submit" value="Sign up with Email" class="register-submit-btn" />
            </form>

            <section>By continuing with Google, Apple, or Email, you agree to our Terms of Service and Privacy Policy.</section>
          </div>

          <hr>

          <div class="student-register-redirect-login">Don't have an account? <a href="./userRegister.php"><u>Go to Sign up</u></a></div>
        </div>

        <div class="login-imgs">
          <section>
            <img src="../../Images/password-forgot.png" alt="Team">
          </section>
        </div>
        
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Lab 4</title>
    <link rel="stylesheet" href="index-style.css"/>

    <style>
      table.calendar {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
      }
      table.calendar th {
        background-color: darkmagenta;
        color: white;
        padding: 8px;
        text-align: center;
        font-size: 14px;
      }
      table.calendar td {
        borderr: 1px solid darkmagenta;
        text-align: center;
        padding: 8px;
        font-size: 14px;
        color: #333;
      }
      table.calendar td.empty {
        background-color: #f9f0f9;
      }
      table.calendar td.today {
        background-color: darkmagenta;
        color: white;
        font-weight: bold;
        border-radius: 4px;
      }
      .calendar-title {
        text-align: center;
        font-weight: bold;
        color: darkmagenta;
        font-size: 18px;
        margin-bottom: 8px;
      }

      ul.file-list {
        list-style: none;
        padding-left: 0;
      }
      ul.file-list li {
        padding: 5px 0;
        border-bottom: 1px solid #f0d0f0
        font-size: 15px;
      }
      ul.file-list li::before {
        content: "📄";
      }

      ul.course-list {
        list-style: none;
        padding-left: 0;
      }
      ul.course-list li {
        padding: 5px 0;
        border-bottom: 1px solid #f0d0f0
        font-size: 15px;
      }
      ul.course-list li::before {
        content: "📚";
      }
      </style>
  </head>


  <body>
    <div id="header">
      <h1>Alessia Couchond</h1>
      <img src="IMG_4627.JPG" alt="Picture of Alessia" width="200" height="200" />
    </div>

    <div id="main-content">

      <div class="section" id="introduction">
        <h2>Self Introduction</h2>
        <p>
          Hi everyone! My name is <span class="highlight">Alessia</span> and I'm an <span class="highlight">international student-athlete</span> from <span class="highlight">Milan, Italy</span> here at Pacific. I'm currently in the volleyball team and I'm a <span class="highlight">setter</span>. A fun fact about me is that I'm celiac, that means I have to eat gluten free food :(
        </p>
      </div>
      
      <div class="section" id="major">
        <h2>Major and Concentration</h2>
        <p>
          My major is <span class="highlight">Data Science</span> with concentration in <span class="highlight">Data Engeneering</span> and a minor in <span class="highlight">Computer Science</span>.
        </p>
      </div>

      <div class="section" id="courses">
        <h2>List of courses</h2>

        <?php
          $file = "courses.txt";

          if (file_exists($file)) {
            $courses = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            echo "<ul class='course-list'>";
            foreach ($courses as $course) {
              echo "<li>" . htmlspecialchars($course) . "</li>";
            } 
            echo "</ul>";
          } else {
              echo "<p>Course list not found. Please make sure courses.txt is in the project folder.</p>";
          }
        ?>
      </div>

      <div class="section" id="projects">
        <h2>List of projects</h2>
        <ul>
          <li>
            <strong>Celiac Disease Analysis:</strong>A Python data analysis project that studied how factors like age, symptoms, diabetes, and antibody levels may influence the diagnosis of celiac disease.
          </li>
          <li>
            <strong>Banking Program:</strong>A C++ banking system project where users can create accounts, open saving and checking sub-accounts, deposit and withdraw money, and manage balances.
          </li>
        </ul>
      </div>

      <div class="section" id="hobbies">
        <h2>Interests and Hobbies</h2>
        <p>
          In my free time, I really enjoy <span class="highlight">traveling</span> and visiting new places. I also love going back home and spending time with my family because I unfortunately don't get to see them very often. Another thing I enjoy is shopping, hanging out with my friends, and having movie nights together. Besides <span class="highlight">volleyball</span> that is my passion, I like doing simple things that help me relax and have a good time with people I care about.
        </p>
      </div>

      <div class="section" id="fun-fact">
        <h2>Something interesting about me</h2>
        <p>
          I have an older sister and her name is <span class="highlight">Carlotta</span>. We're really close and we do everything together; she's the reason why I started to play volleyball and study in the US has always been her dream so I'm living this experience "with her".
        </p>
      </div>

      <div class="section" id="calendar">
        <h2> Monthly Calendar </h2>

        <?php
          $currentMonth = date("n");
          $currentYear = date("Y");
          $today = date("j");
          $monthName = date("F");

          $firstDayofMonth = date("N", mktime(0,0,0,$currentMonth,1,$currentYear));
          $firstDayofMonth = $firstDayofMonth % 7;

          $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

          echo "<p class='calendar-title'>" . $monthName . " " . $currentYear . "</p>";
        ?>

        <div style-"overflow-x: auto;">
          <table class="calendar">
            <tr>
              <th>Sun</th>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </tr>

            <?php
              $dayCounter = 1;
              $cellCount = 0;

              echo "<tr>";
              for ($i = 0; $i < $firstDayofMonth; $i++) {
                echo "<td class='empty'></td>";
                $cellCount++;
              }

              while ($dayCounter <= $daysInMonth) {
                if ($dayCounter == $today) {
                  echo "<td class='today'>" . $dayCounter . "</td>";
                } else {
                  echo "<td>" . $dayCounter . "</td>";
                }
                $cellCount++;
                $dayCounter++;

                if($cellCount % 7 == 0 && $dayCounter <= $daysInMonth) {
                  echo "</tr><tr>";
                }
              }

              $remaining = 7-($cellCount % 7);
              if ($remaining < 7) {
                for ($i = 0; $i < $remaining; $i++) {
                  echo "<td class='empty'></td>";
                }
              }

              echo "</tr>";
            ?>
          </table>
        </div>
      </div>

      <div class="section" id="files">
        <h2> Project Files </h2>

        <?php
          $allItems = scandir(".");

          echo "<ul class='file-list'>";

          foreach ($allItems as $item) {
            if($item == "." || $item == "..") {
              continue;
            }
            if (is_file($item)) {
              echo "<li>" . htmlspecialchars($item) . "</li>";
            }
          }

          echo "</ul>";
        ?>
      </div>

      <div class="section" id="contact">
        <h2> Contact me </h2>

        <form action ="process.php" method="post">
          <label for="name">Name:</label><br>
          <input type="text" id="name" name="name" placeholder="Your name"<br><br>

          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" placeholder="your@email.com"<br><br>

          <label for="message">Message:</label><br>
          <textarea id="message" name="message" rows="4" cols="50" placeholder="Write your message here..."></textarea><br><br>
          
          <input type="submit" value="Send Message">
        </form>
      </div> 

    </div>

  </body>
</html>
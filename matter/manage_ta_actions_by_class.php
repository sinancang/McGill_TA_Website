<div class="form-container ajax-content-container">
   <!--
   <select name="display-select" class="drop" id="ta-display-select">
      <option>-- Select an Option --</option>
      <option value="office-hours">Office Hours</option>
      <option value="performance-log">Performance Log</option>
      <option value="ta-wishlist">TA Wishlist</option>
   </select>
   -->


   <div class="nav-btns-container-ta-management">
      <button type="button" name="load_data" id="office-hours" class="manage-ta-nav-btn open">Add Office Hours</button>
      <button type="button" name="load_data2" id="performance-log" class="manage-ta-nav-btn">Leave TA Performance Review</button>
      <button type="button" name="load_data3" id="wishlist" class="manage-ta-nav-btn">TA Wishlist</button>
      <button type="button" name="load_data3" id="all-tas-report" class="manage-ta-nav-btn">All TAs Report</button>
  </div>

   <div class='form-wrapper modal edit-user-info-form' style="width: 80%;">


      <?php 
         echo "<div id='selected-course-code'>{$_GET['course-code']}</div>";
         echo "<div id='selected-course-term'>{$_GET['course-term']}</div>";
      ?>


      <!-- OFFICE HOURS  -->
      <div class="display-option-ta-management office-hours open">
         <!--how to decide which user is-->
         <div class="form-container">
            <div class="sign-up-form" style="width: 70%;">
            

                  <p>Choose a Day:</p>
                  <select id="oh-day-select" name = "day"class="drop" >
                     <option> -- </option>
                     <option> Monday </option>
                     <option> Tuesday </option>
                     <option> Wednesday </option>
                     <option> Thursday </option>
                     <option> Friday </option>
                  </select>

                  <br></br>

                  <label for="appt">Choose a time for your Office hours:</label>
                  <br></br>
                  <p >start: </p>
                  <input id="oh-start-time" class="drop" type="time" name="start" min="09:00" max="18:00" required><br>
                  <p>end: </p>
                  <input id="oh-end-time" class="drop" type="time" name="end" min="09:00" max="18:00" required>
                  <label for="location">Location: </label> <br>
                  <input id="oh-location" class="drop" type="text" name="location" placeholder="Enter Location" required><br></br>
                  <p>Add duties: </p>
                  <textarea id="oh-duties" name = "duties" class="text-area" name="duties" rows="5"></textarea>
                  <br>
                  <button id="submit-oh-hours-btn">Set Office Hours</button>
               
            </div>
         </div>
      </div>


      <!-- PERFORMANCE LOG -->
      <div class="display-option-ta-management performance-log">
         <!--Course is already selected at the begginning, how to reach that variable from the dashboard database? -->
         <div class="form-container">
            <div class="sign-up-form" style="width: 70%;">
               

                  <!--prof select a ta from a dropdown so generate dynamic dropdown-->
                  <select id = "TA_dropdown" class="drop" name="TA_dropdown">
                     <option>Select a TA</option>

                     <?php 

                        $filename = "../db/user_data.json";
                        $data = file_get_contents($filename);
                        $user_data = json_decode($data, true);

                        foreach($user_data as $name => $data) {
                           for ($i=0; $i<count($data['courses']); $i++) {
                              if ($data['courses'][$i]['course num'] == $_GET['course-code']
                                 && $data['courses'][$i]['term'] == $_GET['course-term']
                                 && $data['courses'][$i]['role'] == 'ta') {
                                    echo "<option value='{$name}'>{$name}</option>";
                                 }
                           }
                        }

                     ?>

                  </select>
                  <p>Leave a note about the TA:</p>
                  <textarea id = "review" class="text-area" name="review" rows="5"></textarea>
                  <br>
                  <button id="button" onclick="submit_performance_log()">Submit Review</button>
               
            </div>
         </div>
      </div>


      <!-- WISHLIST -->
      <div class="display-option-ta-management ta-wishlist">
         <div class="form-container">
            <div class="sign-up-form" style="width: 70%;">
               <form method="get" name="form" action="../utils/TA_wish_list.php">
                  <p>Choose a TA: </p>
                  <select class="drop" id = "TA" name ="TA">
                     <option> Select a TA </option>
                     <?php 

                        $filename = "../db/user_data.json";
                        $data = file_get_contents($filename);
                        $user_data = json_decode($data, true);

                        foreach($user_data as $name => $data) {
                           for ($i=0; $i<count($data['courses']); $i++) {
                              if ($data['courses'][$i]['course num'] == $_GET['course-code']
                                 && $data['courses'][$i]['term'] == $_GET['course-term']
                                 && $data['courses'][$i]['role'] == 'ta') {
                                    echo "<option value='{$name}'>{$name}</option>";
                                 }
                           }
                        }

                     ?>
                  </select>
                  <br></br> 
                  <button id="button" style="background-color: #d77171;" type="submit">Submit Selection</button>
               </form>
            </div>
         </div>
      </div>


      <!-- All TAs Report -->
      <div class="display-option-ta-management all-tas-report">
         <select id="oh-day-select" name = "day"class="drop" >
            <option> -- </option>
            <option> Performance Log </option>
            <option> Student Reviews </option>
            <option> Office Hours </option>
         </select>
         <div class="performance-log-all-tas">
            <?php

               if (($handle = fopen("../db/TA_performance_logs.csv", "r")) !== FALSE) {
                  $i = 0;
                  echo '<table id="performance-table" class="manage-ta-table sortable">';
                  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                     $prof = $data[0];
                     $ta = $data[1];
                     $course = $data[2];
                     $term = $data[3];
                     $review = $data[4];

                     if ($i == 0) {
                        echo '<tr class="manage-ta table-row header">';
                        echo "<th>$prof</th>";
                        echo "<th>$ta</th>";
                        echo "<th>$course</th>";
                        echo "<th>$term</th>";
                        echo "<th>$review</th>";
                        echo "</th>";
                     }
                     else {
                        if ($course == $_GET['course-code'] || $term == $_GET['course-term']) {
                           echo '<tr class="manage-ta table-row">';
                           echo "<td>$prof</td>";
                           echo "<td>$ta</td>";
                           echo "<td>$course</td>";
                           echo "<td>$term</td>";
                           echo "<td>$review</td>";
                           echo "</td>";
                        }
                     }

                     $i++;
                  }
                  echo '</table>';

                  fclose($handle);
               }
               else {
                  echo "Unable to show performance log at this time";
                  return;
               }

            ?>
         </div>

      </div>
   </div>
</div>
</div>
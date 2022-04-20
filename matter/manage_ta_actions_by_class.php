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

      </div>
   </div>
</div>
</div>
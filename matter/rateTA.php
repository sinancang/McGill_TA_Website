
 <div class="form-container ajax-content-container">
    <div class='form-wrapper modal edit-user-info-form'>
        <div class="sign-up-form">
            <?php 
                echo 
                "<div id='form-course-code' style='font-size: 15px;'>{$_GET['course-code']}</div>
                <div id='form-course-term' style='font-size: 15px;'>{$_GET['course-term']}</div>";
            ?>
            <form method="post" name="form" action="../utils/rateTASubmission.php" style="padding-left: 5%;">
                <!-- 
                <div style="font-size: 15px;">Select a term:</div>
                <select id = "term" name ="term" onchange="termSelected(this.value)"class="drop form-select"> 
                    <option> -- Select a term --</option>
                    <option> FALL 2020 </option>
                    <option> WINTER 2021 </option>
                    <option> FALL 2021 </option>
                    <option> WINTER 2022 </option>
                </select>
                -->
                <p style="font-size: 15px;">Select a TA from the options:</p>
                <select class="drop form-select" id = "TA_dropdown" name="TA_dropdown">
                    <option value="">-- Select a TA --</option>
                    <?php
                        $course_code = $_GET['course-code'];
                        $course_term = $_GET['course-term'];
                        $user = $_GET['user'];

                        $filename = "../db/user_data.json";
                        $data = file_get_contents($filename);
                        $arr = json_decode($data, true);

                        foreach($arr as $key=>$value){
                            //looping through each user
                            for ($i=0; $i < count($value['courses']); $i++){
                                //if in the given term, TA exists:
                                if($value['courses'][$i]["role"] == "ta"){
                                    if($value['courses'][$i]["term"] == $course_term
                                        && $value['courses'][$i]['course num'] == $course_code
                                        && $key != $user){
                                            echo "<option> $key </option>";                  
                                    }           
                                }
                            }
                        }		
                    ?>

                </select>
                <p style="font-size: 15px;">Give a score for TA (1: lowest, 5: highest)</p>
                <select  class="drop form-select" id = "score" name="score">
                    <option>-- Select a rating --</option>
                    <option> 1 </option>
                    <option> 2 </option>
                    <option> 3 </option>
                    <option> 4 </option>
                    <option> 5 </option>
                </select>

                <p style="font-size: 15px;">Leave a review:</p>
                <textarea id = "review" name="review" class="text-area" rows="5" style="width: 95%;"></textarea><br>
                <button id="button" style="background-color: #d77171;" type="submit" onclick="sendCourseRequest()">Submit Review</button>  
            </form>
        </div>
    </div>
</div>       
<?php
    $filename1 = "../db/user_data.json";
    $data1 = file_get_contents($filename1);
    $user_data = json_decode($data1, true);

    $filename2 = "../db/all_courses.json";
    $data2 = file_get_contents($filename2);
    $all_courses = json_decode($data2, true);

    echo "<div></div>";
    echo "<div>Choose a course below to sign-up as student to be able to leave a TA review.</div><br></br>";   

	    for ($i=0; $i<count($all_courses); $i++) {
	    // TO DO: only display this year's courses

	    echo
            "<div class='nav-bar-btn-container second-nav-bar'>
                <div class='nav-bar-btn-wrapper  second-nav-bar'>
                        <div id='course-code' class='nav-bar-btn'>{$all_courses[$i]['course code']}</div>
                        <div id='course-name' class='nav-bar-btn sub-title'>{$all_courses[$i]['course name']}</div>
                        <div id='course-term' class='nav-bar-btn sub-title'>{$all_courses[$i]['term']}</div>
                    </div>
                </div>
            </div>";
        }

?>

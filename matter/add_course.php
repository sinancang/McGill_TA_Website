<?php
    $filename1 = "../db/user_data.json";
    $data1 = file_get_contents($filename1);
    $user_data = json_decode($data1, true);

    $filename2 = "../db/all_courses.json";
    $data2 = file_get_contents($filename2);
    $all_courses = json_decode($data2, true);

    echo "<br></br>";
    echo "<div class='add-course-description'>Click a course below to sign-up as student to be able to leave a TA review.</div>"; 
    echo "<table>";
	    for ($i=0; $i<count($all_courses); $i++) {
	    // TO DO: only display this year's courses

	    echo
            "<tr>
			<td><button class='add-course-button' onclick='add_course()'>
			<div id='course-code'>{$all_courses[$i]['course code']}</div>
                        <div id='course-name'>{$all_courses[$i]['course name']}</div>
                        <div id='course-term'>{$all_courses[$i]['term']}</div></button></td>
            </tr>";
	    }
    echo "</table>";

?>

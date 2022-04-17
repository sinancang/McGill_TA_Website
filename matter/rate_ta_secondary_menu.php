
<?php 

    echo 'going through courses';
    $filename1 = "../db/user_data.json";
    $data1 = file_get_contents($filename1);
    $user_data = json_decode($data1, true);

    $filename2 = "../db/all_courses.json";
    $data2 = file_get_contents($filename2);
    $all_courses = json_decode($data2, true);

    
    if ($user_data[$_GET['user']]['type'] == 'sysop') {
        for ($i=0; $i<count($all_courses); $i++) {
            "<div class='nav-bar-btn-container second-nav-bar'>
                <div class='nav-bar-btn-wrapper  second-nav-bar'>
                        <div class='nav-bar-btn'>{$all_courses[$i]}</div>
                    </div>
                </div>
            </div>";
        }
    }



?>


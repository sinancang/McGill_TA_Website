
<?php 
    $filename1 = "../db/user_data.json";
    $data1 = file_get_contents($filename1);
    $user_data = json_decode($data1, true);

    $filename2 = "../db/all_courses.json";
    $data2 = file_get_contents($filename2);
    $all_courses = json_decode($data2, true);

    
    if ($user_data[$_GET['user']]['type'] == 'sysop') {
        "<div class='nav-bar-btn-container second-nav-bar'>
            <div class='nav-bar-btn-wrapper  second-nav-bar'>
                    <div class='nav-bar-btn'>Manage Users</div>
                </div>
            </div>
        </div>";
    }



?>


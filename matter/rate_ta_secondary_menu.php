
<?php 
    $filename1 = "../db/user_data.json";
    $data1 = file_get_contents($filename1);
    $user_data = json_decode($data1, true);

    $filename2 = "../db/all_courses.json";
    $data2 = file_get_contents($filename2);
    $all_courses = json_decode($data2, true);

    echo 'heeeeeeere';

    
    if ($user_data[$_GET['user']]['type'] == 'sysop') {
        for ($i=0; $i<count($all_courses); $i++) {
            echo
            "<div class='nav-bar-btn-container second-nav-bar'>
                <div class='nav-bar-btn-wrapper  second-nav-bar'>
                        <div class='nav-bar-btn'>{$all_courses[$i]}</div>
                    </div>
                </div>
            </div>";
        }
    }
    else {
        for ($i=0; $i<count($user_data['courses']); $i++) {
            echo $user_data['courses'][$i];
            if ($user_data['courses'][$i]['role'] != 'ta') {
                echo
                "<div class='nav-bar-btn-container second-nav-bar'>
                    <div class='nav-bar-btn-wrapper  second-nav-bar'>
                            <div class='nav-bar-btn'>{$user_data['courses'][$i]['course num']}</div>
                        </div>
                    </div>
                </div>";
            }
        }
    }
?>


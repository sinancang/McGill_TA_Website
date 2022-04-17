
<?php 
    $filename = "../db/user_data.json";
    $data = file_get_contents($filename);
    $user_data = json_decode($data, true);

    $name = $_GET['target'];
    $email = $user_data[$name]['email'];
    $type = $user_data[$name]['type'];
    $courses = $user_data[$name]['courses'];
?>

<div class='form-wrapper modal edit-user-info-form'>


    <div class='form-input-container'>
        <label for='name'>Name</label>
        <input type='text' name='name' id='edit-user-name' value="<?php echo $name ?>" required>
    </div>

    <div class='form-input-container'>
        <label for='email'>Email</label>
        <input type='text' name='email' id='edit-user-email' value="<?php echo $email ?>" required>
    </div>

    <div class='form-input-container'>
        <label for='edit-type'>User Type</label>
        <select name='edit-type' id='edit-user-type' class='form-select-input'>
            <?php 

                if ($type == 'admin') {
                    echo
                    "<option selected='selected' value='admin'>Admin</option>
                    <option value='prof'>Professor</option>";
                }
                else if ($type == 'prof') {
                    echo 
                    "<option value='admin'>Admin</option>
                    <option selected='selected' value='prof'>Professor</option>";
                }
            
            ?>

        </select>
    </div>


    <div class='user-courses-list-container'>

            <?php 
                for ($i=0; $i < count($courses); $i++) {

                    echo
                    "<div class='edit-user-course-container'>
                        <div class='edit-user-course-num'>{$courses[$i]['course code']}</div>
                        <div class='edit-user-course-name'>{$courses[$i]['course name']}</div>
                        <div class='edit-user-course-term'>{$courses[$i]['course term']}</div>
                    

                        <select name='edit-type' id='edit-user-type' class='edit-user-course-role'>";
                
                            if ($courses[$i]['role'] == 'admin') {
                                echo
                                "<option selected='selected' value='admin'>Admin</option>
                                <option value='prof'>Professor</option>";
                            }
                            else if ($courses[$i]['role'] == 'prof') {
                                echo 
                                "<option value='admin'>Admin</option>
                                <option selected='selected' value='prof'>Professor</option>";
                            }
                                
                    echo 
                        "</select>
                    </div>";


                }
            ?>

    </div>

    <button class='submit-btn' id='submit-user-changes' type='button'>Submit Changes</button>

</div>
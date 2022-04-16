<div class="ajax-content-container">

    
    <div class="manage-users-select-container">
        <label for="user-type-select">Select User Type</label>

        <select name="user-types" id="user-type-select">
            <option value="">Please choose an option</option>
            <option value="All">All</option>
            <option value="TA">TA</option>
            <option value="Professor">Professor</option>
            <option value="Administrator">Administrator</option>
            <option value="Student">Student</option>
        </select>
    </div>
    


    <div class="all-user-types-container">

    <div class="user-accounts all">

            <div class="user-account-type-title">ALL USERS</div>

            <div class="user-account-entries">

                <?php 

                    $filename = "../db/user_data.json";
                    $data = file_get_contents($filename);
                    $user_data = json_decode($data, true);


                    
                    foreach($user_data as $key => $value) {
                        $courses = $value['courses'];

                        for ($i = 0; $i < count($courses); $i++) {

                            echo $courses[$i]['course name'];
                            
                            /*
                            echo "<div class='entry-container'>";
                            echo "<div class='user-account-entry'>{$TAs[$i]}</div>";
                            echo "<div class='user-account-actions-container'>";
                            echo "<div class='remove-user' target='{$TAs[$i]}'>Delete</div>";
                            echo "<div class='edit-user' arget='{$TAs[$i]}'>Edit</div>";
                            echo "</div>";
                            echo "</div>";
                            */
                        }
                    }
                    

                    

                    for ($i = 0; $i < count($TAs); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$TAs[$i]}</div>";
                        echo "<div class='user-account-actions-container'>";
                        echo "<div class='remove-user' target='{$TAs[$i]}'>Delete</div>";
                        echo "<div class='edit-user' arget='{$TAs[$i]}'>Edit</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                    

                ?>
            </div>

        </div>

        <div class="user-accounts ta">

            <div class="user-account-type-title">TAs</div>

            <div class="user-account-entries">

                <?php 

                    $filename = "../db/user_by_role.json";
                    $data = file_get_contents($filename);
                    $user_data = json_decode($data, true);

                    $TAs = $user_data['ta'];
                    $profs = $user_data['prof'];
                    $admins = $user_data['admin'];
                    $students = $user_data['student'];

                    

                    for ($i = 0; $i < count($TAs); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$TAs[$i]}</div>";
                        echo "<div class='user-account-actions-container'>";
                        echo "<div class='remove-user' target='{$TAs[$i]}'>Delete</div>";
                        echo "<div class='edit-user' arget='{$TAs[$i]}'>Edit</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                    

                ?>
            </div>

        </div>
        <div class="user-accounts prof">

            <div class="user-account-type-title">PROFESSORS</div>
            <div class="user-account-entries">

                <?php 
                    for ($i = 0; $i < count($profs); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$profs[$i]}</div>";
                        echo "<div class='user-account-actions-container'>";
                        echo "<div class='remove-user' target='{$profs[$i]}'>Delete</div>";
                        echo "<div class='edit-user' target='{$profs[$i]}'>Edit</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
            </div>

        </div>
        <div class="user-accounts admin">

            <div class="user-account-type-title">ADMINS</div>
            <div class="user-account-entries">
                <?php 
                    for ($i = 0; $i < count($admins); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$admins[$i]}</div>";
                        echo "<div class='user-account-actions-container'>";
                        echo "<div class='remove-user' target='{$admins[$i]}'>Delete</div>";
                        echo "<div class='edit-user' target='{$admins[$i]}'>Edit</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
        <div class="user-accounts student">

            <div class="user-account-type-title">STUDENTS</div>
            <div class="user-account-entries">
                <?php 
                    for ($i = 0; $i < count($students); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$students[$i]}</div>";
                        echo "<div class='user-account-actions-container'>";
                        echo "<div class='remove-user' target='{$students[$i]}'>Delete</div>";
                        echo "<div class='edit-user' target='{$students[$i]}'>Edit</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
            </div>

        </div>
        
    </div>

</div>
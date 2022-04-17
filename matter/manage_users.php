<div class="ajax-content-container">

    <div class="user-management-top-options">
        <div class="manage-users-select-container">
            <label for="user-type-select">Select User Type</label>

            <select name="user-types" id="user-type-select">
                <option value="All">All</option>
                <option value="TA">TA</option>
                <option value="Professor">Professor</option>
                <option value="Administrator">Administrator</option>
                <option value="Student">Student</option>
                <option value="Sys-Op">System Operator</option>
                <option value="deactivated">Deactivated Users</option>
            </select>
        </div>

        <button class="add-new-user-btn">Add New Prof/Admin</button>
    </div>
    


    <div class="all-user-types-container">

        <div class="user-accounts all open">

            <div class="user-account-type-title">ALL USERS</div>

            <div class="user-account-entries">

                <?php 

                    $filename = "../db/user_data.json";
                    $data = file_get_contents($filename);
                    $user_data = json_decode($data, true);


                    $TAs = array(); 
                    $profs = array(); 
                    $admins = array(); 
                    $students = array(); 
                    $sysOps = array();
                    $deactivated = array();
                    
                    foreach($user_data as $key => $value) {
                        // skip if user has been deactivated (deleted)
                        if ($value['deactivated'] == true) {
                            array_push($deactivated, $key);
                            continue;
                        }

                        $courses = $value['courses'];
                        $isStudent = false;
                        $isTA = false;
                        $isProf = false;
                        $isAdmin = false;
                        $isSysOps = false;


                                                    
                        echo 
                        "<div class='entry-container'>
                            <div class='user-account-entry'>
                                <div class='user-name'>{$key}</div>
                                <div class='user-email'>{$value['email']}</div>
                                <div class='user-roles-container'>";

                                    if ($value['type'] == 'ta') {
                                        $isTA = true;
                                        array_push($TAs, $key);
                                        echo "<div class='user-role'>TA</div>";
                                    }

                                    if ($value['type'] == 'sysop') {
                                        $isSysOps = true;
                                        array_push($sysOps, $key);
                                        echo "<div class='user-role'>Sys-Op</div>";
                                    }
            
                                    if ($value['type'] == 'admin') {
                                        $isAdmin = true;
                                        array_push($admins, $key);
                                        echo "<div class='user-role'>Admin</div>";
                                    }
            
                                    if ($value['type'] == 'prof') {
                                        $isProf = true;
                                        array_push($profs, $key);
                                        echo "<div class='user-role'>Prof</div>";
                                    }
            
                                    if ($value['type'] == 'student') {
                                        $isStudent = true;
                                        array_push($students, $key);
                                        echo "<div class='user-role'>Student</div>";
                                    }

                                    for ($i = 0; $i < count($courses); $i++) {
                                        $role = $courses[$i]['role'];
                                        if ($role == 'TA' && !$isTA) {
                                            array_push($TAs, $key);
                                            echo "<div class='user-role'>TA</div>";
                                            $isTA = true;
                                        }
                                        if ($role == 'prof' && !$isProf) {
                                            array_push($profs, $key);
                                            echo "<div class='user-role'>Prof</div>";
                                            $isProf = true;
                                        }
                                        if ($role == 'admin' && !$isAdmin) {
                                            array_push($admins, $key);
                                            echo "<div class='user-role'>Admin</div>";
                                            $isAdmin = true;
                                        }
                                        if ($role == 'student' && !$isStudent) {
                                            array_push($students, $key);
                                            echo "<div class='user-role'>Student</div>";
                                            $isStudent = true;
                                        }
                                    }

                        echo "</div>
                        </div>";

                        if (!$isSysOps) {
                            echo                           
                            "<div class='user-account-actions-container'>
                                <div class='remove-user' target='{$key}'>Deactivate</div>
                                <div class='edit-user' target='{$key}'>Edit</div>
                            </div>";
                        }

                        echo "</div>";


                        // edit user code. originally hidden
                        echo
                        "<div class='edit-user-info-container'>
                            <div class='form-wrapper'>


                                <div class='form-input-container'>
                                    <label for='course-code'>Course code</label>
                                    <input type='text' name='course-code' id='course-code' required>
                                </div>
                        
                                <div class='form-input-container'>
                                    <label for='course-name'>Course Name</label>
                                    <input type='text' name='course-name' id='course-name' required>
                                </div>
                        
                                <div class='form-input-container'>
                                    <label for='term'>Term</label>
                                    <input type='text' name='term' id='term' required>
                                </div>
                        
                                <div class='form-input-container'>
                                    <label for='new-prof'>Professor name</label>
                                    <input type='text' name='new-prof' id='new-prof' required>
                                </div>
                
                
                
                                <button class='submit-btn' id='add-btn' type='button' onclick='submitAddManuallyForm()'>Add</button>
                
                            </div>
                        </div>"
                            
                    }    

                ?>
            </div>

        </div>

        <div class="user-accounts ta">

            <div class="user-account-type-title">TAs</div>

            <div class="user-account-entries">

                <?php 

                    for ($i = 0; $i < count($TAs); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$TAs[$i]}</div>";
                        echo "<div class='user-email'>{$user_data[$TAs[$i]]['email']}</div>";

                        if ($user_data[$TAs[$i]]['type'] != 'sysop') {
                            echo "<div class='user-account-actions-container'>";
                            echo "<div class='remove-user' target='{$TAs[$i]}'>Deactivate</div>";
                            echo "<div class='edit-user' target='{$TAs[$i]}'>Edit</div>";
                            echo "</div>";
                        }

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
                        echo "<div class='user-email'>{$user_data[$profs[$i]]['email']}</div>";
                        if ($user_data[$profs[$i]]['type'] != 'sysop') {
                            echo "<div class='user-account-actions-container'>";
                            echo "<div class='remove-user' target='{$profs[$i]}'>Deactivate</div>";
                            echo "<div class='edit-user' target='{$profs[$i]}'>Edit</div>";
                            echo "</div>";
                        }
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
                        echo "<div class='user-email'>{$user_data[$admins[$i]]['email']}</div>";
                        if ($user_data[$admins[$i]]['type'] != 'sysop') {
                            echo "<div class='user-account-actions-container'>";
                            echo "<div class='remove-user' target='{$admins[$i]}'>Deactivate</div>";
                            echo "<div class='edit-user' target='{$admins[$i]}'>Edit</div>";
                            echo "</div>";
                        }
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
                        echo "<div class='user-email'>{$user_data[$students[$i]]['email']}</div>";
                        if ($user_data[$students[$i]]['type'] != 'sysop') {
                            echo "<div class='user-account-actions-container'>";
                            echo "<div class='remove-user' target='{$students[$i]}'>Deactivate</div>";
                            echo "<div class='edit-user' target='{$students[$i]}'>Edit</div>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                ?>
            </div>

        </div>
        <div class="user-accounts sys-op">

            <div class="user-account-type-title">SYSTEM OPERATORS</div>

            <div class="user-account-entries">

                <?php                  

                    for ($i = 0; $i < count($sysOps); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$sysOps[$i]}</div>";
                        echo "<div class='user-email'>{$sysOps[$TAs[$i]]['email']}</div>";
                        echo "</div>";
                    }  

                ?>
            </div>

        </div>

        <div class="user-accounts deactivated">

            <div class="user-account-type-title">DEACTIVATED USERS</div>

            <div class="user-account-entries">

                <?php 

                    for ($i = 0; $i < count($deactivated); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$deactivated[$i]}</div>";
                        echo "<div class='user-account-actions-container'>";
                        echo "<div class='reactivate-user' target='{$deactivated[$i]}'>Reactivate</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                ?>
            </div>

        </div>
        
    </div>

</div>
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
            <option value="Sys-Op">System Operator</option>
            <option value="deactivated">Deactivated Users</option>
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

                        if ($value['type'] == 'sysop') {
                            $isSysOps = true;
                            array_push($sysOps, $key);
                        }
                                                    
                        echo 
                        "<div class='entry-container'>
                            <div class='user-account-entry'>
                                <div class='user-name'>{$key}</div>
                                <div class='user-roles-container'>";

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

                        if ($isSysOps) echo "<div class='user-role'>Sys-Op</div>";

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
        <div class="user-accounts admin">

            <div class="user-account-type-title">ADMINS</div>
            <div class="user-account-entries">
                <?php 
                    for ($i = 0; $i < count($admins); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$admins[$i]}</div>";
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
        <div class="user-accounts student">

            <div class="user-account-type-title">STUDENTS</div>
            <div class="user-account-entries">
                <?php 
                    for ($i = 0; $i < count($students); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$students[$i]}</div>";
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
        <div class="user-accounts sys-op">

            <div class="user-account-type-title">SYSTEM OPERATORS</div>

            <div class="user-account-entries">

                <?php                  

                    for ($i = 0; $i < count($sysOps); $i++) {
                        echo "<div class='entry-container'>";
                        echo "<div class='user-account-entry'>{$sysOps[$i]}</div>";
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
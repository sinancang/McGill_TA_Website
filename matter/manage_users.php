<div class="ajax-content-container">

    <!-- 
    <div class="manage-users-container">
        <label for="user-type-select">Select User Type</label>

        <select name="user-types" id="user-type-select" multiple>
            <option value="">Please choose an option</option>
            <option value="TA">TA</option>
            <option value="Professor">Professor</option>
            <option value="Administrator">Administrator</option>
        </select>
    </div>
    -->



    <div class="user-accounts ta">

        <div class="user-account-type-title">TA USER ACCOUNTS</div>

        <div class="user-account-entries">

            <?php 

                $filename = "../db/user_by_role.json";
                $data = file_get_contents($filename);
                $user_data = json_decode($data, true);

                $TAs = $user_data['ta'];
                $profs = $user_data['prof'];
                $admins = $user_data['admin'];

                for ($i = 0; $i < count($TAs); $i++) {
                    echo "<div class='user-account-entry'>{$TAs[$i]}</div>";
                }

            ?>
        </div>

    </div>
    <div class="user-accounts prof">

        <div class="user-account-type-title">PROFESSOR USER ACCOUNTS</div>
        <div class="user-account-entries">

            <?php 
                for ($i = 0; $i < count($profs); $i++) {
                    echo "<div class='user-account-entry'>{$profs[$i]}</div>";
                }
            ?>
        </div>

    </div>
    <div class="user-accounts admin">

        <div class="user-account-type-title">ADMIN USER ACCOUNTS</div>
        <div class="user-account-entries">
            <?php 
                for ($i = 0; $i < count($admins); $i++) {
                    echo "<div class='user-account-entry'>{$admins[$i]}</div>";
                }
            ?>
        </div>
    </div>

</div>
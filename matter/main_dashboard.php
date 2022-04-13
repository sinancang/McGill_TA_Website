<div id="main-dashboard-greeting">Hi, <?php echo $_GET['user'] ?>!</div>

<div class="user-type-based-actions">
    <?php 
        $filename = "../db/user_by_role.json";
        $data = file_get_contents($filename);
        $data = json_decode($data, true);
        $username = $_GET['user'];

        $isSysOps = false;
        $isAdmin = false;
        $isProf = false;
        $isTA = false;

        for ($i=0; $i<count($data["sys-ops"]); $i++) {
            if ($data["sys-ops"][$i] == $username) $isSysOps = true;
        }
        for ($i=0; $i<count($data["admin"]); $i++) {
            if ($data["admin"][$i] == $username) $isAdmin = true;
        }
        for ($i=0; $i<count($data["prof"]); $i++) {
            if ($data["prof"][$i] == $username) $isProf = true;
        }
        for ($i=0; $i<count($data["ta"]); $i++) {
            if ($data["ta"][$i] == $username) $isTA = true;
        }

        if ($isSysOps) {
            echo '<button class="user-type-based-btn sys-ops-btn">IMPORT PROFESSORS AND COURSES</button>';
            echo '<button class=" user-type-based-btn sys-ops-btn">IMPORT TA COHORT</button>';
        }
        if ($isAdmin) {
            echo '<button clas="user-type-based-btn admin-btn">IMPORT TA COHORT</button>';
        }
    ?>
</div>


<div class="main-dashboard-recent-activity-container">

    <div class="recent-activity-title">RECENT ACTIVITY</div>


    <div class="recent-activity">      
        <?php 
           
            $filename = "../db/activity_history.json";
            $data = file_get_contents($filename);
            $history_data = json_decode($data, true);

            // loop through avtivity history for this user and display in main dashboard
            $i = count($history_data[$_GET['user']]) - 1;
            // if no activity history
            if ($i == 0) {
                echo "<div class='recent-activity-entry'>";
                echo "<div class='recent-activity-entry-action'>No activity to show</div>";
                echo "</div>";
            } 
            else {
                while ($i >= 0) {

                    $action = $history_data[$_GET['user']][$i]['action'];
                    $date = $history_data[$_GET['user']][$i]['date'];
                    echo "<div class='recent-activity-entry'>";
                    echo "<div class='recent-activity-entry-action'>{$action}</div>";
                    echo "<div class='recent-activity-entry-date'>{$date}</div>";
                    echo "</div>";
                    $i--;
    
                }
            }
        ?>
    </div>
</div>
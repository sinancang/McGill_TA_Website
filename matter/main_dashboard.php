<div id="main-dashboard-greeting">Hi, <?php echo $_GET['user'] ?>!</div>


<div class="main-dashboard-recent-activity-container">

    <div class="recent-activity-title">RECENT ACTIVITY</div>

    <div class="recent-activity">      
        <?php 
           
            $filename = "../db/activity_history.json";
            $data = file_get_contents($filename);
            $history_data = json_decode($data, true);

            // loop through avtivity history for this user and display in main dashboard
            $i = count($history_data[$_GET['user']]);
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
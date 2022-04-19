<!DOCTYPE html>
<html lang="en">

    <head>
        <title>McGill TA Management</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/forms.css">
        <link rel="stylesheet" href="../css/dashboard.css">
        <link rel="stylesheet" href="../css/manage_users.css">
        <link rel="stylesheet" href="../css/manage_ta.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    </head>

    <body>

        <!-- Landing Page Header -->
        <div class="dashboard-header">
            <img class="dashboard-header-icon" src="../images/mcgill-logo-svg.svg">
            <img id="settings-btn" class="dashboard-header-icon" id="settings-btn" src="../images/person.svg">
            
            <nav class="settings-menu-container">
              <div class="settings-btn">Reset Password</div>
              <div class="separating-line"></div>
              <div onclick="sign_out()" class="settings-btn">Sign Out</div>
            </nav>
            
        </div>


        <!-- Landing Page Content -->

        <div class="dashboard-content">

            <div class="nav-bars-container">
                
                <div class="dashboard-content-side-nav-bar first-nav-bar open">
                    <div id="main-dashboard" class="nav-bar-btn-container">
                        <div class="nav-bar-btn-wrapper">
                            <div class="nav-bar-btn">Main Dashboard</div>
                        </div>
                    </div>

                    <div class="separating-line"></div>


                    <?php 
                        //$user_type = 

                        $filename = "../db/user_data.json";
                        $data = file_get_contents($filename);
                        $data = json_decode($data, true);
                        $username = $_GET['user'];

                        $isSysOps = false;
                        $isAdmin = false;
                        $isProf = false;
                        $isTA = false;

                        if ($data[$username]['type'] == 'sysop') $isSysOps = true;
                        if ($data[$username]['type'] == 'admin') $isAdmin = true;
                        if ($data[$username]['type'] == 'prof') $isProf = true;
                        if ($data[$username]['type'] == 'ta') $isTA = true;

                        if ($isSysOps || $isAdmin) {
                            echo 
                            '<div id="admin" class="nav-bar-btn-container first-nav-bar">
                                <div class="nav-bar-btn-wrapper">
                                    <div class="nav-bar-btn">Admin Options</div>
                                    <img class="right-arrow-svg" src="../images/right-arrow.svg">
                                </div>
                            </div>';
                        }
                        
                        if ($isSysOps || $isAdmin || $isProf || $isTA) {
                            echo
                            '<div id="manage" class="nav-bar-btn-container  first-nav-bar">
                                <div class="nav-bar-btn-wrapper">
                                    <div class="nav-bar-btn">Manage TAs</div>
                                    <img class="right-arrow-svg" src="../images/right-arrow.svg">
                                </div>
                            </div>';
                        }
                        
                        echo
                        '<div id="rate" class="nav-bar-btn-container  first-nav-bar">
                            <div class="nav-bar-btn-wrapper">
                                <div class="nav-bar-btn">Rate a TA</div>
                                <img class="right-arrow-svg" src="../images/right-arrow.svg">
                            </div>
                        </div>';

                        if ($isSysOps) {
                            echo
                            '<div id="sys-ops" class="nav-bar-btn-container  first-nav-bar">
                                <div class="nav-bar-btn-wrapper">
                                    <div class="nav-bar-btn">Manage Users</div>
                                    <img class="right-arrow-svg" src="../images/right-arrow.svg">
                                </div>
                            </div>';
                        }
                    ?>

                </div>

                    <div class="dashboard-content-side-nav-bar second-nav-bar">

                        <div class="nav-bar-btn-container back-btn">
                            <div class="nav-bar-btn-wrapper back-btn">
                                <img id="back-arrow" src="../images/right-arrow.svg">
                                <div class="nav-bar-btn back">Back</div>
                            </div>
                        </div>

                        <div id="second-nav-bar-options-container"></div>

                    </div>       
                
            </div>

            <div id="dashboard-dynamic-content" class="dashboard-content-dynamic-content">

                <!-- hidden modals container (added through ajax) -->
                <div class="content-veil"></div>


                <div class="dashboard-dynamic-content-main">
                    <!-- include default dashboard view -->
                    <?php include("main_dashboard.php"); ?>
                </div>


                <?php 

                    $filename = "../db/user_data.json";
                    $data = file_get_contents($filename);
                    $data = json_decode($data, true);
                    $username = $_GET['user'];

                    $isSysOps = false;
                    $isAdmin = false;
                    $isProf = false;
                    $isTA = false;

                    if ($data[$username]['type'] == 'sysop') $isSysOps = true;
                    if ($data[$username]['type'] == 'admin') $isAdmin = true;
                    if ($data[$username]['type'] == 'prof') $isProf = true;
                    if ($data[$username]['type'] == 'ta') $isTA = true;

                    if ($isSysOps || $isAdmin) {
                        echo '<div class="dashboard-content-quick-action-bar">';
                        echo '<div class="user-type-based-actions">';
                        if ($isSysOps) echo '<button class="user-type-based-btn sys-ops-btn">Import Professors and Courses</button>';
                        echo '<button class=" user-type-based-btn admin-btn">Import TA Cohort</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>


            </div>

        </div>
        


        <div id="username"><?php echo $_GET['user']?></div>
        <div id="selected-course"></div>

        <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=5eab681659f730bdd5daac20" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script src="../js/manage_users.js"></script>
        <script src="../js/rateTA.js"></script>
        <script src="../js/manage_ta.js"></script>
	    <script src="../js/dashboard.js"></script>
        <!-- <script type="text/javascript" src="./db/TA_review.json"></script> -->
	<script>
		    function sign_out(){
			    syncRequest = new XMLHttpRequest();
			    var url = "../utils/remove_ticket.php";
			    syncRequest.open("POST", url, true);
			    var fd = new FormData;
			    fd.append('username', document.getElementById('username'));
			    syncRequest.send(fd);
			    
			    window.sessionStorage.removeItem("ticket");
			    window.location.replace("../matter/login.html");
		}
	</script>

    </body>
</html>

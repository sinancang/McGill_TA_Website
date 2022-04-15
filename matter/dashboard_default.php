<!DOCTYPE html>
<html lang="en">

    <head>
        <title>McGill TA Management</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/forms.css">
        <link rel="stylesheet" href="../css/dashboard.css">   
    </head>

    <body>

        <!-- Landing Page Header -->
        <div class="dashboard-header">
            <img class="dashboard-header-icon" src="../images/icon-simple.svg">
            <img class="dashboard-header-icon" id="settings-btn" src="../images/settings-icon.svg">
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

                    <div id="admin" class="nav-bar-btn-container first-nav-bar">
                        <div class="nav-bar-btn-wrapper">
                            <div class="nav-bar-btn">Administration</div>
                            <img class="right-arrow-svg" src="../images/right-arrow.svg">
                        </div>
                    </div>

                    <div id="manage" class="nav-bar-btn-container  first-nav-bar">
                        <div class="nav-bar-btn-wrapper">
                            <div class="nav-bar-btn">Manage TAs</div>
                            <img class="right-arrow-svg" src="../images/right-arrow.svg">
                        </div>
                    </div>
                    <div id="rate" class="nav-bar-btn-container  first-nav-bar">
                        <div class="nav-bar-btn-wrapper">
                            <div class="nav-bar-btn">Rate a TA</div>
                            <img class="right-arrow-svg" src="../images/right-arrow.svg">
                        </div>
                    </div>

                    <div id="sys-ops" class="nav-bar-btn-container  first-nav-bar">
                        <div class="nav-bar-btn-wrapper">
                            <div class="nav-bar-btn">System Ops</div>
                            <img class="right-arrow-svg" src="../images/right-arrow.svg">
                        </div>
                    </div>

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


            <!-- include default dashboard view -->
            <?php include("main_dashboard.php"); ?>


            </div>

        </div>
        


        <div id="username"><?php echo $_GET['user']?></div>

        <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=5eab681659f730bdd5daac20" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="../js/dashboard.js"></script>

    </body>
</html>

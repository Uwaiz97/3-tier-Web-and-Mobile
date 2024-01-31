<?php
session_start();

include "classes/dbh.classes.php";
include "classes/application.classes.php";
include "classes/application-view.classes.php";
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Application</title>
    <link
        href="https://upload.wikimedia.org/wikipedia/en/thumb/a/af/University_of_Johannesburg_Logo.svg/1200px-University_of_Johannesburg_Logo.svg.png"
        rel="icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="inner">

                <!-- Logo -->
                <a href="posaAdmin.php" class="logo">
                    <span class="fa fa-home"></span> <span class="title">POSA</span>
                </a>

                <!-- Nav -->
                <nav>
                    <ul>
                        <li><a href="#menu">Menu</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <!-- Menu -->
        <nav id="menu">
            <h2>Menu</h2>
            <ul>
                <li><a href="applicationHandler.php">View Applications</a></li>
                <li><a href="viewAccommodation.php">View Accommodations</a></li>
                <li><a href="inspectedList.php">View Completed Inspections</a></li>
                <li><a href="escalated.php">View Escalated Issues</a></li>
                <li><a href="adminReports.php">View Reported Issues</a></li>
                <li><a href="stats.php">Stats</a></li>
                <li><a href="registerEmployee.php">Register Staff Member</a></li>
                <li><a href="includes/logout.inc.php">Log Out</a></li>
            </ul>
        </nav>

        <!-- Main -->
        <div id="main">

            <br>
            <br>

            <div class="inner">

                <h2 class="h2">View Application</h2>

                <br>

                <table>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Property Name</th>
                        <th>Property Address</th>
                        <th>Number Of Beds</th>
                    </tr>

                    <?php
                    $application = new ApplicationView();
                    $property = $application->showSingleProperty($_GET['propid']);
                    $user = $application->showLandlord($property['landlord_id']);

                    function generateDownloadLink($filePath)
                    {
                        return "<a href='$filePath' target='_blank'>View File</a>";
                    }

                    ?>
                    <tr>
                        <th>
                            <?php echo $user['user_name']; ?>
                            <?php echo $user['user_surname']; ?>
                        </th>
                        <th>
                            <?php echo $property['prop_name']; ?>
                        </th>
                        <th>
                            <?php echo $property['prop_address']; ?>
                        </th>
                        <th>
                            <?php echo $property['prop_numBeds']; ?>
                        </th>

                    </tr>
                </table>
                <h2>Documents</h2>
                <table>
                    <thead>
                        <tr>
                            <th>File Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Company Registration</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_companyReg']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Proof of Ownership</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_proofOwnership']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Tax Pin</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_taxPin']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Utility Bill</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_utilityBill']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Liability Cover</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_liabilityCover']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Certificate of Occuppancy</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_certificateOccuppancy']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Land Use Consent</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_landUseConsent']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Zoning Permit</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_zoningPermit']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Building Plans</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_buildingPlans']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Proof Of Payment</th>
                            <th>
                                <?php
                                $temp = explode("/", $property['prop_proofOfPayment']);
                                unset($temp[0]);
                                $result = implode("/", $temp);
                                echo generateDownloadLink($result); ?>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <br>
                <form action="includes/aboutApplication.inc.php" method="post">
                    <div class="fields">
                        <div class="field text-right">
                            <input type="hidden" name="propid" value="<?php echo $_GET['propid']; ?>">
                            <?php if ($property['prop_accreditStatus'] == "Verifying Documents") { ?>
                                <ul class="actions">
                                    <li><input type="submit" name="updateToInspect" value="Update To Inspection"
                                            class="primary" /></li>
                                </ul>

                                <textarea type="text" name="declineComment"
                                    placeholder="Comments for declining application"></textarea>

                                <br>

                                <ul class="actions">
                                    <li><input type="submit" name="declineApplication" value="Decline Application"
                                            class="primary" /></li>
                                </ul>

                            <?php } elseif ($property['prop_accreditStatus'] == "Accredited") { ?>
                                <input type="submit" name="deAccredited" value="De-Accredit Accommodation"
                                    class="primary" />
                            <?php } elseif ($property['prop_accreditStatus'] == "De-Accredited") { ?>
                                <input type="submit" name="allowAccreditation" value="Allow Accredition"
                                    class="primary" />
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <?php include 'footer.php'; ?>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
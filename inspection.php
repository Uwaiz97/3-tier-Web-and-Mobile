<?php
session_start();

include "classes/dbh.classes.php";
include "classes/inspection.classes.php";
include "classes/inspection-view.classes.php";
include "classes/oca-inspection-contr.classes.php";
include "classes/ohs-inspection-contr.classes.php";
include "classes/sec-inspection-contr.classes.php";

$userid = $_SESSION["userId"];
$inspection = new InspectionView();
$staffType = $inspection->showStaffType($userid);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accommodation Inspection</title>
    <meta charset="utf-8">

    <!-- Favicons -->
    <link
        href="https://upload.wikimedia.org/wikipedia/en/thumb/a/af/University_of_Johannesburg_Logo.svg/1200px-University_of_Johannesburg_Logo.svg.png"
        rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./fontawesome-free-6.4.0-web\fontawesome-free-6.4.0-web\css\all.css">
    <link rel="stylesheet" type="text/css" href="CSS\Login.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


    <script data-require="jquery@3.1.1" data-semver="3.1.1"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>

</head>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-control {
        width: 100%;
    }

    .form-container {
        border: 4px solid #000;
        padding: 20px;
        width: 1000px;
        margin: 0 auto;
        /* Center the container horizontally */
        margin-top: 100px;
        /* Adjust the top margin as needed */
    }

    .big-font {
        font-size: 24px;
    }
</style>

<style>
    /* Add some basic styling for the counter */
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 20px;
    }

    #counter {
        font-size: 24px;
        font-weight: bold;
    }

    .counter-btn {
        font-size: 20px;
        margin: 5px;
        padding: 5px 10px;
        cursor: pointer;
    }
</style>

<body>

    <p class="mt-3 text-center big-font">
        <strong>Privately Owned Student Accommodation Inspection (POSA)</strong>
    </p>

    <br>
    <p class="mt-3 text-center"> <strong>Please note the following additional information regarding
            inspections:</strong></P>

    <p class="mt-3 text-center">
        Every property shall be strictly inspected a maximum of 2 times including an appeal and It is mandatory to have
        all room keys available during the inspection.
    </p>

    <div class="form-container">
        <form action="includes/inspection.inc.php" method="post">
            <h2 class="mt-3 text-center">Accommodation Inspection</h2>

            <div class="form-group mt-3">
                <label for="dateTime">Date:</label>
                <input type="text" class="form-control" name="dateTime" id="dateTime" placeholder="Date">
            </div>
            <div class="form-group mt-3">
                <label for="propertyName">Name of property:</label>
                <input type="text" class="form-control" name="propertyName" id="propertyName"
                    placeholder="Property Name">
            </div>
            <div class="form-group mt-3">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
            </div>

            <input type="hidden" name="propid" value="<?php echo $_GET['propid']; ?>">

            <?php if ($staffType == "Co-Ordinator") { ?>

                <div class="form-group mt-3">
                    <label for="noBeds">Number of Beds:</label>
                    <input type="number" class="form-control" name="noBeds" id="noBeds" placeholder="No.Of Beds">
                </div>

                <div class="form-group mt-3">
                    <label for="noSingleBeds">Number of Single beds:</label>
                    <input type="number" class="form-control" name="noSingleBeds" id="noSingleBeds"
                        placeholder="No.Of Single beds">
                </div>

                <div class="form-group mt-3">
                    <label for="noSharingBeds">Number of Sharing beds:</label>
                    <input type="number" class="form-control" name="noSharingBeds" id="noSharingBeds"
                        placeholder="No. Of Sharing beds">
                </div>

                <br>
                <p> <strong>ROOMS:</strong></p>
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th scope="col">Features</th>
                            <th scope="col">Counter</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Mattresses</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noMattresses" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="mattressComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Heaters</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noHeaters" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="heaterComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Study Lamp</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noLamps" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="lampComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Bookshelve</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noBShelves" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="bShelveComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Wadrobes</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noWardrobes" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="wardrobeComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Paper Bin</td>
                            <td>
                                <div>
                                    <div class="quantity buttons_added">
                                        <input type="number" step=1 min="0" max="" name="noPaperBins" value="0"
                                            title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                    </div>
                                </div>
                            </td>
                            <td><input type="text" name="paperBinComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Curtains</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noCurtains" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="curtainsComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Chairs</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noChairs" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="chairComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Tables</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noTables" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="tableComt" class="form-control"></td>
                        </tr>

                    </tbody>
                </table>
                <br>

                <p> <strong>KITCHEN:</strong></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Features</th>
                            <th scope="col">Counter</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Stoves</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noStoves" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="stoveComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Fridges</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noFrigdes" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="frigdeComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Microwaves</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noMicrowaves" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="microwaveComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Laundry Facilities</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noLaundryFacs" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="laundryFacsComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Lockable Cupboards</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noLckCupboards" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="lckCupboardsComt" class="form-control"></td>
                        </tr>

                    </tbody>
                </table>
                <br>

                <p> <strong>BATHROOMS:</strong></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Features</th>
                            <th scope="col">Counter</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Showers/Bathtubs</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noShowerBaths" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="showerBathComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Toilet</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noToilets" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="toiletComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Basin</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noBasins" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="basinComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>She Bin</td>
                            <td>
                                <div class="quantity buttons_added">
                                    <input type="number" step=1 min="0" max="" name="noSheBins" value="0" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                </div>
                            </td>
                            <td><input type="text" name="sheBinComt" class="form-control"></td>
                        </tr>

                    </tbody>
                </table>

                <div class="d-grid gap-2 mt-3">
                    <input type="submit" class="btn" style="background-color:gray; color:white;" name="OCA_submit"
                        type="button">
                </div>

            <?php } elseif ($staffType == "OHS") { ?>

                <p> <strong>OCCUPATIONAL HEALTH AND SAFETY:</strong></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Features</th>
                            <th scope="col">Yes</th>
                            <th scope="col">No</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Evacuation alarm/Fire Horn</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fireAlarm" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fireAlarm" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="fireAlarmComt" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Smoke detectors</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="smokeDetectorsTrue" type="radio" name="smokeDetectors" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="smokeDetectorsF" type="radio" name="smokeDetectors" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="smokeDetectorsComt" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Fire Blanket</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fireBlanket" type="radio" name="fireBlanket" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fireBlanket" type="radio" name="fireBlanket" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="fireBlanketComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Fire extinguisher services and date of service</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fireExtinguishers" type="radio" name="fireExtinguishers" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fireExtinguishers" type="radio" name="fireExtinguishers" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="fireExtinguishersComt" class="form-control"></td>
                        </tr>
                        <tr>

                            <td>Fire equipment signage</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fireEqtSign" type="radio" name="fireEqtSign" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fireEqtSign" type="radio" name="fireEqtSign" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="fireEqtSignComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>First Aid Box</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="firstAid" type="radio" name="firstAid" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="firstAid" type="radio" name="firstAid" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="firstAidComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>DB Board signage</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="dbBoard" type="radio" name="dbBoard" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="dbBoard" type="radio" name="dbBoard" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="dbBoardComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Pest control</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="pestControl" type="radio" name="pestControl" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="pestControl" type="radio" name="pestControl" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="pestControlComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Emergency procedures and numbers</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="emgyPdr" type="radio" name="emgyPdr" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="emgyPdr" type="radio" name="emgyPdr" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="emgyPdrComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Exit routes identified with signage and there are no obstructions</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="emgyExitRoute" type="radio" name="emgyExitRoute" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="emgyExitRoute" type="radio" name="emgyExitRoute" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="emgyExitRouteComt" class="form-control"></td>
                        </tr>


                        <tr>
                            <td> Exit doors can be opened at all times </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="exitDoors" type="radio" name="exitDoors" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="exitDoors" type="radio" name="exitDoors" value=0>

                                </div>
                            </td>
                            <td><input type="text" name="exitDoorsComt" class="form-control"></td>
                        </tr>

                    </tbody>
                </table>

                <div class="d-grid gap-2 mt-3">
                    <input type="submit" class="btn" style="background-color:gray; color:white;" name="OHS_submit"
                        type="button">
                </div>

            <?php } elseif ($staffType == "Security") { ?>

                <p> <strong>SECURITY:</strong></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Features</th>
                            <th scope="col">Yes</th>
                            <th scope="col">No</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Perimeter fence</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fenceTrue" type="radio" name="fence" value=1>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="fenceFalse" type="radio" name="fence" value="0">

                                </div>
                            </td>
                            <td><input type="text" name="fenceComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Gates</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="gatesTrue" type="radio" name="gates" value=1>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="gatesFalse" type="radio" name="gates" value="0">
                                </div>
                            </td>
                            <td><input type="text" name="gatesComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Burglar door/Bars</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="burglarTrue" type="radio" name="burglarProof" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="burglarFalse" type="radio" name="burglarProof" value="0">

                                </div>
                            </td>
                            <td><input type="text" name="burglarProofComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>CCTV</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="cctvTrue" type="radio" name="cctv" value=1>

                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="cctvFalse" type="radio" name="cctv" value="0">

                                </div>
                            </td>
                            <td><input type="text" name="cctvComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Armed Response</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="armedTrue" type="radio" name="armedResp" value=1>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="armedFalse" type="radio" name="armedResp" value="0">
                                </div>
                            </td>
                            <td><input type="text" name="armedRespComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Panick Buttons</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="panicBtnTrue" type="radio" name="panicBtn" value=1>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="panicBtnFalse" type="radio" name="panicBtn" value="0">
                                </div>
                            </td>
                            <td><input type="text" name="panicBtnComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Room Locks</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="lockTrue" type="radio" name="roomLocks" value=1>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="lockFalse" type="radio" name="roomLocks" value="0">
                                </div>
                            </td>
                            <td><input type="text" name="roomLocksComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Security Officer Posted</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="secTrue" type="radio" name="security" value=1>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="secFalse" type="radio" name="security" value="0">
                                </div>
                            </td>
                            <td><input type="text" name="securityComt" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Visible Lighting</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="lightingTrue" type="radio" name="lighting" value=1>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" id="lightingFalse" type="radio" name="lighting" value=0>
                                </div>
                            </td>
                            <td><input type="text" name="lightingComt" class="form-control"></td>
                        </tr>

                    </tbody>
                </table>

                <div class="d-grid gap-2 mt-3">
                    <input type="submit" class="btn" style="background-color:gray; color:white;" name="Sec_submit"
                        type="button">
                </div>

            <?php } ?>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let count = 0;

        function incrementCounter() {
            count++;
            document.getElementById("counter").textContent = count;
        }

        function decrementCounter() {
            count--;
            document.getElementById("counter").textContent = count;
        }
    </script>
</body>

</html>
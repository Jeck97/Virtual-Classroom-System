<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../inc/head.php'; ?>
</head>

<body>

    <?php include '../inc/student-top-nav.php'; ?>
    <?php include '../inc/student-side-nav.php'; ?>

    <div class="container">
        <div class="header">
            <h1>Attendance</h1>
        </div>
        <div class="main-content">
            <div class="no-content">
                <p class="no-content-text">You have no assignment</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <div style="width: 300px;">
                        <div style="display: flex; width: 100%; margin: 10px 0;">
                            <div style="width: 30%">
                                <label for="channel-dropdown">Channel</label>
                            </div>
                            <div style="width: 70%">
                                <select id="channel-dropdown" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
                                    <option selected="selected" disabled="disabled">-- Select --</option>
                                    <option>2021 Bulls Training Camp</option>
                                    <option>Business Management Class</option>
                                    <option>Cooking Masterclass</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <p>Attendance Rate: <b style="font-size: large;">100.0 %</b></p>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <table class="card-table" style="width:100%; border-collapse: collapse;">
                        <tbody>
                            <tr style="padding: 10px;">
                                <td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Date</span><i class="fa fa-caret-down" style="float: right;"></i></td>
                                <td style="width: 40%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Class</span><i class="fa fa-caret-down" style="float: right;"></i></td>
                                <td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Status</span><i class="fa fa-caret-down" style="float: right;"></i></td>
                                <td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Remark</span><i class="fa fa-caret-down" style="float: right;"></i></td>
                            </tr>
                            <tr style="padding: 10px;">
                                <td style="width: 20%; padding: 10px 20px;"><span>Wed 26<sup>th</sup> May 2021<br>2:00pm - 4:00pm</span></td>
                                <td style="width: 40%; padding: 10px 20px;"><span>Week 10</span></td>
                                <td style="width: 20%; padding: 10px 20px;"><a href="#" style="text-decoration: none;"><span>Submit Attendance</span></a></td>
                                <td style="width: 20%; padding: 10px 20px;"><span>Self-recorded</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
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

    <div id="container" class="container">
        <div class="header">
            <h1>Channel</h1>
        </div>
        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2>2021 Bulls Training Camp</h2>
                    <div style="display: flex; width: 450px; align-items: center; justify-content: center;">
                        <div style="display: flex; width: 70%; margin: 10px;">
                            <div style="width: 15%;">
                                <label for="class-dropdown">Class</label>
                            </div>
                            <div style="width: 85%">
                                <select id="class-dropdown" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
                                    <option>General</option>
                                    <option>Week 1</option>
                                    <option>Week 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; background-color: #D0CECE;padding: 20px; border-top-right-radius: 10px; border-top-left-radius: 10px;">
                            <div>
                                <div style="display: flex;">
                                    <div style="margin-right: 10px;">
                                        <span style="font-size: 16pt; font-weight: bolder;">Room 1</span>
                                    </div>
                                    <div style="display: flex; align-items: flex-end;">
                                        <span style="font-size: .8em;">28/04 12.55pm</span>
                                    </div>
                                </div>
                                <div>
                                    <span>Dear students, this is our first meeting for 2021 Bulls Training Camp in Room 1.</span>
                                </div>
                            </div>
                            <div>
                                <div style="padding: 10px 0;">
                                    <span style="font-weight: bolder; color: #FFC000;">MEETING END</span>
                                </div>
                                <div style="visibility: hidden;">
                                    <button class="btn btn-light" style="float: right;">START</button>
                                </div>
                            </div>
                        </div>
                        <div style="background-color: #F2F2F2; padding: 20px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                            <div style="padding: 10px; overflow: auto; height: 100px; font-size: 10pt; display: flex; flex-direction: column;">
                                <span style="padding: 2px 0px;"><b>JOEL EMBIID:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>DAMIAN LILLARD:</b>&nbsp;Alright, sir.</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div style="display: flex; justify-content: space-between; background-color: #D0CECE;padding: 20px; border-top-right-radius: 10px; border-top-left-radius: 10px;">
                            <div>
                                <div style="display: flex;">
                                    <div style="margin-right: 10px;">
                                        <span style="font-size: 16pt; font-weight: bolder;">Room 2</span>
                                    </div>
                                    <div style="display: flex; align-items: flex-end;">
                                        <span style="font-size: .8em;">05/05 01.00pm</span>
                                    </div>
                                </div>
                                <div>
                                    <span>Dear students, please complete the assignment 2 before join the meeting.</span>
                                </div>
                            </div>
                            <div>
                                <div style="padding: 10px 0;">
                                    <span style="font-weight: bolder; color: #0070C0;">MEETING SCHEDULED</span>
                                </div>
                                <div>
                                    <button class="btn btn-light" style="float: right;">JOIN</button>
                                </div>
                            </div>
                        </div>
                        <div style="background-color: #F2F2F2; padding: 20px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                            <div style="padding: 10px; overflow: auto; height: 100px; font-size: 10pt; display: flex; flex-direction: column;">
                                <span style="padding: 2px 0px;"><b>LEBRON JAMES:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>STEPH CURRY:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>JOEL EMBIID:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>DAMIAN LILLARD:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>KEVIN DURANT:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>GIANIS ANTETOKOUNMPO:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>KAWHI LEONARD:</b>&nbsp;Alright, sir.</span>
                                <span style="padding: 2px 0px;"><b>ANTHONY DAVIS:</b>&nbsp;Alright, sir.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
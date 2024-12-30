<link rel="stylesheet" href="css/admin/dashboard.css">
<div id="dashboard-container">
    <h1 class="text-center mt-5 fw-bolder pt-2 pb-2">Overview data in: <?php echo date("F Y") ?></h1>
    <div id="overview-container" class="d-flex justify-content-around align-items-center">
        <div class="block" style="background-color: #5B56D6" id="total-user-container">
            <h1 class="data" id="total-user"></h1>
            <p>Total users</p>
        </div>
        <div class="block" style="background-color: #3299FE">
            <h1 class="data" id="total-product"></h1>
            <p>Total products sold</p>
        </div>
        <div class="block" style="background-color: #EDAC12">
            <h1 class="data" id="total-order"></h1>
            <p>Total orders</p>
        </div>
        <div class="block" style="background-color: #DA5D5B">
            <h1 class="data" id="total-income"></h1>
            <p>Total income</p>
        </div>
    </div>
    <div id="chart-container">
    </div>
    <h3 class="text-center mb-5" id="chart-title">Total users in the lasted 30 days</h3>

</div>
<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="js/admin/dashboard.js" type="module"></script>

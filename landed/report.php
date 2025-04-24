<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renovation Budget Calculator</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .container {
            max-width: 1380px;
        }
        .table-main-container {
            margin: 18px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-main-container">
            <div class="table-box">
                <h1>Resale Flate Price</h1>
                <div class="hdb-val-card">
                    <h1 class="hdb-val-title">
                        <strong>FREE Home Valuation Report (worth $88)</strong>
                    </h1>
                    <div class="hdb-val-content">
                        <p>
                            Expect a call from us soon with a complimentary consultation for <span id="full-address-result">{Client's Property's Address}</span>. Get a clear picture of your HDB unit <span id="unit-result">{Client's Property Unit Number}</span> selling price with no obligations.
                        </p>
                        <ul>
                            <li>Recent rentals nearby</li>
                            <li>Highest transactions</li>
                            <li>Last 3 months report</li>
                            <li>Potential selling price</li>
                            <li>X-Value estimate</li>
                            <li>Nearby HDB comparison</li>
                        </ul>
                        <p>
                            Get market trends analysis to help you plan ahead, whether selling now or in the future.
                        </p>
                    </div>
                </div>

                <div class="table">
                    <p>Search Results</p>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-input readonly" value="Street Name" readonly>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-input readonly" id="street-value" value="<?= $_GET['street'] ?? 'N/A'; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-input readonly" value="Sqft" readonly>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-input readonly" id="sqft-value" value="<?= $_GET['sqft'] ?? 'N/A'; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-input readonly" value="Your Plan" readonly>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-input readonly" id="plan-value" value="<?= $_GET['plan'] ?? 'N/A'; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filter and Results Table Section -->
            <div class="table-box1">
                <div class="table">
                    <table id="empTable" class="table table-striped" style="width:100%">
                        <tr>
                            <th>Date of Sales</th>
                            <th>Project Name</th>
                            <th>Street Name</th>
                            <th>Discrict</th>
                            <th>Market Segment</th>
                            <th>Tenure</th>
                            <th>Type of Sale</th>
                            <th>Floor Level</th>
                            <th>Area (Sqft)</th>
                            <th>Sale Price (S$)</th>    
                        </tr>
                    </table>
                    <tbody></tbody>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.3/js/standalone/selectize.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dataTables_filter label input').attr('placeholder', ' ⌕ search here');
            $('.basic').select2();

            // Initial table load
            load_data({ project: $('#project').val() });

            // Project select change
            $('#project').on('change', function () {
                reloadTable();
            });

            // Search button click
            $('#search-field').on('keyup', function () {
                reloadTable();
            });

            function reloadTable() {
                $('#empTable').DataTable().destroy();
                load_data({
                    project: $('#project').val(),
                    search: $('#search-field').val(),
                });
            }

            function load_data(params = {}) {
                $('#empTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '../util_project_data.php',
                        data: params
                    },
                    columns: [
                        { data: 'contractDate' },
                        { data: 'project' },
                        { data: 'street' },
                        { data: 'district' },
                        { data: 'marketSegment' },
                        { data: 'tenure' },
                        { data: 'typeOfSale' },
                        { data: 'floorRange' },
                        { data: 'area' },
                        { data: 'price' }
                    ],
                    order: [[0, "desc"]]
                });
            }
        });
    </script>
</body>
</html>

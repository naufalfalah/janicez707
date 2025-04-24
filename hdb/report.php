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
                    <h1 class="hdb-val-title"><strong>FREE Home Valuation Report (worth $88)</strong></h1>
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
                            <input type="text" class="form-input readonly" value="HDB Town" readonly>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-input readonly" id="town-value" value="<?= $_GET['town'] ?? 'N/A'; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-input readonly" value="Flat Type" readonly>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-input readonly" id="flat-type-value" value="<?= $_GET['flat_type'] ?? 'N/A'; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-box1">
                <div class="filter-wrapper">
                    <!-- <div class="filter-buttons-box">
                        <button type="button">Your Block</button>
                        <button type="button">Your Custer</button>
                    </div> -->
                    <!-- <div class="filter-search-box">
                        <div class="select-box">
                            <span>Show</span>
                            <select name="project-name" id="project-name">
                                <option value="Choose Town" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <span>Entire</span>
                        </div>
                        <div class="search-box">
                            <input class="search-field" type="search" placeholder=" ⌕ search here" name="search"
                                id="search">
                        </div>
                    </div> -->
                </div>
                <div class="table">
                    <table id="hdb-table">
                        <tr>
                            <th>Sold Price</th>
                            <th>Sold Month</th>
                            <th>Address</th>
                            <th>Area</th>
                            <th>Level</th>
                            <th>Remaining Lease</th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                No record available
                            </td>
                        </tr>
                    </table>
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
        let base_url = "https://data.gov.sg/api/action/datastore_search";
        let resource_id = "f1765b54-a209-4718-8d38-a39237f502b3";
        let town = <?= json_encode($_GET['town'] ?? '') ?>;
        let flat_type = <?= json_encode($_GET['flat_type'] ?? '') ?>;
        let block = <?= json_encode($_GET['block'] ?? '') ?>;

        $(document).ready(function() {
            initTable();
        });

        function initTable() {
            let first_request_url = `${base_url}`;
            first_request_url += `?resource_id=${resource_id}`;
            first_request_url += `&limit=12000`;
            first_request_url += `&sort=month desc`;

            if (town) {
                let first_filters = {
                    // month: [],
                    town,
                };
                first_request_url += `&filters=${encodeURIComponent(JSON.stringify(first_filters))}`;
            }
            
            let second_request_url = `${base_url}`;
            second_request_url += `?resource_id=${resource_id}`;
            second_request_url += `&limit=12000`;
            second_request_url += `&sort=month desc`;

            if (town && flat_type && block) {
                let second_filters = {
                    // month: [],
                    town,
                    flat_type,
                    block,
                };
                second_request_url += `&filters=${encodeURIComponent(JSON.stringify(second_filters))}`;
            }
            
            console.log('first_request_url', first_request_url);
            console.log('second_request_url', second_request_url);
            sendRequest(first_request_url)
                .then(function (records) {
                    // Handle records
                    // console.log('first', records);
                    setDataIntoTable(records);
                })
                .catch(function (error) {
                    // Handle errors
                    if (error == 'No records found') {
                        sendRequest(second_request_url)
                            .then(function (records) {
                                // Handle records
                                // console.log('second', records);
                                setDataIntoTable(records);
                            })
                            .catch(function (error) {
                                // Handle errors
                                console.error(error);
                            });
                    }
                    console.error(error);
                });
        }

        function sendRequest(url) {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        resolve(data.result.records);
                    },
                    error: function (error) {
                        reject('Error fetching data');
                    }
                });
            });
        }

        function setDataIntoTable(records){
            const tableData = [];

            for (let index = 0; index < records.length; index++) {
                const entry = records[index];

                tableData.push([
                    formatCurrency(entry.resale_price),
                    formatDate(entry.month),
                    `${entry.block}, ${entry.street_name}`,
                    `${entry.floor_area_sqm} sqm`,
                    entry.storey_range,
                    entry.remaining_lease
                ]);
            }

            if ($.fn.DataTable.isDataTable('#hdb-table')) {
                // Destroy the existing table before recreating
                $('#hdb-table').DataTable().clear().rows.add(tableData).draw();
            } else {
                $('#hdb-table').DataTable({
                    data: tableData,
                    columns: [
                        { title: "Resale Price" },
                        { title: "Month" },
                        { title: "Address" },
                        { title: "Area" },
                        { title: "Storey Range" },
                        { title: "Remaining Lease" }
                    ],
                    pageLength: 10,
                    responsive: true
                });
            }
        }

        // Function to format currency
        function formatCurrency(amount) {
            return '$' + Number(amount).toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,');
        }

        // Function to format date
        function formatDate(dateString) {
            var date = new Date(dateString);
            return date.toLocaleString('en-US', { month: 'short', year: 'numeric' });
        }
    </script>
</body>
</html>

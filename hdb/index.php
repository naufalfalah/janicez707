<?php

require_once('../report.php');

$town = $response['lead_details'][0]['lead_form_value'];
$flat_type = $response['lead_details'][2]['lead_form_value'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renovation Budget Calculator</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="calculator">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="logo-text">HDB</div>
            </div>

            <div class="progress-container">
                <div style="display: flex; justify-content: space-between; font-size: 14px;">
                    <span>Completion</span>
                    <span id="progress-percentage">16%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
            </div>

            <ul class="steps-list">
                <li class="step-item active" data-step="2">
                    <div class="step-icon"><i class="fas fa-door-open"></i></div>
                    <div class="step-text">HDB Valuation</div>
                    <div class="step-number">1</div>
                </li>
                <li class="step-item" data-step="4">
                    <div class="step-icon"><i class="fa-solid fa-handshake"></i></div>
                    <div class="step-text">Property Ownership</div>
                    <div class="step-number">2</div>
                </li>
                <li class="step-item" data-step="5">
                    <div class="step-icon"><i class="fa-solid fa-headset"></i></div>
                    <div class="step-text">Contact Info</div>
                    <div class="step-number">3</div>
                </li>
                <li class="step-item" data-step="6" >
                    <div class="step-icon"><i class="fas fa-calculator"></i></div>
                    <div class="step-text">Final Estimate</div>
                    <div class="step-number">4</div>
                </li>
            </ul>
            <div class="sidebar-footer">
                Helping you plan your perfect renovation
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <form action="#" method="POST" id="submit-form">
                    <input type="hidden" name="form_type" value="hdb">
                    <input type="hidden" name="source_url" value="https://launchgovtest.homes/">
                    <input type="hidden" name="lead_id" id="lead_id" value="">

                    <!-- Step 1: More Details -->
                    <section class="form-section active" id="step-1">
                        <div class="section-header">
                            <h1 class="section-title">Property Information & Inquiry </h1>
                            <p class="section-subtitle">Please provide the details of your property and intentions so we can generate an accurate, automated report based on URA data and past transactions.</p>
                        </div>
    
                        <div class="work-category">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-label">Where is your HDB located?  </label>
                                    <div class="town-input">
                                        <select name="town" class="form-select ">
                                            <option value="">Select town</option>
                                        </select>
                                    </div>
                                    <p class="error-message" id="town-error"></p>
                                </div>
                            </div>
                        </div>
    
                        <div class="work-category">
                            <div class="form-group">
                                <label class="form-label">HDB Flat Type? </label>
                                <div class="flat-type-input">
                                    <select name="flat_type" class="form-select ">
                                        <option value="">Select flat type</option>
                                        <option value="2 ROOM">2 - Room</option>
                                        <option value="3 ROOM">3 - Room</option>
                                        <option value="4 ROOM">4 - Room</option>
                                        <option value="EXECUTIVE" >Executive/Multi-Generation</option>
                                    </select>
                                </div>
                                <p class="error-message" id="flat-type-error"></p>
                            </div>
                        </div>
    
                        <div class="work-category">
                            <div class="form-group">
                                <label class="form-label">Are you looking to sell your property? </label>
                                <div class="sell-input">
                                    <select name="sell" class="form-select">
                                        <option value="0-3 months">0-3 months</option>
                                        <option value="3-6 months">3-6 months</option>
                                        <option value="6-12 months">6-12 months</option>
                                        <option value="Exploring options">Exploring options</option>
                                    </select>
                                </div>
                                <p class="error-message" id="sell-error"></p>
                            </div>
                        </div>
    
                        <div class="alert disclaimer-main-wrapper" style="background-color: var(--card);">
                            <div class="disclaimer-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
                            <div class="disclaimer-inner-wrapper">
                                <label class="form-label">Important Note:</label>
                                <p>Please fill up your details and you will be able to retrieve an automated LIVE report extracted base on URA data past transaction reports and a precise property valuation for your unit.</p>
                            </div>
                        </div>
    
                        <p class="section-subtitle">Complete the questionnaire now for immediate results and exclusive access to the latest <span class="Text-Lines">2025 new launch units</span> from our partnering developers.</p>
    
                        <div class="buttons">
                            <button type="button" class="btn btn-prev" onclick="prevStep()">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="button" class="btn btn-next">
                                Continue <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </section>
    
                    <!-- Step 2: Location Requirement -->
                    <section class="form-section" id="step-2">
                        <div class="section-header">
                            <h1 class="section-title">Address Information</h1>
                            <p class="section-subtitle">Please provide the specific details of your property’s address to help us process your request accurately.</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">What is your Street Name </label>
                            <div class="street-input">
                                <select name="street" class="form-select ">
                                    <option value="">Select street</option>
                                </select>
                            </div>
                            <p class="error-message" id="street-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Block No (BLK)? </label>
                            <input type="text" name="block" class="form-input" placeholder="Enter No BLK">
                            <p class="error-message" id="block-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">What is your unit number?</label>
                            <input type="text" name="unit" class="form-input" placeholder="Enter unit number">
                            <p class="error-message" id="unit-error"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">What is your floor number? </label>
                            <input type="text" name="floor" class="form-input" placeholder="Enter floor number">
                            <p class="error-message" id="floor-error"></p>
                        </div>
                        <div class="alert disclaimer-main-wrapper" style="background-color: var(--card);">
                            <div class="disclaimer-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
                            <div class="disclaimer-inner-wrapper">
                                <label class="form-label">Important Note:</label>
                                <p>Please fill up your details and you will be able to retrieve an automated LIVE report extracted base on URA data past transaction reports and a precise property valuation for your unit.</p>
                            </div>
                        </div>
    
                        <div class="buttons">
                            <button type="button" class="btn btn-prev" onclick="prevStep()">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="button" class="btn btn-next">
                                Continue <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </section>
    
                    <!-- Step 3: Age Requirement -->
                    <section class="form-section" id="step-3">
                        <div class="section-header">
                            <h1 class="section-title">Contact Information</h1>
                            <p class="section-subtitle">Enter your details to receive a detailed renovation report</p>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-input" name="name" placeholder="Enter your full name">
                            <p class="error-message" id="name-error"></p>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-input" name="email" placeholder="Enter your email address">
                            <p class="error-message" id="email-error"></p>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <div class="phone-input">
                                <select class="form-select phone-code" name="country_code">
                                    <option value="+65">🇸🇬 +65 (SG)</option>
                                </select>
                                <input type="tel" class="form-input" name="ph_number" placeholder="Enter your phone number" maxlength="8">
                            </div>
                            <p class="error-message" id="phone-error"></p>
                        </div>
    
                        <div class="checkbox-wrapper last-contact">
                            <input type="checkbox" name="terms" id="terms" class="checkbox-input" checked>
                            <label for="terms" class="checkbox-label">
                                <span class="checkbox-custom"></span>
                                <span> I consent to the collection, use, and disclosure of my personal data for purposes as set out in our Privacy Policy. (View Policy)</span>
                            </label>
                            <p class="error-message" id="terms-error"></p>
                        </div>
    
                        <div class="buttons">
                            <button type="button" class="btn btn-prev" onclick="prevStep()">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn btn-submit">
                                Continue <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </section>
    
                    <!-- Step 4: Results -->
                    <section class="form-section" id="step-4"><div class="table-main-container">
                        <div class="table-box">
                            <h1>Resale Flate Price</h1>
                            <div class="table">
                                <table>
                                    <tr>
                                        <th colspan="2">Search Results</th>
                                    </tr>
                                    <tr>
                                        <td>HDB Town</td>
                                        <td><?= $town ?? '' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Flat Type</td>
                                        <td><?= $flat_type ?? '' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="table-box1">
                            <div class="filter-wrapper">
                                <div class="filter-buttons-box">
                                    <button type="button">Your Block</button>
                                    <button type="button">Your Custer</button>
                                </div>
                                <div class="filter-search-box">
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
                                </div>
                            </div>
                            <div class="table">
                                <table>
                                    <tr>
                                        <th>Sold Price</th>
                                        <th>Sold Month</th>
                                        <th>Address</th>
                                        <th>Area</th>
                                        <th>Level</th>
                                        <th>Remaining Lease</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    </section>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Variables
        let currentStep = 1;
        const totalSteps = 4;

        $(document).ready(function() {
            $('.btn-next').on('click', function() {
                if (!validateStep()) {
                    return;
                }

                nextStep();
            });

            $('select[name="town"], select[name="flat_type"], select[name="street"], input[name="block"], input[name="floor"], input[name="unit"]').on('change', function() {
                validateStep();
            })

            fetch("../util_data.php?action=getTowns")
                .then(response => response.json())
                .then(data => {
                    const townSelect = $('select[name="town"]');
                    townSelect.empty();
                    townSelect.append('<option value="">Select town</option>');
                    
                    data.forEach(item => {
                        townSelect.append(`<option value="${item.town}">${item.town}</option>`);
                    });
                })
                .catch(error => console.error("Error loading towns:", error));

            fetch("../util_data.php?action=getProjects")
                .then(response => response.json())
                .then(data => {
                    const streetSelect = $('select[name="street"]');
                    streetSelect.empty();
                    streetSelect.append('<option value="">Select street</option>');
                    
                    data.forEach(item => {
                        streetSelect.append(`<option value="${item.street}">${item.street}</option>`);
                    });
                })
                .catch(error => console.error("Error loading towns:", error));
        });

        function validateStep() {
            let isValid = true
            $('.error-message').text('');

            if (currentStep === 1) {
                const town = $('select[name="town"]').val();
                if (!town) {
                    $('#town-error').text('Please select an option.');
                    isValid = false;
                }

                const flatType = $('select[name="flat_type"]').val();
                if (!flatType) {
                    $('#flat-type-error').text('Please select an option.');
                    isValid = false;
                }

                const sell = $('select[name="sell"]').val();
                if (!sell) {
                    $('#sell-error').text('Please select an option.');
                    isValid = false;
                }
            }

            if (currentStep === 2) {
                const street = $('select[name="street"]').val();
                if (!street) {
                    $('#street-error').text('Please enter town');
                    isValid = false;
                }
                
                const block = $('input[name="block"]').val();
                if (!block) {
                    $('#block-error').text('Please enter block');
                    isValid = false;
                }

                const floor = $('input[name="floor"]').val();
                if (!floor) {
                    $('#floor-error').text('Please enter floor');
                    isValid = false;
                }
                if (floor && floor > 50) {
                    $('#floor-error').text('Please enter a floor number less than 50');
                    isValid = false;
                }
                
                const unit = $('input[name="unit"]').val();
                if (!unit) {
                    $('#unit-error').text('Please enter unit');
                    isValid = false;
                }
                if (unit && (unit.length < 2 || unit.length > 4)) {
                    $('#unit-error').text('Please enter a number between 2 and 4 digits');
                    isValid = false;
                }
            }
            
            return isValid;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.3/js/standalone/selectize.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Cursor follower effect
        function initCursorFollower() {
            const follower = document.querySelector('.cursor-follower');
            let mouseX = 0, mouseY = 0;
            let followerX = 0, followerY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                follower.style.opacity = '1';
            });

            function animate() {
                // Smooth following with easing
                followerX += (mouseX - followerX) * 0.1;
                followerY += (mouseY - followerY) * 0.1;

                if (follower) {
                    follower.style.left = `${followerX}px`;
                    follower.style.top = `${followerY}px`;
                }

                requestAnimationFrame(animate);
            }

            animate();

            // Hide follower when mouse leaves window
            document.addEventListener('mouseleave', () => {
                follower.style.opacity = '0';
            });

            document.addEventListener('mouseenter', () => {
                follower.style.opacity = '1';
            });
        }

        $(document).ready(function() {
            pageLoader('show');
            let first_request_url = '<?= $first_request_url ?>';
            let second_request_url = '<?= $second_request_url ?>'; 

            sendRequest(first_request_url)
                .then(function (records) {
                    // Handle records
                    // console.log('first',records) 
                    setDataIntoTable(records);
                    pageLoader('hide');
                })
                .catch(function (error) {
                    // Handle errors
                    if (error == 'No records found') {
                        sendRequest(second_request_url).then(function (records) {
                            // Handle records
                            // console.log('second',records)

                            setDataIntoTable(records);
                            pageLoader('hide');
                        })
                        .catch(function (error) {
                            // Handle errors
                            console.error(error);
                            pageLoader('hide');
                        });
                    }
                    // console.error(error);
                });

            function sendRequest(url) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data && data.result && data.result.records && data.result.records.length > 0) {
                                // Resolve the promise with the records
                                resolve(data.result.records);
                            } else {
                                // Reject the promise with a message
                                reject('No records found');
                            }
                        },
                        error: function () {
                            // Reject the promise with an error message
                            reject('Error fetching data');
                        }
                    });
                });
            }

            function setDataIntoTable(records){
                var filteredBlocks = [];
                var selectedBlock = '<?=$_POST['blk'] ?? "" ?>';

                var yourBlock = '';
                var yourCluster = '';
                
                if (records.length > 0) {
                    for (let index = 0; index < records.length; index++) {
                        const entry = records[index];
                        if (entry.block === selectedBlock) {
                            yourBlock += `<tr>
                                            <td>${formatCurrency(entry.resale_price)}</td>
                                            <td>${formatDate(entry.month)}</td>
                                            <td>${entry.block + ', ' + entry.street_name}</td>
                                            <td>${entry.floor_area_sqm } sqm</td>
                                            <td>${entry.storey_range}</td>
                                            <td>${entry.remaining_lease}</td>
                                        </tr>`;
                            yourCluster += `<tr>
                                    <td>${formatCurrency(entry.resale_price)}</td>
                                    <td>${formatDate(entry.month)}</td>
                                    <td>${entry.block + ', ' + entry.street_name}</td>
                                    <td>${entry.floor_area_sqm } sqm</td>
                                    <td>${entry.storey_range}</td>
                                    <td>${entry.remaining_lease}</td>
                                </tr>`;
                        }else{
                            yourCluster += `<tr>
                                    <td>${formatCurrency(entry.resale_price)}</td>
                                    <td>${formatDate(entry.month)}</td>
                                    <td>${entry.block + ', ' + entry.street_name}</td>
                                    <td>${entry.floor_area_sqm } sqm</td>
                                    <td>${entry.storey_range}</td>
                                    <td>${entry.remaining_lease}</td>
                                </tr>`;
                        }
                    }

                    let nav1 = $("#nav-block-tab");
                    let nav2 = $("#nav-cluster-tab");

                    let tab1 = $("#nav-block");
                    let tab2 = $("#nav-cluster");
                    
                    if (yourBlock) {
                        tab2.removeClass('show active');
                        nav2.removeClass('active');

                        tab1.addClass('show active');
                        nav1.addClass('active');
                        $("#example2 tbody").html(yourBlock);
                        new DataTable('#example2');
                    }

                    if (yourCluster) { 
                        $("#example tbody").html(yourCluster);
                        new DataTable('#example');
                    }

                    $('#show_total_records').html(`${records.length +' ('+formatDate2()+')'}`)

                    var myDiv = document.getElementById('table-guider');
                    if (window.innerWidth <= 767) {
                        // Show the div
                        myDiv.style.display = 'block';

                        // Hide the div after 5 seconds
                        setTimeout(function () {
                            myDiv.style.display = 'none';
                        }, 5000); // 5000 milliseconds = 5 seconds
                    }
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

            function formatDate2() {
                var currentDate = new Date();
                var day = currentDate.getDate();
                var month = currentDate.toLocaleString('en-US', { month: 'short' });
                var year = currentDate.getFullYear();

                // Add leading zero to day if necessary
                day = (day < 10) ? '0' + day : day;

                return day + ' ' + month + ' ' + year;
            }

            function pageLoader(status){
                if (status=="show") {
                    $('.loader-wrapper').removeClass('d-none');
                }else{
                    $('.loader-wrapper').addClass('d-none');
                }
            }
        }); 
    </script>
</body>
</html>

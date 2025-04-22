<?php

require_once('../report.php');

$town = $response['lead_details'][0]['lead_form_value'];
$block = $response['lead_details'][1]['lead_form_value'];
$unit = $response['lead_details'][4]['lead_form_value'];

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
                <div class="logo-text">Condo</div>
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
                    <div class="step-text">Valuation Condo</div>
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
                <form action="" method="POST" id="submit-form">
                    <input type="hidden" name="form_type" value="condo">
                    <input type="hidden" name="source_url" value="https://launchgovtest.homes/">
                    <input type="hidden" name="lead_id" id="lead_id" value="">

                    <!-- Step 1: Property Details -->
                    <section class="form-section active" id="step-1">
                        <div class="section-header">
                            <h1 class="section-title">When do you plan to sell your property? </h1>
                            <p class="section-subtitle">Understanding your timeline can <span class="Text-Lines">help us assist</span>  you better in making the right decisions</p>
                        </div>
    
                        <div class="form-group">
                            <!-- <label class="form-label">Property Status</label> -->
                            <div class="cards-grid" style="grid-template-columns: repeat(2, 1fr);">
                                <div class="option-card" data-value="1-3 months" onclick="selectCard(this, 'property-status', '1-3 months')">
                                    <div class="card-icon"><i class="fa-solid fa-face-smile"></i></div>
                                    <h3 class="card-title">1-3 months</h3>
                                    <!-- <p class="card-description">Brand new property</p> -->
                                    <div class="card-check"><i class="fas fa-check"></i></div>
                                </div>
    
                                <div class="option-card" data-value="3-6 months" onclick="selectCard(this, 'property-status', '3-6 months')">
                                    <div class="card-icon"><i class="fa-solid fa-house"></i></div>
                                    <h3 class="card-title">3-6 months</h3>
                                    <!-- <p class="card-description">Previously owned property</p> -->
                                    <div class="card-check"><i class="fas fa-check"></i></div>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="cards-grid" style="grid-template-columns: repeat(2, 1fr);">
                                <div class="option-card" data-value="6-12 months" onclick="selectCard(this, 'property-status', '6-12 months')">
                                    <div class="card-icon"><i class="fa-solid fa-file"></i></div>
                                    <h3 class="card-title">6-12 months</h3>
                                    <!-- <p class="card-description">Brand new property</p> -->
                                    <div class="card-check"><i class="fas fa-check"></i></div>
                                </div>
    
                                <div class="option-card" data-value="Exploring options" onclick="selectCard(this, 'property-status', 'Exploring options')">
                                    <div class="card-icon"><i class="fa-solid fa-bolt"></i></div>
                                    <h3 class="card-title">Exploring options</h3>
                                    <!-- <p class="card-description">Previously owned property</p> -->
                                    <div class="card-check"><i class="fas fa-check"></i></div>
                                </div>
                            </div>
                        </div>
    
                        <p class="error-message" id="sell-error"></p>
    
                        <div class="alert disclaimer-main-wrapper" style="background-color: var(--card);">
                            <div class="disclaimer-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
                            <div class="disclaimer-inner-wrapper">
                                <label class="form-label">Important Note:</label>
                                <p>This report uses reliable sources like URA trends, transaction reports, and X-Value for quick and precise property estimated valuations and provides your unit report.</p>
                            </div>
                        </div>
    
                        <p class="section-subtitle">Complete the questionnaire now for immediate results and exclusive access to the latest <span class="Text-Lines">2025 new launch units</span> from our partnering developers.</p>
    
                        <div class="buttons">
                            <div></div> <!-- Empty div for spacing -->
                            <button type="button" class="btn btn-next">
                                Continue <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </section>
    
                    <!-- Step 2: Household Scheme -->
                    <section class="form-section" id="step-2">
                        <div class="section-header">
                            <h1 class="section-title">Project Details </h1>
                            <p class="section-subtitle">Please provide the specific information about your property to help us assist you better.</p>
                        </div>
    
                        <div class="work-category">
                            <div class="form-group">
                                <label class="form-label">Town </label>
                                <div class="town-input">
                                    <select name="town" class="form-select ">
                                        <option value="">Select town</option>
                                    </select>
                                </div>
                                <p class="error-message" id="town-error"></p>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label">BLK </label>
                            <div class="block-input">
                                <select name="block" class="form-select ">
                                    <option value="">Select block</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <p class="error-message" id="block-error"></p>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label">What is your unit number?  </label>
                            <input type="text" name="unit" class="form-input" placeholder="Enter your unit number" >
                            <p class="error-message" id="unit-error"></p>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label">What is your floor number?  </label>
                            <input type="text" name="floor" class="form-input" placeholder="Enter your floor number">
                            <p class="error-message" id="floor-error"></p>
                        </div>
    
                        <div class="alert disclaimer-main-wrapper" style="background-color: var(--card);">
                            <div class="disclaimer-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
                            <div class="disclaimer-inner-wrapper">
                                <label class="form-label">Important Note:</label>
                                <p>This report uses reliable sources like URA trends, transaction reports, and X-Value for quick and precise property estimated valuations and provides your unit report.</p>
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
                                <span>I consent to the collection, use, and disclosure of my personal data for purposes as set out in our Privacy Policy. (View Policy)</span>
                            </label>
                            <p class="error-message" id="terms-error"></p>
                        </div>
    
                        <!-- error message -->
                        <p class="error-message" id=""></p>
    
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
                    <section class="form-section" id="step-4">
                        <div class="table-main-container">
                            <div class="table-box">
                                <h1>Resale Flate Price</h1>
                                <div class="table">
                                    <table>
                                        <tr>
                                            <th colspan="2">Search Results</th>
                                        </tr>
                                        <tr>
                                            <td>HDB Town</td>
                                            <td id="town-value"></td>
                                        </tr>
                                        <tr>
                                            <td>Block Number</td>
                                            <td id="block-value"></td>
                                        </tr>
                                        <tr>
                                            <td>Unit</td>
                                            <td id="unit-value"></td>
                                        </tr>
                                    </table>
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
        let sell = "";

        $(document).ready(function() {
            $('.btn-next').on('click', function() {
                if (!validateStep()) {
                    return;
                }

                nextStep();
            });

            $('select[name="town"], input[name="block"], input[name="floor"], input[name="unit"]').on('change', function() {
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
        });

        function validateStep() {
            let isValid = true
            $('.error-message').text('');

            if (currentStep === 1) {
                if (!sell) {
                    $('#sell-error').text('Please select an option.');
                    isValid = false;
                }
            }

            if (currentStep === 2) {
                const town = $('select[name="town"]').val();
                $('#town-value').html(town);
                if (!town) {
                    $('#town-error').text('Please enter town');
                    isValid = false;
                }
                
                const block = $('select[name="block"]').val();
                $('#block-value').html(block);
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
                $('#unit-value').html(unit);
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

        // Select card
        function selectCard(card, group, value) {
            // Deselect all cards in same group
            const cards = document.querySelectorAll(`.option-card[onclick*="${group}"]`);
            cards.forEach(c => c.classList.remove('selected'));
            
            // Select clicked card
            card.classList.add('selected');

            sell = value;
        }
    </script>
    <script src="../js/form.js"></script>
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
            let dataTable = initDataTable();

            function initDataTable(pageLength = 10) {
                $('#empTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '../util_project_data.php',
                        data: function (d) {
                            d.project = $('#project').val();
                        }
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

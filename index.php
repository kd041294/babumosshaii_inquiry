<?php
require './api/common/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Inquiry Form | BabuMosshaii</title>
    <link rel="icon" href="assets/logo.png" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --brand: #7b2cbf;
            /* Royal Purple */
            --brand-light: #9d4edd;
            --accent: #ffd166;
            /* Gold */
            --success: #06d6a0;
            /* Emerald */
            --cta: #ff6b6b;
            /* Coral CTA */
        }

        body {
            background: radial-gradient(circle at top, #f3e8ff, #fff 40%, #fdf2f8);
            font-family: 'Segoe UI', system-ui, -apple-system;
        }

        .form-card {
            max-width: 760px;
            margin: auto;
            position: relative;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #7b2cbf, #5a189a);
            color: #fff;
        }


        /* ================= WATERMARK SYSTEM ================= */
        /* Base logo */
        :root {
            --logo-url: url(<?= BASE_URL ?>.'/assets/logo.png');
        }

        /* Center watermark */
        .watermark-center {
            position: absolute;
            inset: 0;
            background: var(--logo-url) center/260px no-repeat;
            opacity: 0.06;
            pointer-events: none;
        }

        /* Repeating pattern */
        .watermark-pattern {
            position: absolute;
            inset: 0;
            background: var(--logo-url) repeat;
            background-size: 180px;
            opacity: 0.03;
            pointer-events: none;
        }

        /* Diagonal */
        .watermark-diagonal {
            position: absolute;
            inset: -50%;
            background: var(--logo-url) repeat;
            background-size: 200px;
            transform: rotate(-30deg);
            opacity: 0.03;
            pointer-events: none;
        }

        /* Corner logo */
        .watermark-corner {
            position: absolute;
            bottom: 15px;
            right: 15px;
            width: 90px;
            height: 90px;
            background: var(--logo-url) center/contain no-repeat;
            opacity: 0.15;
            pointer-events: none;
        }

        /* Floating logo */
        .watermark-float {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 70px;
            height: 70px;
            background: var(--logo-url) center/contain no-repeat;
            opacity: 0.25;
            animation: float 4s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-10px)
            }
        }

        /* Dark mode watermark */
        .dark-mode .watermark-center {
            opacity: 0.1;
            filter: invert(1);
        }

        /* =================================================== */

        .icon-input {
            position: relative;
            display: flex;
            align-items: center;
        }

        .icon-input i {
            position: absolute;
            left: 14px;
            color: var(--brand);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .icon-input input,
        .icon-input textarea,
        .icon-input select {
            padding-left: 48px;
            border-radius: 14px;
            min-height: 52px;
            /* FIXED HEIGHT = no shifting */
        }

        .icon-input input,
        .icon-input textarea,
        .icon-input select {
            padding-left: 44px;
            border-radius: 14px;
        }

        .section-title {
            font-weight: 700;
            font-size: .95rem;
            color: #5a189a;
            margin-top: 1.4rem;
            letter-spacing: .5px;
            text-transform: uppercase;
        }


        .btn-brand {
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            border: none;
            color: #fff;
            letter-spacing: .5px;
            transition: .3s ease;
        }

        .btn-brand:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 12px 28px rgba(255, 107, 107, .35);
        }



        .progress {
            height: 7px;
            border-radius: 10px;
            background: #e9d5ff;
        }

        .progress-bar {
            background: linear-gradient(90deg, #ffd166, #ff6b6b, #7b2cbf);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9d4edd;
            box-shadow: 0 0 0 .2rem rgba(157, 78, 221, .25);
        }

        /* ========== GLOBAL LOADER ========== */
        .global-loader {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(123, 44, 191, .95), rgba(255, 107, 107, .95));
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }

        .loader-content {
            text-align: center;
            color: #fff;
        }

        .loader-text {
            font-weight: 600;
            letter-spacing: .5px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: .6
            }

            50% {
                opacity: 1
            }

            100% {
                opacity: .6
            }
        }
    </style>
</head>

<body>
    <!-- Fullscreen Loader -->
    <div id="globalLoader" class="global-loader d-none">
        <div class="loader-content">
            <div class="spinner-border text-light" role="status"></div>
            <div class="loader-text mt-3">Submitting your inquiry...</div>
        </div>
    </div>
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4 form-card">
            <!-- WATERMARK LAYERS -->
            <div class="watermark-center"></div>
            <div class="watermark-pattern"></div>
            <div class="watermark-diagonal"></div>
            <div class="watermark-corner"></div>
            <div class="watermark-float"></div>
            <!-- END WATERMARKS -->

            <div class="card-header form-header text-center rounded-top-4 py-4">
                <h4 class="mb-1 fw-bold"><i class="bi bi-calendar2-heart"></i> Event Inquiry</h4>
                <p class="mb-0 small opacity-75">Tell us about your event — we’ll handle the rest ✨</p>
                <div class="progress mt-3">
                    <div class="progress-bar" id="formProgress" style="width:20%"></div>
                </div>
            </div>

            <div class="card-body p-4">
                <div id="eventForm">

                    <div class="section-title">Contact Details</div>

                    <div class="mb-3 icon-input">
                        <i class="bi bi-person"></i>
                        <input type="text" id="full_name" class="form-control" placeholder="Full Name" />
                        <div class="text-danger small mt-1 error" id="err_full_name"></div>
                    </div>

                    <div class="mb-3 icon-input">
                        <i class="bi bi-telephone"></i>
                        <input type="tel" id="contact" class="form-control" placeholder="What's App Contact Number" maxlength="10" />
                        <div class="text-danger small mt-1 error" id="err_contact"></div>
                    </div>

                    <div class="mb-3 icon-input">
                        <i class="bi bi-envelope"></i>
                        <input type="email" id="email" class="form-control" placeholder="Email Address" />
                        <div class="text-danger small mt-1 error" id="err_email"></div>
                    </div>

                    <div class="section-title">Event Details</div>
                    <div class="mt-3 icon-input mb-3">
                        <i class="bi bi-calendar-event"></i>
                        <input type="date" id="event_date" class="form-control" placeholder="Event Date" />
                        <div class="text-danger small mt-1 error" id="err_event_date"></div>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="icon-input">
                                <i class="bi bi-people"></i>
                                <input type="number" id="total_guests" class="form-control" placeholder="Total Guests" />
                                <div class="text-danger small mt-1 error" id="err_total_guests"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon-input">
                                <i class="bi bi-currency-rupee"></i>
                                <input type="number" id="budget" class="form-control" placeholder="Expected Budget" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 icon-input">
                        <i class="bi bi-geo-alt"></i>
                        <input type="text" id="location" class="form-control" placeholder="Event Location with Pincode" />
                        <div class="text-danger small mt-1 error" id="err_location"></div>
                    </div>

                    <div class="mt-3 icon-input">
                        <i class="bi bi-stars"></i>
                        <select class="form-select" name="event_type" id="event_type">
                            <option value="">Select event type</option>
                            <?php foreach ($event_type as $type): ?>
                                <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="text-danger small mt-1 error" id="err_event_type"></div>
                    </div>

                    <div class="section-title">Food & Preferences</div>

                    <div class="mb-3 icon-input">
                        <i class="bi bi-journal-text"></i>
                        <textarea id="menu" class="form-control" rows="3" placeholder="Preferred Menu / Cuisine"></textarea>
                    </div>

                    <div class="mb-3 icon-input">
                        <i class="bi bi-chat-dots"></i>
                        <textarea id="notes" class="form-control" rows="3" placeholder="Additional Notes"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="bi bi-upload"></i> Upload Menu File</label>
                        <input type="file" id="menu_file" class="form-control rounded-3" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="text-danger small mt-1 error" id="err_file"></div>
                    </div>

                    <div class="d-grid mt-4">
                        <button id="submitBtn" type="button" class="btn btn-brand btn-lg rounded-pill shadow">
                            <i class="bi bi-send"></i> Submit Inquiry
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Dynamic Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 text-center d-block">
                    <div id="statusIcon" class="fs-1 mb-2"></div>
                    <h5 class="modal-title fw-bold" id="statusTitle"></h5>
                </div>
                <div class="modal-body text-center">
                    <p id="statusMessage" class="mb-0"></p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-brand rounded-pill px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/inquiry_form.js"></script>
</body>

</html>
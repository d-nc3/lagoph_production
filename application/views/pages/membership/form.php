<?php

// Get data from session (if available) or fallback to the membership array

$user_email = $this->session->userdata('user_email') ? $this->session->userdata('user_email') : $membership['email'];

$first_name = $this->session->userdata('first_name') ? $this->session->userdata('first_name') : $membership['first_name'];

$last_name = $this->session->userdata('last_name') ? $this->session->userdata('last_name') : $membership['last_name'];

$middle_name = isset($membership['middle_name']) ? $membership['middle_name'] : NULL;

$sex = isset($membership['sex']) ? $membership['sex'] : NULL;

$date_of_birth = isset($membership['date_of_birth']) ? $membership['date_of_birth'] : NULL;

$civil_status = isset($membership['civil_status']) ? $membership['civil_status'] : NULL;

$place_of_birth = isset($membership['place_of_birth']) ? $membership['place_of_birth'] : NULL;

$mobile_number = isset($membership['mobile_number']) ? $membership['mobile_number'] : NULL;

$address = isset($membership['address']) ? $membership['address'] : NULL;

$tel_number = isset($membership['tel_number']) ? $membership['tel_number'] : NULL;



// Spouse Information (if applicable)

$spouse_name = isset($membership['spouse_name']) ? $membership['spouse_name'] : NULL;

$spouse_occupation = isset($membership['spouse_occupation']) ? $membership['spouse_occupation'] : NULL;

$spouse_mobile_number = isset($membership['spouse_mobile_number']) ? $membership['spouse_mobile_number'] : NULL;



?>

<?php $this->load->view('layout/header') ?>



<!-- Layout wrapper -->

<div class="layout-wrapper layout-content-navbar">

  <div class="layout-container">

    <?php $this->load->view('layout/sidenav'); ?>

    <!-- Layout container -->

    <div class="layout-page">

      <?php $this->load->view('layout/navbar'); ?>

      <!-- Content wrapper -->

      <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">

          <h4 class="py-3 mb-4">Information Sheet</h4>

          <div id="multiStepsValidation" class="bs-stepper vertical mt-2">

            <div class="bs-stepper-header">

              <div class="line"></div>

              <div class="step" data-target="#personal-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-user"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Personal Information</span>

                    <span class="bs-stepper-subtitle">Your Name/Email</span>

                  </span>

                </button>

              </div>

              <div class="line"></div>

              <div class="step" data-target="#beneficiary-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-group"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Beneficiary Details</span>

                    <span class="bs-stepper-subtitle">Your Beneficiaries</span>

                  </span>

                </button>

              </div>

              <div class="line"></div>

              <div class="step" data-target="#educational-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-home"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Educational Background</span>

                    <span class="bs-stepper-subtitle">Your Institution/University</span>

                  </span>

                </button>

              </div>

              <div class="line"></div>

              <div class="step" data-target="#employment-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-star"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Work Experience</span>

                    <span class="bs-stepper-subtitle">Your Work Background</span>

                  </span>

                </button>

              </div>

              <div class="line"></div>

              <div class="step" data-target="#other-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-map"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Other Information</span>

                    <span class="bs-stepper-subtitle">Your background Records</span>

                  </span>

                </button>

              </div>

              <div class="line"></div>

              <div class="step" data-target="#attachment-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-file"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Attachments</span>

                    <span class="bs-stepper-subtitle">Your Supporting Documents</span>

                  </span>

                </button>

              </div>

              <div class="line"></div>

              <div class="step" data-target="#oath-of-membership">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-user"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Oath of Membership</span>

                    <span class="bs-stepper-subtitle">Membership</span>

                  </span>

                </button>

              </div>

              <div class="step" data-target="#oath-of-contribution">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-user"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Oath of Contribution</span>

                    <span class="bs-stepper-subtitle">Capital Contribution</span>

                  </span>

                </button>

              </div>

              <div class="step" data-target="#membership-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-file"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Membership Data</span>

                    <span class="bs-stepper-subtitle">Payments and Accountabilities</span>

                  </span>

                </button>

              </div>

              <div class="line"></div>

              <div class="step" data-target="#review-details">

                <button type="button" class="step-trigger">

                  <span class="bs-stepper-circle">

                    <i class="bx bx-file"></i>

                  </span>

                  <span class="bs-stepper-label">

                    <span class="bs-stepper-title">Review & Submit</span>

                    <span class="bs-stepper-subtitle">Review your details and Submit</span>

                  </span>

                </button>

              </div>

            </div>



            <div class="bs-stepper-content">

              <form id="form" onSubmit="return false">



                <div id="personal-details" class="content">

                  <h4 class="py-1 mb-4">Personal Information</h4>

                  <div class="row g-3">



                    <div class="col-sm-6">

                      <label class="form-label" for="firstName">First Name</label>

                      <input type="text" id="firstName" name="first_name"

                        value="<?= isset($first_name) ? htmlspecialchars($first_name) : '' ?>" class="form-control"

                        placeholder="John" readonly />

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="lastName">Surname</label>

                      <input type="text" id="lastName" name="last_name"

                        value="<?= isset($last_name) ? htmlspecialchars($last_name) : '' ?>" class="form-control"

                        placeholder="Doe" readonly />

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="middleName">Middle Name</label>

                      <input type="text" id="middleName" name="middle_name"

                        value="<?= isset($middle_name) ? htmlspecialchars($middle_name) : '' ?>" class="form-control"

                        placeholder="Ford" />

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label">Sex Assigned at birth</label>

                      <div class="form-check custom mb-2">

                        <input type="radio" id="radioOptionMale" name="sex" value="Male" class="form-check-input"

                          <?= (isset($sex) && $sex === 'Male') ? 'checked' : '' ?> />

                        <label class="form-check-label" for="radioOptionMale">Male</label>

                      </div>

                      <div class="form-check custom mb-2">

                        <input type="radio" id="radioOptionFemale" name="sex" value="Female" class="form-check-input"

                          <?= (isset($sex) && $sex === 'Female') ? 'checked' : '' ?> />

                        <label class="form-check-label" for="radioOptionFemale">Female</label>

                      </div>

                      <div class="form-check custom mb-2">

                        <input type="radio" id="radioOptionIntersex" name="sex" value="Intersex"

                          class="form-check-input" <?= (isset($sex) && $sex === 'Intersex') ? 'checked' : '' ?> />

                        <label class="form-check-label" for="radioOptionIntersex">Intersex</label>

                      </div>

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="birthDate">Date of Birth</label>

                      <input type="date" class="form-control flatpickr-validation" id="birthDate" name="date_of_birth"

                        value="<?= isset($date_of_birth) ? $date_of_birth : '' ?>" />

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="civilStatus">Civil Status</label>

                      <select id="civilStatus" name="civil_status" class="select2 form-select" data-hide-filter="true"

                        data-allow-clear="false">

                        <option value=""></option>

                        <option value="Single" <?= (isset($civil_status) && $civil_status == 'Single') ? 'selected' : '' ?>>Single</option>

                        <option value="Married" <?= (isset($civil_status) && $civil_status == 'Married') ? 'selected' : '' ?>>Married</option>

                        <option value="Widowed" <?= (isset($civil_status) && $civil_status == 'Widowed') ? 'selected' : '' ?>>Widowed</option>

                        <option value="Legally Separated" <?= (isset($civil_status) && $civil_status == 'Legally Separated') ? 'selected' : '' ?>>Legally Separated</option>

                      </select>

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="birthPlace">Place Of Birth</label>

                      <select id="birthPlace" name="place_of_birth" class="select2-search form-select"

                        data-allow-clear="false">

                        <option value=""></option>

                        <?php

                        $regions = [

                          'NCR' => 'National Capital Region (NCR)',

                          'CAR' => 'Cordillera Administrative Region (CAR)',

                          'Region I' => 'Ilocos Region (Region I)',

                          'Region II' => 'Cagayan Valley (Region II)',

                          'Region III' => 'Central Luzon (Region III)',

                          'Region IV-A' => 'Calabarzon (Region IV-A)',

                          'Region IV-B' => 'Southwestern Tagalog Region (Region IV-B)',

                          'Region V' => 'Bicol Region (Region V)',

                          'Region VI' => 'Western Visayas (Region VI)',

                          'Region VII' => 'Central Visayas (Region VII)',

                          'Region VIII' => 'Eastern Visayas (Region VIII)',

                          'Region IX' => 'Zamboanga Peninsula (Region IX)',

                          'Region X' => 'Northern Mindanao (Region X)',

                          'Region XI' => 'Davao Region (Region XI)',

                          'Region XII' => 'Soccsksargen (Region XII)',

                          'Region XIII' => 'Caraga (Region XIII)',

                          'BARMM' => 'Bangsamoro (BARMM)'

                        ];

                        foreach ($regions as $code => $name) {

                          $selected = (isset($place_of_birth) && $place_of_birth === $code) ? 'selected' : '';

                          echo "<option value=\"$code\" $selected>$name</option>";

                        }

                        ?>

                      </select>

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="mobileNo">Mobile Number</label>

                      <div class="input-group input-group-merge">

                        <span class="input-group-text">PH (+63)</span>

                        <input type="text" id="mobileNo" name="mobile_number" class="form-control mobile-number-mask"

                          maxlength="12" placeholder="955 501 1022"

                          value="<?= isset($mobile_number) ? htmlspecialchars($mobile_number) : '' ?>" />

                      </div>

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="address">Address</label>

                      <textarea id="address" name="address" class="form-control" rows="2"

                        placeholder="Unit/Building, Street, Barangay, Municipality/City, Province"><?= isset($address) ? htmlspecialchars($address) : '' ?></textarea>

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="telNo">Tel Number</label>

                      <div class="input-group input-group-merge">

                        <input type="text" id="telNo" name="tel_number" class="form-control tel-number-mask"

                          maxlength="8" placeholder="XXXXYYYY"

                          value="<?= isset($tel_number) ? htmlspecialchars($tel_number) : '' ?>" />

                      </div>

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="email">Email</label>

                      <input type="email" id="email" name="email"

                        value="<?= isset($user_email) ? htmlspecialchars($user_email) : '' ?>" class="form-control"

                        placeholder="john.doe" aria-label="john.doe@gmail.com" readonly />

                    </div>

                    <div class="divider">

                      <div class="divider-text">Spouse Information (If applicable)</div>

                    </div>

                    <div class="col-sm-12">

                      <label class="form-label" for="spouseName">Name Of Spouse</label>

                      <input type="text" id="spouseName" name="spouse_name" class="form-control" placeholder="John Doe"

                        value="<?= isset($spouse_name) ? htmlspecialchars($spouse_name) : '' ?>" />

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="spouseOccupation">Occupation</label>

                      <input type="text" id="spouseOccupation" name="spouse_occupation" class="form-control"

                        placeholder="eg. Foreman"

                        value="<?= isset($spouse_occupation) ? htmlspecialchars($spouse_occupation) : '' ?>" />

                    </div>

                    <div class="col-sm-6">

                      <label class="form-label" for="spouseMobileNo">Mobile Number</label>

                      <div class="input-group input-group-merge">

                        <span class="input-group-text">PH (+63)</span>

                        <input type="text" id="spouseMobileNo" name="spouse_mobile_number"

                          class="form-control mobile-number-mask" maxlength="12" placeholder="955 501 1022"

                          value="<?= isset($spouse_mobile_number) ? htmlspecialchars($spouse_mobile_number) : '' ?>" />

                      </div>

                    </div>

                    <div class="col-12 d-flex justify-content-end">

                      <button class="btn btn-primary btn-next">

                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                      </button>

                    </div>

                  </div>

                </div>





                <!-- Beneficiary Details -->

                <div id="beneficiary-details" class="content">

                  <h4 class="py-1 mb-4">Beneficiaries <span class="text-muted"> (Please delete if not applicable)</span>

                  </h4>



                  <div class="row g-2">

                    <div class="beneficiaries-form-repeater">

                      <div data-repeater-list="beneficiaries">

                        <?php if (!empty($beneficiaries)): ?>

                          <?php foreach ($beneficiaries as $beneficiary): ?>

                            <div data-repeater-item>

                              <div class="row g-1">

                                <input type="hidden" name="id" value="<?= $beneficiary['id'] ?>" />

                                <div class="mb-3 col-lg-12 col-xl-6 col-12 mb-0">

                                  <label class="form-label">Name</label>

                                  <input type="text" name="name" class="form-control name" placeholder="John Doe"

                                    value="<?= $beneficiary['name'] ?>" />

                                </div>

                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">

                                  <label class="form-label">Date of Birth</label>

                                  <input type="date" class="form-control dob" name="date_of_birth"

                                    value="<?= $beneficiary['date_of_birth'] ?>" />

                                </div>

                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">

                                  <label class="form-label">Relationship</label>

                                  <select name="relationship_type" class="form-select rel">

                                    <option value="">Select value</option>

                                    <?php

                                    $relations = ['Mother', 'Father', 'Son', 'Daughter', 'Sibling'];

                                    foreach ($relations as $rel):

                                      $selected = ($beneficiary['relationship_type'] == $rel) ? 'selected' : '';

                                      echo "<option value=\"$rel\" $selected>$rel</option>";

                                    endforeach;

                                    ?>

                                  </select>

                                </div>

                                <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">

                                  <button class="btn btn-label-danger mt-4" data-repeater-delete>

                                    <i class="bx bx-x me-1"></i>

                                    <span class="align-middle">Delete</span>

                                  </button>

                                </div>

                              </div>

                              <hr />

                            </div>

                          <?php endforeach; ?>

                        <?php else: ?>

                          <!-- Show one blank row if there are no beneficiaries -->

                          <div data-repeater-item>

                            <div class="row g-1">

                              <input type="hidden" name="id" />

                              <div class="mb-3 col-lg-12 col-xl-6 col-12 mb-0">

                                <label class="form-label">Name</label>

                                <input type="text" name="name" class="form-control name" placeholder="John Doe" />

                              </div>

                              <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">

                                <label class="form-label">Date of Birth</label>

                                <input type="date" class="form-control dob" name="date_of_birth" />

                              </div>

                              <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">

                                <label class="form-label">Relationship</label>

                                <select name="relationship_type" class="form-select rel">

                                  <option value="">Select value</option>

                                  <option value="Mother">Mother</option>

                                  <option value="Father">Father</option>

                                  <option value="Son">Son</option>

                                  <option value="Daughter">Daughter</option>

                                  <option value="Sibling">Sibling</option>

                                </select>

                              </div>

                              <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">

                                <button class="btn btn-label-danger mt-4" data-repeater-delete>

                                  <i class="bx bx-x me-1"></i>

                                  <span class="align-middle">Delete</span>

                                </button>

                              </div>

                            </div>

                            <hr />

                          </div>

                        <?php endif; ?>

                      </div>



                      <div class="mb-0">

                        <button class="btn btn-primary" data-repeater-create>

                          <i class="bx bx-plus me-1"></i>

                          <span class="align-middle">Add</span>

                        </button>

                      </div>

                    </div>



                    <div class="col-12 d-flex justify-content-between">

                      <button class="btn btn-primary btn-prev">

                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                        <span class="align-middle d-sm-inline-block d-none">Previous</span>

                      </button>

                      <button class="btn btn-primary btn-next">

                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                      </button>

                    </div>

                  </div>

                </div>





                <!-- Educational Details -->

                <div id="educational-details" class="content">

                  <h4 class="py-1 mb-4">

                    Educational Background

                    <span class="text-muted"> (Leave blank if not applicable)</span>

                  </h4>

                  <div class="row g-2">

                    <!-- Elementary -->

                    <div class="row g-1">

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="educ-background-1-level">&nbsp;</label>

                        <div class="input-group">

                          <span class="input-group-text"><b>LEVEL</b></span>

                          <input type="text" id="educ-background-1-level" name="educ_background[0][level]"

                            class="form-control" value="Elementary" readonly />

                        </div>

                      </div>

                      <div class="mb-3 col-md-4">

                        <label class="form-label" for="educ-background-1-course">Basic Education / Course</label>

                        <input type="text" id="educ-background-1-course" name="educ_background[0][education_course]"

                          class="form-control" placeholder="Grade School"

                          value="<?= htmlspecialchars($educ_background[0]['education_course'] ?? '') ?>" />

                      </div>

                      <input type="text" id="educ_id" name="educ-id"

                        value="<?= htmlspecialchars($educ_background[0]['id'] ?? '') ?>" hidden />

                      <div class="mb-3 col-md-5">

                        <label class="form-label" for="educ-background-1-school">Name of School / Institution</label>

                        <input type="text" id="educ-background-1-school" name="educ_background[0][school_institution]"

                          class="form-control" placeholder="School/Institution"

                          value="<?= htmlspecialchars($educ_background[0]['school_institution'] ?? '') ?>" />

                      </div>

                    </div>



                    <!-- Secondary -->

                    <div class="row g-1">

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="educ-background-2-level">&nbsp;</label>

                        <div class="input-group">

                          <span class="input-group-text"><b>LEVEL</b></span>

                          <input type="text" id="educ-background-2-level" name="educ_background[1][level]"

                            class="form-control" value="Secondary" readonly />

                        </div>

                      </div>

                      <div class="mb-3 col-md-4">

                        <label class="form-label" for="educ-background-2-course">Basic Education / Course</label>

                        <input type="text" id="educ-background-2-course" name="educ_background[1][education_course]"

                          class="form-control" placeholder="High School"

                          value="<?= htmlspecialchars($educ_background[1]['education_course'] ?? '') ?>" />

                      </div>

                      <div class="mb-3 col-md-5">

                        <label class="form-label" for="educ-background-2-school">Name of School / Institution</label>

                        <input type="text" id="educ-background-2-school" name="educ_background[1][school_institution]"

                          class="form-control" placeholder="School/Institution"

                          value="<?= htmlspecialchars($educ_background[1]['school_institution'] ?? '') ?>" />

                      </div>

                    </div>

                    <!-- Tertiary -->

                    <div class="row g-1">

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="educ-background-4-level">&nbsp;</label>

                        <div class="input-group">

                          <span class="input-group-text"><b>LEVEL</b></span>

                          <input type="text" id="educ-background-4-level" name="educ_background[3][level]"

                            class="form-control" value="Tertiary" readonly />

                        </div>

                      </div>

                      <div class="mb-3 col-md-4">

                        <label class="form-label" for="educ-background-4-course">Basic Education / Course</label>

                        <input type="text" id="educ-background-4-course" name="educ_background[3][education_course]"

                          class="form-control" placeholder="BSIT"

                          value="<?= htmlspecialchars($educ_background[2]['education_course'] ?? '') ?>" />

                      </div>

                      <div class="mb-3 col-md-5">

                        <label class="form-label" for="educ-background-4-school">Name of School / Institution</label>

                        <input type="text" id="educ-background-4-school" name="educ_background[3][school_institution]"

                          class="form-control" placeholder="School/Institution"

                          value="<?= htmlspecialchars($educ_background[2]['school_institution'] ?? '') ?>" />

                      </div>

                    </div>



                    <!-- Vocational -->

                    <div class="row g-1">

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="educ-background-3-level">&nbsp;</label>

                        <div class="input-group">

                          <span class="input-group-text"><b>LEVEL</b></span>

                          <input type="text" id="educ-background-3-level" name="educ_background[2][level]"

                            class="form-control" value="Vocational" readonly />

                        </div>

                      </div>

                      <div class="mb-3 col-md-4">

                        <label class="form-label" for="educ-background-3-course">Basic Education / Course</label>

                        <input type="text" id="educ-background-3-course" name="educ_background[2][education_course]"

                          class="form-control" placeholder="NCII"

                          value="<?= htmlspecialchars($educ_background[3]['education_course'] ?? '') ?>" />

                      </div>

                      <div class="mb-3 col-md-5">

                        <label class="form-label" for="educ-background-3-school">Name of School / Institution</label>

                        <input type="text" id="educ-background-3-school" name="educ_background[2][school_institution]"

                          class="form-control" placeholder="School/Institution"

                          value="<?= htmlspecialchars($educ_background[3]['school_institution'] ?? '') ?>" />

                      </div>

                    </div>





                    <!-- Graduate -->

                    <div class="row g-1">

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="educ-background-5-level">&nbsp;</label>

                        <div class="input-group">

                          <span class="input-group-text"><b>LEVEL</b></span>

                          <input type="text" id="educ-background-5-level" name="educ_background[4][level]"

                            class="form-control" value="Graduate Studies" readonly />

                        </div>

                      </div>

                      <div class="mb-3 col-md-4">

                        <label class="form-label" for="educ-background-5-course">Basic Education / Course</label>

                        <input type="text" id="educ-background-5-course" name="educ_background[4][education_course]"

                          class="form-control" placeholder="MBA"

                          value="<?= htmlspecialchars($educ_background[4]['education_course'] ?? '') ?>" />

                      </div>

                      <div class="mb-3 col-md-5">

                        <label class="form-label" for="educ-background-5-school">Name of School / Institution</label>

                        <input type="text" id="educ-background-5-school" name="educ_background[4][school_institution]"

                          class="form-control" placeholder="School/Institution"

                          value="<?= htmlspecialchars($educ_background[4]['school_institution'] ?? '') ?>" />

                      </div>

                    </div>



                    <div class="col-12 d-flex justify-content-between">

                      <button class="btn btn-primary btn-prev" type="button">

                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                        <span class="align-middle d-sm-inline-block d-none">Previous</span>

                      </button>

                      <button class="btn btn-primary btn-next" type="button">

                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                      </button>

                    </div>



                  </div>

                </div>





                <!-- Employment Details -->

                <div id="employment-details" class="content">

                  <h4 class="py-1 mb-4">Work Experience</h4>

                  <div class="row g-2">

                    <!-- Current Work Experience -->

                    <div class="row g-1">

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="work-exp-1-status">&nbsp;</label>

                        <div class="input-group">

                          <span class="input-group-text"><b>STATUS</b></span>

                          <input type="text" id="work-exp-1-status" name="work_experience[0][employment_status]"

                            class="form-control" value="Current" readonly />

                        </div>

                      </div>

                      <div class="mb-3 col-md-4">

                        <label class="form-label" for="work-exp-1-office">Office / Company</label>

                        <input type="text" id="work-exp-1-office" name="work_experience[0][office_company]"

                          class="form-control"

                          value="<?= isset($work_experience[0]['office']) ? htmlspecialchars($work_experience[0]['office']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-5">

                        <label class="form-label" for="work-exp-1-occupation">Occupation / Designation</label>

                        <input type="text" id="work-exp-1-occupation" name="work_experience[0][occupation_designation]"

                          class="form-control"

                          value="<?= isset($work_experience[0]['occupation']) ? htmlspecialchars($work_experience[0]['occupation']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="work-exp-1-income">Monthly Salary / Income</label>

                        <input type="number" id="work-exp-1-income" name="work_experience[0][salary_income]"

                          class="form-control"

                          value="<?= isset($work_experience[0]['income']) ? htmlspecialchars($work_experience[0]['income']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="work-exp-1-tel-no">Telephone No.</label>

                        <input type="text" id="work-exp-1-tel-no" name="work_experience[0][tel_number]"

                          class="form-control"

                          value="<?= isset($work_experience[0]['tel_no']) ? htmlspecialchars($work_experience[0]['tel_no']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-6">

                        <label class="form-label" for="work-exp-1-addr">Business Address</label>

                        <input type="text" id="work-exp-1-addr" name="work_experience[0][address]" class="form-control"

                          value="<?= isset($work_experience[0]['address']) ? htmlspecialchars($work_experience[0]['address']) : '' ?>" />

                      </div>

                    </div>



                    <hr />



                    <!-- Previous Work Experience -->

                    <div class="row g-1">

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="work-exp-2-status">&nbsp;</label>

                        <div class="input-group">

                          <span class="input-group-text"><b>STATUS</b></span>

                          <input type="text" id="work-exp-2-status" name="work_experience[1][employment_status]"

                            class="form-control" value="Previous" readonly />

                        </div>

                      </div>

                      <div class="mb-3 col-md-4">

                        <label class="form-label" for="work-exp-2-office">Office / Company</label>

                        <input type="text" id="work-exp-2-office" name="work_experience[1][office_company]"

                          class="form-control"

                          value="<?= isset($work_experience[1]['office']) ? htmlspecialchars($work_experience[1]['office']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-5">

                        <label class="form-label" for="work-exp-2-occupation">Occupation / Designation</label>

                        <input type="text" id="work-exp-2-occupation" name="work_experience[1][occupation_designation]"

                          class="form-control"

                          value="<?= isset($work_experience[1]['occupation']) ? htmlspecialchars($work_experience[1]['occupation']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="work-exp-2-income">Monthly Salary / Income</label>

                        <input type="number" id="work-exp-2-income" name="work_experience[1][salary_income]"

                          class="form-control"

                          value="<?= isset($work_experience[1]['income']) ? htmlspecialchars($work_experience[1]['income']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-3">

                        <label class="form-label" for="work-exp-2-tel-no">Telephone No.</label>

                        <input type="text" id="work-exp-2-tel-no" name="work_experience[1][tel_number]"

                          class="form-control"

                          value="<?= isset($work_experience[1]['tel_no']) ? htmlspecialchars($work_experience[1]['tel_no']) : '' ?>" />

                      </div>

                      <div class="mb-3 col-md-6">

                        <label class="form-label" for="work-exp-2-addr">Business Address</label>

                        <input type="text" id="work-exp-2-addr" name="work_experience[1][address]" class="form-control"

                          value="<?= isset($work_experience[1]['address']) ? htmlspecialchars($work_experience[1]['address']) : '' ?>" />

                      </div>

                    </div>

                  </div>

                  

                    <div class="col-12 d-flex justify-content-between">

                      <button class="btn btn-primary btn-prev">

                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                        <span class="align-middle d-sm-inline-block d-none">Previous</span>

                      </button>

                      <button class="btn btn-primary btn-next">

                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                      </button>

                    </div>

                </div>





                <!-- Other Details -->

                <div id="other-details" class="content">

                  <h4 class="py-1 mb-4">Other Details</h4>

                  <div class="row g-3">

                    <div class="col-sm-12">

                      <label class="form-label">Have you ever been found guilty of any administrative offense?</label>

                      <div class="form-check custom mb-2">

                        <input type="radio" id="offenseRadioOptionYes" name="has_admin_offense" value="Yes"

                          class="form-check-input" />

                        <label class="form-check-label" for="offenseRadioOptionYes">Yes</label>

                      </div>

                      <div class="form-check custom">

                        <input type="radio" id="offenseRadioOptionNo" name="has_admin_offense" value="No"

                          class="form-check-input" />

                        <label class="form-check-label" for="offenseRadioOptionNo">No</label>

                      </div>

                    </div>

                    <div class="col-sm-12 d-none has-offense">

                      <label class="form-label" for="admin_offense">Please provide the details below.</label>

                      <textarea id="admin_offense" name="admin_offense" class="form-control" rows="4"></textarea>

                    </div>



                    <div class="col-sm-12">

                      <label class="form-label">Have you ever been charged or convicted of any crime by any court or

                        tribunal?</label>

                      <div class="form-check custom mb-2">

                        <input type="radio" id="convictedRadioOptionYes" name="is_convicted" value="Yes"

                          class="form-check-input" />

                        <label class="form-check-label" for="convictedRadioOptionYes">Yes</label>

                      </div>

                      <div class="form-check custom">

                        <input type="radio" id="convictedRadioOptionNo" name="is_convicted" value="No"

                          class="form-check-input" />

                        <label class="form-check-label" for="convictedRadioOptionNo">No</label>

                      </div>

                    </div>



                    <div class="col-sm-12 d-none is-convicted">

                      <label class="form-label" for="convicted">Please provide the details below.</label>

                      <textarea id="convicted" name="convicted" class="form-control" rows="4"></textarea>

                    </div>



                    <div class="col-12 d-flex justify-content-between">

                      <button class="btn btn-primary btn-prev">

                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                        <span class="align-middle d-sm-inline-block d-none">Previous</span>

                      </button>

                      <button class="btn btn-primary btn-next">

                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                      </button>

                    </div>

                  </div>

                </div>



                <div id="attachment-details" class="content">

                  <h4 class="py-1 mb-2">Attachments</h4>

                  <div class="mb-3">

                    <p class="text-muted">

                      Upload clear and valid files for each item below. follow the required format (jpg or pdf). unclear

                      or missing files may delay your application.

                    </p>

                  </div>



                  <ol>

                    <li>

                      <div class="mb-3 col-12 mb-0">

                        <p>Proof of identity <span class="text-muted">(government id with photo, jpg only)</span></p>

                        <input type="file" id="attachments-proof-of-identity" name="attachments[proof_of_identity]"

                          class="form-control" accept=".jpg,.jpeg" single />

                      </div>

                    </li>

                    <li>

                      <div class="mb-3 col-12 mb-0">

                        <p>Proof of date of birth <span class="text-muted">(psa or id with birth date, pdf

                            preferred)</span></p>

                        <input type="file" id="attachments-proof-of-dob" name="attachments[proof_of_dob]"

                          class="form-control" accept=".jpg,.jpeg,.pdf" single />

                      </div>

                    </li>

                    <li>

                      <div class="mb-3 col-12 mb-0">

                        <p>Proof of address <span class="text-muted">(billing or id with address, pdf preferred)</span>

                        </p>

                        <input type="file" id="attachments-proof-of-addr" name="attachments[proof_of_addr]"

                          class="form-control" accept=".jpg,.jpeg,.pdf" single />

                      </div>

                    </li>

                    <li>

                      <div class="mb-3 col-12 mb-0">

                        <p>2x2 id photo <span class="text-muted">(white background, jpg only)</span></p>

                        <input type="file" id="attachments-prof-pic" name="attachments[profile_pic]"

                          class="form-control" accept=".jpg,.jpeg" single />

                      </div>

                    </li>

                  </ol>



                  <div class="col-12 d-flex justify-content-between">

                    <button class="btn btn-primary btn-prev">

                      <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                      <span class="align-middle d-sm-inline-block d-none">Previous</span>

                    </button>

                    <button class="btn btn-primary btn-next">

                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                      <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                    </button>

                  </div>

                </div>



                <!-- Current Workflow modification -->

                <div id="oath-of-membership" class="content">

                  <h4 class="py-1 mb-4">Membership Oath</h4>

                  <div class="row g-3">

                    <p>I hereby apply for membership in the LAGOPH. I agree to faithfully

                      abide by the rules and regulations set forth in its Articles of Incorporation and By-Laws.</p>



                    <p><strong>In view of that, I pledge to:</strong></p>

                    <ul class="ms-4">

                      <li>Attend and finish the prescribed Pre-Membership Education Seminar (PMES);</li>

                      <li>Pay the membership fee of Five Hundred Pesos (P500.00);</li>

                      <li>Participate in the savings, credit, and loans programs, and other associated services of the

                        Cooperative;</li>

                      <li>Subscribe for at least Ten (10) Shares and pay the same either in lumpsum or in installment,

                        under the

                        terms and conditions prescribed in the Subscription Agreement;</li>

                      <li>Perform my responsibilities as a member and conform with the directives of duly constituted

                        authorities

                        including the decisions of the Board of Directors relative to the sound administration and

                        operations of the

                        cooperative.</li>

                    </ul>



                    <hr />



                    <div class="form-check">

                      <input class="form-check-input" type="checkbox" id="termsCheckbox" name="terms_checkbox">

                      <label class="form-check-label" for="termsCheckbox">

                        I understand and agree to abide by all the provisions of this Agreement and the Articles of

                        Incorporation and

                        By-laws of the Cooperative. I am aware that the Cooperative or the Board of Directors may impose

                        corresponding

                        sanction/s against me in case of non-compliance or commission of acts contrary to the said

                        provisions.

                      </label>

                    </div>



                    <div class="col-12 d-flex justify-content-between">

                      <button class="btn btn-primary btn-prev">

                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                        <span class="align-middle d-sm-inline-block d-none">previous</span>

                      </button>

                      <button class="btn btn-primary btn-next">

                        <span class="align-middle d-sm-inline-block d-none me-sm-1">next</span>

                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                      </button>

                    </div>

                  </div>

                </div>



                <div id="oath-of-contribution" class="content">

                  <h4 class="py-1 mb-4">Contribution Oath</h4>

                  <div class="row g-3">

                    <div class="col-12">

                      <p>

                        In connection with my membership to the <strong>LAGOPH Credit Cooperative</strong>, I hereby

                        subscribe

                        <input class="form-control d-inline-block mx-2" type="number" name="share_frequency"

                          id="shareFrequency" min="1" style="width: 80px;">

                        shares valued at

                        <input class="form-control  d-inline-block  mx-2" type="number" name="share_amount"

                          id="shareAmount" min="1" step="0.01" style="width: 100px;">

                        pesos (Php), which is equivalent to

                        <strong>

                          Php

                          <span id="total_capital_contribution_display"></span>

                          <input type="hidden" id="total_capital_contribution" name="subscribed_amount">

                        </strong>, on the following terms and conditions:

                      </p>

                    </div>



                    <div class="col-12">

                      <ol class="mb-3">

                        <li class="mb-2">

                          That I shall pay the initial amount of at least

                          <input class="form-control d-inline-block text-center" type="number"

                            name="contribution_amount" id="contributionAmount" value="2000" step="0.01"

                            style="width: 100px;">

                          pesos (Php) upon subscribing, and the balance to be paid in installment for a period not to

                          exceed



                          24 months. I acknowledge that the unpaid balance of my Subscribed Capital is my liability to

                          the Cooperative.

                        </li>

                        <li class="mb-2">

                          That I could guarantee or sell a portion of my Share Capital to any member with the prior

                          approval of the Cooperative.

                        </li>

                        <li class="mb-2">

                          That I shall contribute to the Share Capital a percentage of the annual interest on capital

                          and patronage refund due me, as may be determined and required by the Cooperative.

                        </li>

                        <li class="mb-2">

                          That I could make claims to my Capital Contributions upon termination of my membership without

                          pending obligation, subject to applicable policies and processes of the Cooperative.

                        </li>

                      </ol>

                    </div>



                    <div class="col-12">

                      <div class="form-check mb-3">

                        <input class="form-check-input" type="checkbox" id="terms_checkbox" name="terms_checkbox"

                          value="1">

                        <label class="form-check-label" for="terms_checkbox">

                          I understand and agree to abide by all the provisions of this Agreement and the Articles of

                          Incorporation and

                          By-laws of the Cooperative. I am aware that the Cooperative or the Board of Directors may

                          impose corresponding

                          sanction/s against me in case of non-compliance or commission of acts contrary to the said

                          provisions.

                        </label>

                      </div>

                      <div class="invalid-feedback" id="terms_checkbox_error" style="display:none;">You must agree to

                        the terms and conditions.</div>

                    </div>



                    <div class="col-12 d-flex justify-content-between">

                      <button class="btn btn-primary btn-prev" type="button">

                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                        <span class="align-middle d-sm-inline-block d-none">Previous</span>

                      </button>

                      <button class="btn btn-primary btn-next" type="submit">

                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                      </button>

                    </div>

                  </div>

                </div>



                <!-- Current Workflow modification -->

                <div id="membership-details" class="content">



                  <h4 class="py-1 mb-4">Membership Information</h4>

                  <ol>

                    <li>

                      <div class="mb-3 col-12 mb-0">

                        <p>Have you attended the seminar/training?</p>

                        <button class="btn btn-primary pms-cert" name="has_attended_seminar" id="attendedSeminar"

                          style="width:200px;">Yes</button>

                        <button type="button" class="btn btn-primary" style="width:200px;" data-bs-toggle="modal"

                          data-bs-target="#seminar_instruction">

                          No

                        </button>

                      </div>

                      <div class="mb-3 col-12 mb-0 d-none" id="uploadBin">

                        <input type="hidden" name="membership_invoice_id"

                          value="<?= $invoice_details_membership['cashiering_invoice_id'] ?? '' ?>">



                        <p>PMES (Pre-membership Education Seminar) Certificate</p>

                        <input type="file" id="attachments-pmes" name="attachments[pmes]" class="form-control"

                          accept=".jpg,.jpeg,.pdf" single />

                      </div>



                    <li>

                      <div class="mb-3 col-12 mb-0">

                        <p>Have you completed your membership fee payment?</p>

                        <button class="btn btn-primary" name="has_paid_memebrship_fee" id="memberFeePaid"

                          style="width:200px;">Yes</button>

                        <button type="button" class="btn btn-primary" style="width:200px;" data-bs-toggle="modal"

                          data-bs-target="#payment_instruction">

                          No

                        </button>

                      </div>



                      <div class="mb-3 col-12 mb-0 d-none" id="uploadPayment">





                        <label for="paymentMethod" class="form-label">Payment Mode</label>

                        <select class="form-select select2-search" id="m_payment_method" name="m_payment_method"

                          aria-label="Select Financial Institution">

                          <option value=""></option>

                          <?php foreach ($payment_method as $method): ?>

                            <option value="<?= $method['id'] ?>">

                              <?= $method['financial_service_provider'] ?>

                            </option>

                          <?php endforeach; ?>

                        </select>

                        <div class="col-12 mt-2 mb-3 d-none" id="proofOfPaymentContainer">

                          <label for="paymentMethod" class="form-label">Proof of payment <span class="text-muted">(JPG /

                              PDF)</span></label>

                          <input class="form-control w-auto" type="file" id="attachments-membership-receipt"

                            name="attachments[membership_receipt]" accept=".jpg,.jpeg,.pdf" />

                        </div>



                        <div class="col-12 mb-3 form-spacing d-none" id="accNameContainer">

                          <label for="paymentMethod" class="form-label">Amount</label>

                          <input type="text" id="accountAmount" name="m_payment_amount" class="form-control"

                            placeholder="Amount" />

                        </div>



                        <div class="col-12 mb-3 form-spacing d-none" id="refNumberContainer">

                          <label for="paymentMethod" class="form-label">Reference Number</label>

                          <input type="text" id="referenceNumber" name="m_reference_number" class="form-control"

                            placeholder="Reference Number" />

                        </div>

                      </div>

                    </li>

                    <li>

                      <div class="mb-3 col-12 mb-0">

                        <p>Have you completed your Contribution fee payment?</p>

                        <button class="btn btn-primary" name="has_paid_contribution_fee" id="contributionFeePaid"

                          style="width:200px;">Yes</button>

                        <button type="button" class="btn btn-primary" style="width:200px;" data-bs-toggle="modal"

                          data-bs-target="#payment_instruction">

                          No

                        </button>

                      </div>



                      <div class="col-12 mb-3  d-none" id="upload_payment_contribution">



                        <label for="paymentMethod" class="form-label">Payment Mode</label>

                        <select class="form-select select2-search" id="contributionPaymentMethod"

                          name="c_payment_method" aria-label="Select Financial Institution">

                          <option value=""></option>

                          <?php foreach ($payment_method as $method): ?>

                            <option value="<?= $method['id'] ?>">

                              <?= $method['financial_service_provider'] ?>

                            </option>

                          <?php endforeach; ?>

                        </select>

                        <div class="col-12 mt-2 mb-3 d-none" id="c_proof_payment_container">

                          <label for="paymentMethod" class="form-label">Proof of payment <span class="text-muted">(JPG /

                              PDF)</span></label>

                          <input class="form-control w-auto" type="file" id="attachments-contribution-receipt"

                            name="attachments[contribution-receipt]" accept=".jpg,.jpeg,.pdf" />

                        </div>



                        <div class="col-12 mb-3 form-spacing d-none" id="c_amount_container">

                          <label for="paymentMethod" class="form-label">Amount</label>

                          <input type="text" id="accountAmount" name="c_payment_amount" class="form-control"

                            placeholder="Amount" />

                        </div>



                        <div class="col-12 mb-3 form-spacing d-none" id="c_ref_number_container">

                          <label for="paymentMethod" class="form-label">Reference Number</label>

                          <input type="text" id="referenceNumber" name="c_reference_number" class="form-control"

                            placeholder="Reference Number" />

                        </div>

                      </div>

                    </li>

                  </ol>

                  <div class="col-12 d-flex justify-content-between">

                    <button class="btn btn-primary btn-prev">

                      <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                      <span class="align-middle d-sm-inline-block d-none">Previous</span>

                    </button>

                    <button class="btn btn-primary btn-next">

                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>

                      <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>

                    </button>

                  </div>

                </div>



                <!-- Review Details -->

       

                <div id="review-details" class="content">

                  <div class="row g-2">

                    <p class="fw-medium">Personal Information</p>

                    <div class="row g-1">

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Surname</b></span>

                          <input type="text" id="review-lname" class="form-control"

                            value="<?= isset($memberhsip['last_name']) ? htmlspecialchars($membership['last_name']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>First Name</b></span>

                          <input type="text" id="review-fname" class="form-control"

                            value="<?= isset($membership['first_name']) ? htmlspecialchars($membership['first_name']) : NULL?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Middle Name</b></span>

                          <input type="text" id="review-mname" class="form-control"

                            value="<?= isset($membership['middle_name']) ? htmlspecialchars($membership['middle_name']) : NULL ?>" disabled />

                        </div>

                      </div>



                      <div class="col-md-2">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Sex</b></span>

                          <input type="text" id="review-sex" class="form-control"

                            value="<?= isset($membership['sex']) ? htmlspecialchars($membership['sex']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-3">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Civil Status</b></span>

                          <input type="text" id="review-civil-status" class="form-control"

                            value="<?= isset($membership['civil_status']) ? htmlspecialchars($membership['civil_status']) :  NULL?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-3">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Date of Birth</b></span>

                          <input type="text" id="review-dob" class="form-control"

                            value="<?= isset($membership['date_of_birth']) ? htmlspecialchars($membership['date_of_birth']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Place of Birth</b></span>

                          <input type="text" id="review-pob" class="form-control"

                            value="<?= isset($membership['place_of_birth']) ?  htmlspecialchars($membership['place_of_birth']) : NULL?>" disabled />

                        </div>

                      </div>



                      <div class="col-md-12">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Residential Address</b></span>

                          <input type="text" id="review-address" class="form-control"

                            value="<?= isset($membership['address']) ? htmlspecialchars($membership['address']) : NULL?>" disabled />

                        </div>

                      </div>



                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Mobile No</b></span>

                          <input type="text" id="review-mobile-no" class="form-control"

                            value="<?= isset($membership['mobile_number']) ?  htmlspecialchars($membership['mobile_number']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Telephone No</b></span>

                          <input type="text" id="review-tel-no" class="form-control"

                            value="<?= isset($membership['tel_number']) ? htmlspecialchars($membership['tel_number']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Email</b></span>

                          <input type="text" id="review-email" class="form-control"

                            value="<?= isset($membership['email']) ?  htmlspecialchars($membership['email']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="divider">

                        <div class="divider-text">Spouse Information (If applicable)</div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Name</b></span>

                          <input type="text" id="review-spouse-name" class="form-control"

                            value="<?= isset($membership['spouse_name']) ?  htmlspecialchars($membership['spouse_name']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Occupation</b></span>

                          <input type="text" id="review-spouse-occupation" class="form-control"

                            value="<?= isset($membership['spouse_occupation']) ?  htmlspecialchars($membership['spouse_occupation']) : NULL ?>" disabled />

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="input-group input-group-sm">

                          <span class="input-group-text"><b>Tel/Mobile No</b></span>

                          <input type="text" id="review-spouse-tel-no" class="form-control"

                            value="<?= isset($membership['spouse_mobile_number']) ? htmlspecialchars($membership['spouse_mobile_number']) : NULL?>" disabled />

                        </div>

                      </div>

                    </div>



                    <hr />

                    <p class="fw-medium">Beneficiaries</p>

                    <div class="row g-1">

                      <ol id="beneficiaries-list">

                        <?php foreach ($beneficiaries as $beneficiary): ?>

                          <li>

                            <div class="row g-1 mb-2">

                              <div class="col-md-5">

                                <div class="input-group input-group-sm">

                                  <span class="input-group-text"><b>Name</b></span>

                                  <input type="text" class="form-control"

                                    value="<?= isset($beneficiary['name']) ? htmlspecialchars($beneficiary['name']) : NULL ?>" disabled />

                                </div>

                              </div>

                              <div class="col-md-3">

                                <div class="input-group input-group-sm">

                                  <span class="input-group-text"><b>Date of Birth</b></span>

                                  <input type="text" class="form-control"

                                    value="<?= isset($beneficiary['date_of_birth']) ? htmlspecialchars($beneficiary['date_of_birth']) : NULL?>" disabled />

                                </div>

                              </div>

                              <div class="col-md-4">

                                <div class="input-group input-group-sm">

                                  <span class="input-group-text"><b>Relationship</b></span>

                                  <input type="text" class="form-control"

                                    value="<?= isset($membership['relationship_type']) ? htmlspecialchars($beneficiary['relationship_type']) : NULL?>" disabled />

                                </div>

                              </div>

                            </div>

                          </li>

                        <?php endforeach; ?>

                      </ol>

                    </div>



                

                  <hr />

                  <p class="fw-medium">Educational Background</p>

                  <div class="row g-1">

                    <ol id="beneficiaries-list">

                      <li>Elementary

                        <div class="row mb-2">

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Basic Education / Course</b></span>

                              <input type="text" id="review-1-course" class="form-control"

                                value="<?= isset($educ_background[0]['education_course']) ? htmlspecialchars($educ_background[0]['education_course']) : NULL ?>" disabled />

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Name of School / Institution</b></span>

                              <input type="text" id="review-1-school" class="form-control"

                                value="<?= isset($educ_background[0]['school_institution']) ? htmlspecialchars($educ_background[0]['school_institution']) : NULL?>" disabled />

                            </div>

                          </div>

                        </div>

                      </li>

                      <li>Secondary

                        <div class="row mb-2">

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Basic Education / Course</b></span>

                              <input type="text" id="review-2-course" class="form-control"

                                value="<?=isset($educ_background[1]['school_institution']) ? htmlspecialchars($educ_background[1]['education_course']) : NULL ?>" disabled />

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Name of School / Institution</b></span>

                              <input type="text" id="review-2-school" class="form-control"

                                value="<?= isset($educ_background[1]['school_institution']) ? htmlspecialchars($educ_background[1]['school_institution'])  : NULL ?>" disabled />

                            </div>

                          </div>

                        </div>

                      </li>



                      <li>Tertiary

                        <div class="row mb-2">

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Basic Education / Course</b></span>

                              <input type="text" id="review-4-course" class="form-control"

                                value="<?= isset($educ_backgroundp[2]['education_course']) ? htmlspecialchars($educ_background[2]['education_course']) : NULL ?>" disabled />

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Name of School / Institution</b></span>

                              <input type="text" id="review-4-school" class="form-control"

                                value="<?= isset($educ_background[2]['school_institution']) ? htmlspecialchars($educ_background[2]['school_institution']) : NULL?>" disabled />

                            </div>

                          </div>

                        </div>

                      </li>

                      <li>Vocational

                        <div class="row mb-2">

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Basic Education / Course</b></span>

                              <input type="text" id="review-3-course" class="form-control"

                                value="<?= isset($educ_background[3]['education_course']) ? htmlspecialchars($educ_background[3]['education_course']) : NULL ?>"

                                disabled />

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Name of School / Institution</b></span>

                              <input type="text" id="review-3-school" class="form-control"

                                value="<?= isset($educ_background[3]['school_institution']) ? htmlspecialchars($educ_background[3]['school_institution']) : NULL ?>"

                                disabled />

                            </div>

                          </div>

                        </div>

                      </li>

                      <li>Graduate Studies

                        <div class="row mb-2">

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Basic Education / Course</b></span>

                              <input type="text" id="review-5-course" class="form-control"

                                value="<?= isset($educ_background[4]['education_course']) ? htmlspecialchars($educ_background[4]['education_course']) : NULL ?>"

                                disabled />

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="input-group input-group-sm">

                              <span class="input-group-text"><b>Name of School / Institution</b></span>

                              <input type="text" id="review-5-school" class="form-control"

                                value="<?= isset($educ_background[4]['school_institution']) ? htmlspecialchars($educ_background[4]['school_institution']) : NULL ?>"

                                disabled />

                            </div>

                          </div>

                        </div>

                      </li>

                    </ol>

                  </div>

                  <hr />

                  <p class="fw-medium">Work Experience</p>

                  <div class="row g-1 mb-2">

                    <div class="col-md-6">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Current</b></span>

                        <input type="text" id="review-work-current" class="form-control"

                          value="<?= isset($work_experience[0]['employment_status']) ? htmlspecialchars($work_experience[0]['employment_status']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Occupation / Designation</b></span>

                        <input type="text" id="review-work-current-occupation" class="form-control"

                          value="<?= isset($work_experience[0]['occupation']) ? htmlspecialchars($work_experience[0]['occupation']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Monthly Salary / Income</b></span>

                        <input type="text" id="review-work-current-salary" class="form-control"

                          value="<?= isset($work_experience[0]['income']) ? htmlspecialchars($work_experience[0]['income']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Telephone No.</b></span>

                        <input type="text" id="review-work-current-tel-no" class="form-control"

                          value="<?= isset($work_experience[0]['tel_no']) ? htmlspecialchars($work_experience[0]['tel_no']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                    <div class="col-md-5">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Business Address</b></span>

                        <input type="text" id="review-work-current-addr" class="form-control"

                          value="<?= isset($work_experience[0]['address']) ? htmlspecialchars($work_experience[0]['address']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                  </div>

                  <div class="row g-1 mb-2">

                    <div class="col-md-6">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Previous</b></span>

                        <input type="text" id="review-work-prev" class="form-control"

                          value="<?= isset($work_experience[1]['employment_status']) ? htmlspecialchars($work_experience[1]['employment_status']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Occupation / Designation</b></span>

                        <input type="text" id="review-work-prev-occupation" class="form-control"

                          value="<?= isset($work_experience[1]['occuption']) ? htmlspecialchars($work_experience[1]['occupation']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Monthly Salary / Income</b></span>

                        <input type="text" id="review-work-prev-salary" class="form-control"

                          value="<?= isset($work_experience[1]['income']) ? htmlspecialchars($work_experience[1]['income']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Telephone No.</b></span>

                        <input type="text" id="review-work-prev-tel-no" class="form-control" disabled

                          value="<?= isset($work_experience[1]['tel_no']) ? htmlspecialchars($work_experience[1]['tel_no']) : '' ?>" />

                      </div>

                    </div>

                    <div class="col-md-5">

                      <div class="input-group input-group-sm">

                        <span class="input-group-text"><b>Business Address</b></span>

                        <input type="text" id="review-work-prev-addr" class="form-control"

                          value="<?= isset($work_experience[1]['address']) ? htmlspecialchars($work_experience[1]['address']) : '' ?>"

                          disabled />

                      </div>

                    </div>

                  </div>



                  <hr />

                  <p class="fw-medium">Other Information</p>

                  <div class="row g-1 mb-2">

                    <ul class="list-unstyled">

                      <li><span>Have you ever been found guilty of any administrative offense?</span></li>

                      <li><span id="review-has-admin-offense" class="text-muted">No.</span><span

                          id="review-admin-offense" class="text-muted"></span></li>

                      <li><span>Have you ever been charged or convicted of any crime by any court or tribunal?</span>

                      </li>

                      <li><span id="review-is-convicted" class="text-muted">No.</span><span id="review-covicted"

                          class="text-muted"></span></li>

                    </ul>

                  </div>

                  <!-- /Modal -->



                  <hr />

                  <div class="row g-1 mb-2">

                    <div class="col-md-12">

                      <div class="form-check">

                        <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />

                        <label class="form-check-label" for="terms-conditions">

                          I hereby CERTIFY that the above information is true and correct to the best of my knowledge.

                          I authorize the Cooperative to verify/validate the contents stated herein. I understand that

                          any misrepresentation made in this document is punishable under applicable government laws

                          and policies.

                        </label>

                      </div>

                    </div>

                  </div>



                  <div class="col-12 d-flex justify-content-between">

                    <button class="btn btn-primary btn-prev">

                      <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>

                      <span class="align-middle d-sm-inline-block d-none">Previous</span>

                    </button>

                    <button class="btn btn-success btn-next">

                      <span class="align-middle">Submit</span>

                    </button>

                  </div>

                </div>

            </div>



            </form>

          </div>



        </div>

        <!--/ Property Listing Wizard -->

      </div>

      <!-- / Content -->

      <div class="content-backdrop fade"></div>

      <?php $this->load->view('pages/membership/modals/forms-modal'); ?>

    </div>

  </div>

</div>



<!-- Overlay -->

<div class="layout-overlay layout-menu-toggle"></div>

</div>

<!-- Layout Wrapper -->



<?php $this->load->view('layout/footer') ?>
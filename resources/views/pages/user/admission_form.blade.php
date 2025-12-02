<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Noto Sans Bengali", "SolaimanLipi", sans-serif;
            background: #f8f9fa;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            padding-bottom: 6px;
            border-bottom: 2px solid #0d6efd;
            color: #0d6efd;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.07);
        }

        label {
            font-weight: 600;
            margin-bottom: 4px;
        }

        /* Responsive Card Grid */
        .card-layout {
            display: grid;
            grid-column: 2;
            /* grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); */
            grid-template-columns: repeat(2, 1fr); 
            gap: 25px;
        }
    </style>
</head>

<body>

<div class="container py-4">

  <div>
    <h3 class="text-center">ভর্তি আবেদন</h3>
  </div>

    <form id="admissionForm" action="#" method="POST" autocomplete="off">

        <!-- Card Layout Grid -->
        <div class="card-layout">

            <!-- ================================
                 ১। ছাত্র/ছাত্রীর ব্যক্তিগত তথ্য
            ================================= -->
            <div class="card">
                <div class="card-body">
                    <div class="section-title">১। ছাত্র/ছাত্রীর ব্যক্তিগত তথ্য</div>

                    <div class="row g-3">

                        <!-- বাংলা নাম -->
                        <div class="col-md-6">
                            <label>নামের প্রথম অংশ (বাংলা)</label>
                            <input type="text" name="name_bn_first" class="form-control" placeholder="বাংলায় লিখুন">
                        </div>

                        <div class="col-md-6">
                            <label>নামের দ্বিতীয় অংশ (বাংলা)</label>
                            <input type="text" name="name_bn_last" class="form-control" placeholder="বাংলায় লিখুন">
                        </div>

                        <!-- ইংরেজি নাম -->
                        <div class="col-md-6">
                            <label>নামের প্রথম অংশ (English)</label>
                            <input type="text" name="name_en_first" class="form-control" placeholder="ইংরেজীতে লিখুন">
                        </div>

                        <div class="col-md-6">
                            <label>নামের দ্বিতীয় অংশ (English)</label>
                            <input type="text" name="name_en_last" class="form-control" placeholder="ইংরেজীতে লিখুন">
                        </div>

                        <div class="col-md-6">
                            <label>জন্ম তারিখ</label>
                            <input type="date" name="birth_date" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>জন্ম নিবন্ধন নম্বর</label>
                            <input type="text" name="birth_reg_no" class="form-control" placeholder="অবশ্যই দিতে হবে">
                        </div>

                        <div class="col-md-6">
                            <label>লিঙ্গ</label>
                            <select name="gender" class="form-select">
                                <option value="">-- নির্বাচন করুন --</option>
                                <option value="male">পুরুষ</option>
                                <option value="female">মহিলা</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>জাতীয়তা</label>
                            <input type="text" name="nationality" class="form-control" placeholder="বাংলাদেশী">
                        </div>

                    </div>
                </div>
            </div>

            <!-- ================================
                 ২। পিতা-মাতা ও অভিভাবকের তথ্য
            ================================= -->
            <div class="card">
                <div class="card-body">
                    <div class="section-title">২। পিতা-মাতা ও অভিভাবকের তথ্য</div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>পিতার নাম (বাংলা)</label>
                            <input type="text" name="father_bn" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>পিতার নাম (English)</label>
                            <input type="text" name="father_en" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>পিতার NID নং</label>
                            <input type="text" name="father_en" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>পিতার জন্ম নিবন্ধন নং</label>
                            <input type="text" name="father_en" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>পিতার জন্ম তারিখ</label>
                            <input type="date" name="father_en" class="form-control">
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <label>মাতার নাম (বাংলা)</label>
                            <input type="text" name="mother_bn" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>মাতার নাম (English)</label>
                            <input type="text" name="mother_en" class="form-control">
                        </div>

                            <div class="col-md-6">
                            <label>মাতার NID নং</label>
                            <input type="text" name="father_en" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>মাতার জন্ম নিবন্ধন নং</label>
                            <input type="text" name="father_en" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>মাতার জন্ম তারিখ</label>
                            <input type="date" name="father_en" class="form-control">
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <label>অভিভাবকের নাম </label>
                            <input type="text" name="guardian_name" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>অভিভাবকের মোবাইল নম্বর</label>
                            <input type="text" name="guardian_phone" class="form-control">
                        </div>

                    </div>
                </div>
            </div>

            <!-- ================================
                 ৩। ঠিকানা তথ্য
            ================================= -->
            <div class="card">
                <div class="card-body">
                    <div class="section-title">৩। ঠিকানা তথ্য</div>

                    <h6 class="fw-bold text-primary mb-2">স্থায়ী ঠিকানা</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label>গ্রাম / ওয়ার্ড</label>
                            <input type="text" name="perm_village" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>পোস্ট অফিস/ডাকঘর</label>
                            <input type="text" name="perm_post" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>ইউনিয়ন</label>
                            <input type="text" name="perm_post" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>উপজেলা / থানা</label>
                            <input type="text" name="perm_upazila" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>জেলা</label>
                            <input type="text" name="perm_district" class="form-control">
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary mb-2">বর্তমান ঠিকানা</h6>
                      <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label>গ্রাম / ওয়ার্ড</label>
                            <input type="text" name="perm_village" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>পোস্ট অফিস/ডাকঘর</label>
                            <input type="text" name="perm_post" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>ইউনিয়ন</label>
                            <input type="text" name="perm_post" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>উপজেলা / থানা</label>
                            <input type="text" name="perm_upazila" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>জেলা</label>
                            <input type="text" name="perm_district" class="form-control">
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================================
                 ৪। ভর্তি সংক্রান্ত তথ্য
            ================================= -->
            <div class="card">
                <div class="card-body">
                    <div class="section-title">৪। ভর্তি সংক্রান্ত তথ্য</div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>কোন শ্রেণীতে ভর্তি হতে চান</label>
                            <select name="admit_class" class="form-select">
                                <option value="">-- নির্বাচন করুন --</option>
                                <option value="1">১ম</option>
                                <option value="2">২য়</option>
                                <option value="3">৩য়</option>
                                <option value="4">৪র্থ</option>
                                <option value="5">৫ম</option>
                                <option value="dakhil">দাখিল</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>পূর্বের বিদ্যালয় / মাদ্রাসা</label>
                            <input type="text" name="previous_institute" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>শিক্ষাগত যোগ্যতা</label>
                            <input type="text" name="education" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>ভর্তি ফি (অফিস পূরণ)</label>
                            <input type="text" name="fee_info" class="form-control">
                        </div>

                    </div>
                </div>
            </div>

            <!-- ================================
                 ৫। অঙ্গীকার
            ================================= -->
            <div class="card">
                <div class="card-body">
                    <div class="section-title">৫। অঙ্গীকার</div>

                    <label>ছাত্র/ছাত্রীর অঙ্গীকার</label>
                    <textarea class="form-control mb-3" rows="3">
আমি প্রতিশ্রুতি দিচ্ছি যে মাদ্রাসার সকল নিয়মকানুন মেনে চলব এবং অনৈতিক কাজে অংশগ্রহণ করব না।
                    </textarea>

                    <label>অভিভাবকের অঙ্গীকার</label>
                    <textarea class="form-control" rows="3">
আমি নিশ্চয়তা দিচ্ছি যে আমার সন্তান নিয়মিত ক্লাসে উপস্থিত থাকবে এবং মাদ্রাসার নিয়ম মেনে চলবে।
                    </textarea>
                </div>
            </div>

        </div> <!-- End Card Layout -->


        <!-- Submit -->
        <div class="text-center mb-5 mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                ফর্ম জমা দিন
            </button>
        </div>

    </form>

</div>

</body>
</html>

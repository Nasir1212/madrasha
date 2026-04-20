 @extends('layouts.user')
@section('content')
<div class="teachers-section mt-30" style="font-family: SolaimanLipi !important;">
    <h3 class="title font-38 text-theme-colored mb-30" style="text-shadow: -1px -1px 2px #f4ecec, 1px -1px 2px #f4ecec, -1px 1px 2px #c3bdbd, 1px 1px 10px #f4ecec; border-bottom: 2px solid #3498db; display: inline-block; padding-bottom: 5px;">
        আমাদের শিক্ষকবৃন্দ
    </h3>

    <div class="row">
        <div class="col-sm-6 col-md-4 mb-30">
            <div class="teacher-card" style="background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #e1e1e1; transition: 0.3s; height: 100%;">
                <div class="teacher-image" style="background: #f9f9f9; text-align: center; padding: 15px;">
                    <img src="http://127.0.0.1:8000/assets/img/teacher1.jpg" alt="Teacher Name" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #DBECFD;">
                </div>
                <div class="teacher-info" style="padding: 15px; text-align: center;">
                    <h5 style="margin: 0; font-weight: bold; color: #2c3e50; font-size: 18px;">শিক্ষকের নাম এখানে</h5>
                    <p style="color: #3498db; font-weight: bold; margin: 5px 0;">পদবী এখানে (যেমন: সিনিয়র শিক্ষক)</p>
                    
                    <div style="background: #f1f8ff; padding: 5px 10px; border-radius: 5px; display: inline-block; margin-bottom: 10px; font-size: 14px; border: 1px solid #d1e7ff;">
                        <span style="color: #555;">ধরন: </span> <strong>এমপিওভুক্ত</strong>
                    </div>

                    <div class="contact-info" style="font-size: 15px; color: #666; margin-top: 5px;">
                        <i class="fa fa-phone"></i> মোবাইল: ০১৮XXXXXXXX
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 mb-30">
            <div class="teacher-card" style="background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #e1e1e1; height: 100%;">
                <div class="teacher-image" style="background: #f9f9f9; text-align: center; padding: 15px;">
                    <img src="http://127.0.0.1:8000/assets/img/teacher2.jpg" alt="Teacher Name" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #DBECFD;">
                </div>
                <div class="teacher-info" style="padding: 15px; text-align: center;">
                    <h5 style="margin: 0; font-weight: bold; color: #2c3e50; font-size: 18px;">অন্য শিক্ষকের নাম</h5>
                    <p style="color: #3498db; font-weight: bold; margin: 5px 0;">সহকারী মৌলভী</p>
                    
                    <div style="background: #fff0f0; padding: 5px 10px; border-radius: 5px; display: inline-block; margin-bottom: 10px; font-size: 14px; border: 1px solid #ffd1d1;">
                        <span style="color: #555;">ধরন: </span> <strong>নন-এমপিও</strong>
                    </div>

                    <div class="contact-info" style="font-size: 15px; color: #666; margin-top: 5px;">
                        <i class="fa fa-phone"></i> মোবাইল: ০১৭XXXXXXXX
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.15) !important;
    }
    .teacher-info h5 {
        min-height: 40px;
    }
</style>

@endsection
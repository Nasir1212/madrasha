@extends('layouts.user')
@section('content')
<div class="teachers-section mt-30" style="font-family: SolaimanLipi !important;">
    <h3 class="title font-38 text-theme-colored mb-30 " style="text-shadow: -1px -1px 2px #f4ecec, 1px -1px 2px #f4ecec, -1px 1px 2px #c3bdbd, 1px 1px 10px #f4ecec; border-bottom: 2px solid #3498db; display: flex; justify-content: center; padding-top:2rem">
        আমাদের শিক্ষকবৃন্দ ও কর্মচারীবৃন্দ
    </h3>

    <div class="row">
        @if($staffs->count() > 0)
            @foreach($staffs as $staff)
                <div class="col-sm-6 col-md-4 mb-30">
                    <div class="teacher-card" style="background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #e1e1e1; transition: 0.3s; height: 100%;">
                        
                        <!-- শিক্ষক/কর্মচারীর ছবি -->
                        <div class="teacher-image" style="background: #f9f9f9; text-align: center; padding: 15px;">
                            @if($staff->photo && file_exists(public_path('uploads/staff/' . $staff->photo)))
                                <img src="{{ asset('uploads/staff/' . $staff->photo) }}" alt="{{ $staff->bn_name }}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #DBECFD;">
                            @else
                                <!-- ছবি না থাকলে একটি ডিফল্ট অবতার বা প্লেসহোল্ডার ইমেজ দেখাবে -->
                                <img src="{{ asset('assets/img/default-avatar.jpg') }}" alt="{{ $staff->bn_name }}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #DBECFD;">
                            @endif
                        </div>

                        <!-- তথ্যসমূহ -->
                        <div class="teacher-info" style="padding: 15px; text-align: center;">
                            <!-- বাংলা নাম -->
                            <h5 style="margin: 0; font-weight: bold; color: #2c3e50; font-size: 18px;">{{ $staff->bn_name ?? $staff->name }}</h5>
                            
                            <!-- পদবী (designation) এবং বিষয় (subject) যদি থাকে -->
                            <p style="color: #3498db; font-weight: bold; margin: 5px 0;">
                                {{ $staff->designation }} {{ $staff->subject ? '('.$staff->subject.')' : '' }}
                            </p>
                            
                            <!-- এমপিও ধরন অনুযায়ী ডাইনামিক কালার ব্যাজ -->
                            @if(trim(strtolower($staff->mpo_type)) == 'mpo' || $staff->mpo_type == 'এমপিওভুক্ত' || $staff->mpo_type == 'MPO')
                                <div style="background: #f1f8ff; padding: 5px 10px; border-radius: 5px; display: inline-block; margin-bottom: 10px; font-size: 14px; border: 1px solid #d1e7ff;">
                                    <span style="color: #555;">ধরন: </span> <strong style="color: #0066cc;">এমপিওভুক্ত</strong>
                                </div>
                            @else
                                <div style="background: #fff0f0; padding: 5px 10px; border-radius: 5px; display: inline-block; margin-bottom: 10px; font-size: 14px; border: 1px solid #ffd1d1;">
                                    <span style="color: #555;">ধরন: </span> <strong style="color: #cc0000;">নন-এমপিও</strong>
                                </div>
                            @endif

                            <!-- মোবাইল নাম্বার -->
                            @if($staff->mobile_no)
                                <div class="contact-info" style="font-size: 15px; color: #666; margin-top: 5px;">
                                    <i class="fa fa-phone"></i> মোবাইল: {{ $staff->mobile_no }}
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12 text-center">
                <p class="alert alert-warning">কোন তথ্য খুঁজে পাওয়া যায়নি।</p>
            </div>
        @endif
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
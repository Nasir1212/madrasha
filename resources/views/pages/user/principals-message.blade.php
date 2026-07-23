@extends('layouts.user')

@section('title', 'অধ্যক্ষের বাণী - ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদ্রাসা')

@section('content')
<style>
    .principal-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 15px;
        font-family: 'SolaimanLipi', Arial, sans-serif;
    }
    .principal-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        padding: 30px;
    }
    .principal-title {
        font-size: 26px;
        font-weight: bold;
        color: #065f46;
        margin-bottom: 5px;
    }
    .principal-subtitle {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 15px;
    }
    .bismillah-box {
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 8px;
        padding: 12px;
        text-align: center;
        margin-bottom: 25px;
    }
    .bismillah-arabic {
        font-size: 20px;
        font-weight: bold;
        color: #064e3b;
        margin: 0;
    }
    .bismillah-bangla {
        font-size: 14px;
        color: #047857;
        font-style: italic;
        margin-top: 5px;
    }
    .speech-content {
        line-height: 1.8;
        color: #334155;
        text-align: justify;
    }
    .speech-content p {
        margin-bottom: 1rem;
    }
    
    /* ডেস্কটপ ও বড় স্ক্রিনের জন্য Float Stylings */
    .image-float-wrapper {
        float: left;
        margin-right: 20px;
        margin-bottom: 15px;
        width: 220px;
        text-align: center;
    }
    .principal-img {
        width: 100%;
        max-width: 220px;
        height: 230px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 4px;
        background-color: #fff;
    }
    .principal-name {
        font-size: 15px;
        font-weight: bold;
        color: #0f172a;
        margin-top: 10px;
        margin-bottom: 2px;
        line-height: 1.3;
    }
    .principal-designation {
        font-size: 13px;
        color: #047857;
        font-weight: 600;
        margin: 0;
    }
    .clearfix {
        clear: both;
    }
    .signature-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
        text-align: right;
    }

    /* ==========================================
       রেসপন্সিভ ডিজাইন (Responsive Media Queries)
       ========================================== */
    @media (max-width: 768px) {
        .principal-container {
            margin: 20px auto;
            padding: 0 10px;
        }
        .principal-card {
            padding: 20px 15px;
        }
        .principal-title {
            font-size: 22px;
        }
        .bismillah-arabic {
            font-size: 18px;
        }
        
        /* মোবাইলে ছবিকে সেন্টারে এনে Float বাদ দেওয়া হয়েছে */
        .image-float-wrapper {
            float: none;
            width: 100%;
            margin: 0 auto 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .principal-img {
            width: 180px;
            height: 200px;
        }
        .signature-section {
            text-align: center; /* মোবাইলে স্বাক্ষর সেন্টারে সুন্দর দেখায় */
        }
    }
</style>

<div class="principal-container">
    <div class="principal-card">
        
        <!-- পেজ হেডিং -->
        <div class="principal-title">অধ্যক্ষের বাণী</div>
        <div class="principal-subtitle">ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদ্রাসা</div>

        <!-- বিসমিল্লাহ সেকশন -->
        <div class="bismillah-box">
            <p class="bismillah-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <p class="bismillah-bangla">আলহামদুলিল্লাহ, ওয়াসসালাতু ওয়াসসালামু আলা রাসূলিল্লাহ।</p>
        </div>

        <!-- বাণীর বডি ও ফ্লোটিং ছবি -->
        <div class="speech-content">
            
            <!-- বামের ছবি (Float Left for Desktop, Centered for Mobile) -->
            <div class="image-float-wrapper">
                <img class="principal-img" src="{{ asset('assets/img/super.jpg') }}" alt="ছৈয়দ মোহাম্মদ জয়নুল আবেদীন জেহাদী">
                <div class="principal-name">ছৈয়দ মোহাম্মদ জয়নুল আবেদীন জেহাদী</div>
                <div class="principal-designation">অধ্যক্ষ</div>
            </div>

            <!-- মূল বিবরণ -->
            <p>অশেষ শুকরিয়া মহান আল্লাহ তা‘আলার দরবারে, যিনি আমাদেরকে দ্বীনি ও আধুনিক জ্ঞানের আলো ছড়িয়ে দেওয়ার এই মহৎ খিদমতে কবুল করেছেন। লাখো দরুদ ও সালাম বর্ষিত হোক মানবতার সর্বশ্রেষ্ঠ শিক্ষক, প্রিয় নবী হযরত মুহাম্মদ (সা.)-এর ওপর। একইসাথে গভীর শ্রদ্ধার সাথে স্মরণ করছি ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদ্রাসা-এর প্রতিষ্ঠাতা, শুভানুধ্যায়ী ও পরিচালনায় সম্পৃক্ত যেসব গুণীজন ইন্তেকাল করেছেন—মহান আল্লাহ তাঁদের আত্মার মাগফিরাত দান করুন। আমীন।</p>

            <p>ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদ্রাসা কেবল একটি ঐতিহ্যবাহী শিক্ষাপ্রতিষ্ঠান নয়; এটি দ্বীনি-আধুনিক জ্ঞান, আদর্শ ও নৈতিকতার সমন্বয়ে এক সুনাগরিক গড়ার আলোকবর্তিকা। আমরা বিশ্বাস করি, প্রকৃত শিক্ষা শুধু পাঠ্যপুস্তকের পাতায় সীমাবদ্ধ নয়; বরং তা শিক্ষার্থীর চিন্তাধারা, উন্নত চরিত্র এবং জীবনবোধকে বিকশিত ও আলোকিত করে।</p>

            <p>২০০১ সাল থেকে আমাদের এই প্রিয় প্রতিষ্ঠানটি যুগোপযোগী, দক্ষ আলেম এবং দেশপ্রেমিক, সৎ ও যোগ্য নৈতিক নাগরিক তৈরির লক্ষ্যে অবিচল পদক্ষেপে এগিয়ে চলছে। বাংলাদেশে ইসলামী শিক্ষাব্যবস্থার আধুনিকায়নে সরকারের সময়োপযোগী আহ্বানে সাড়া দিয়ে যেসব প্রতিষ্ঠান যুগোপযোগী শিক্ষাক্রম গ্রহণ করেছে, তাদের মধ্যে এই মাদ্রাসা অন্যতম।</p>

            <p>আমাদের শিক্ষাব্যবস্থায় ইসলামী শিক্ষার পাশাপাশি বিজ্ঞান, প্রযুক্তি ও আধুনিক জ্ঞানচর্চাকে সমান গুরুত্ব প্রদান করা হয়। ফলে দাখিল ও আলিম স্তরের শিক্ষার্থীরা দ্বীন ও দুনিয়া—উভয় ক্ষেত্রেই সফলতার সাথে নেতৃত্ব দিতে সক্ষম হচ্ছে।</p>

            <p>শিক্ষকমণ্ডলীর আন্তরিক নিষ্ঠা, শিক্ষার্থীদের কঠোর পরিশ্রম এবং অভিভাবক ও শুভাকাঙ্ক্ষীদের অব্যাহত দোয়ায় আজ এই প্রতিষ্ঠানটি প্রস্ফুটিত এক ফলবান বৃক্ষে পরিণত হয়েছে। আমাদের স্বপ্ন—আমাদের শিক্ষার্থীরা সুশিক্ষায় শিক্ষিত ও আলোকিত মানুষ হয়ে দেশ, জাতি ও বিশ্বমানবতার সেবায় নিবেদিত হবে এবং টেকসই উন্নয়ন লক্ষ্যমাত্রা (SDG) অর্জনে কার্যকর ভূমিকা রাখবে।</p>

            <p>আমি ছৈয়দ মোহাম্মদ জয়নুল আবেদীন জেহাদী ২০০১ সালে যোগদান করিয়া অধ্যবদি পর্যন্ত কর্মরত থেকে দায়িত্ব পালন করে আছি।</p>

            <p style="font-weight: 600; color: #064e3b; text-align: center; margin-top: 20px;">
                মহান আল্লাহ তা‘আলা আমাদের সকল ভুল-ত্রুটি ও সীমাবদ্ধতা ক্ষমা করে সত্য ও ন্যায়ের পথে থেকে কাজ করে যাওয়ার তাওফীক দান করুন। আমীন।
            </p>

        </div>

        <div class="clearfix"></div>

        <!-- স্বাক্ষর / সমাপ্তি -->
        <div class="signature-section">
            <div style="font-weight: bold; font-size: 16px; color: #0f172a;">ছৈয়দ মোহাম্মদ জয়নুল আবেদীন জেহাদী</div>
            <div style="font-size: 14px; color: #475569;">অধ্যক্ষ</div>
            <div style="font-size: 12px; color: #047857; font-weight: bold;">ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদ্রাসা</div>
        </div>

    </div>
</div>
@endsection
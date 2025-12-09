       
        <div class="header-nav" style="background-color: #202C45 !important;">
            <div class="header-nav-wrapper navbar-scrolltofixed " style="background-color: #202C45 !important;">
                <div class="container navigation-cont"  style="background-color: #202C45 !important;">
                    <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive" style="background-color: #202C45 !important;">
                        <ul class="menuzord-menu">
                            <li class="active"><a href="{{ route('home') }}">হোম</a></li>
                            <li><a href="#">পরিচিতি</a>
                                <ul class="dropdown">
                                    <li><a href="#about-us">এক নাজরে মাদরাসা</a></li>
                                    <li><a href="#principal-statement">অধ্যক্ষের বাণী ও সংক্ষিপ্ত জীবনবৃত্তান্ত</a></li>
                                    <!--<li><a href="vice-principal-statement">উপাধ্যক্ষের বাণী ও সংক্ষিপ্ত জীবনবৃত্তান্ত</a></li>-->
                                    <li><a href="#key-feature">বৈশিষ্ট্য</a></li>
                                    <li><a href="#establishment-planning">প্রতিষ্ঠার পরিকল্পনা</a></li>
                                    <li><a href="#mission-vision">প্রতিষ্ঠার লক্ষ্য</a></li>
                                    <li><a href="#governing-body">গভর্নিং বডি</a></li>
                                    <li><a href="#complex">কমপ্লেক্স</a></li>
                                    <li><a href="#teachers">শিক্ষকমন্ডলীর তথ্যবলী</a></li>
                                    <li><a href="#officers-employees">কর্মকর্তা ও কর্মচারী</a></li>
                                    <!--<li><a href="#">বিভাগীয় দায়িত্বশীল</a></li>-->
                                </ul>
                            </li>

                            <li><a href="#" style="font-family: SolaimanLipi !important">একাডেমিক</a>
                                <ul class="dropdown">
                                    <li><a href="#">শ্রেণী শিক্ষক এর তালিকা </a></li>
                                    <li><a href="#education-levels">শিক্ষা স্তর</a></li>
                                    <li><a href="#curriculum">পাঠ্যক্রম</a></li>
                                    <li><a href="#co-curriculum">সহ-পাঠ্যক্রম</a></li>
                                    <li><a href="#functions">অনুষ্ঠানমালা</a></li>
                                    <li><a href="#results">ফলাফল</a></li>
                                    <li><a href="#exam-method">পরীক্ষা পদ্ধতি</a></li>
                                    <li><a href="#holiday-list">ছুটির তালিকা</a></li>
                                     <li><a href="#exam-routine">পরীক্ষার রুটিন</a></li>
                                    <li><a href="#class-routine">ক্লাস রুটিন</a></li>
                                    <!--<li><a href="#training.php">প্রশিক্ষণ</a></li>-->
                                </ul>
                            </li>
                            <li><a href="#">ভর্তি</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('admission_form') }}">ভর্তির আবেদন  </a></li>
                                    <li><a href="#addmission-test">ভর্তি পরিক্ষা</a></li>
                                    <li><a href="#admission-procedure">ভর্তি প্রক্রিয়া</a></li>
                                    <li><a href="#jamat-wise-fee-list">জামাআত ওয়ারী বিভিন্ন ফি</a></li>
                                    <li><a href="#terms-of-admission">ভর্তির শর্তাবলী</a></li>
                                    <!--                                    
                                    <li><a href="#">প্রসপেক্টাস</a> </li>-->
                                </ul>
                            </li>
                       
                           
                            <li><a href="#">লাইব্রেরি</a>
                                <ul class="dropdown">
                                    <li><a href="#library">মাকতাবা পরিচিতি</a></li>
                                    <li><a href="#">ক্যাটালগ</a></li>
                                    <li><a href="#">নীতিমালা</a> </li>
                                    <!--<li><a href="#">কিতাব ডাউনলোড</a></li>-->
                                </ul>
                            </li>
                            <li><a href="#">শাখা প্রতিষ্ঠান</a>
                                <ul class="dropdown">
                                    <li><a href="" target="_blank">তাখসীসি শাখা</a></li>
                                    <li><a href="#women-teacher">মহিলা শাখা</a></li>
                                    <li><a href="#">নেছারিয়া হেফজখানা</a></li>
                                    <li><a href="#">ছালেহিয়া এতিমখানা</a></li>
                                    <li><a href="#"> কিতাব বিভাগ </a></li>
                                </ul>
                            </li>
                            <li><a href="#">মিডিয়া</a>
                                <ul class="dropdown">
                                    <li><a href="#photo-gallery">ফটোগ্যালারী</a></li>
                                    <li><a href="#video-gallery"> ভিডিও গ্যালারি </a></li> 
                                    <!--<li><a href="#">ভিডিও</a></li> -->
                                </ul>
                            </li>
                            <li><a href="#contact-us">যোগাযোগ</a> 
                                <!--<ul class="dropdown">
                                    <li><a href="#">ঠিকানা</a></li>
                                    <li><a href="#">গুরুত্বপূর্ণ মোবাইল নম্বর</a></li>
                                </ul>-->
                            </li>
                            <li>
                                <a>লগইন</a> 
								<ul class="dropdown">
                                    <li><a href="#login-student" target="_blank">শিক্ষার্থী/অভিভাবক </a></li>
                                    <li><a href="#login-teacher" target="_blank">শিক্ষক</a></li>
                                    <li><a href="#signin" target="_blank">সফটওয়্যার লগইন</a></li>
                                    <li><a href="{{ route('admin.dashboard') }}" target="_blank">প্রশাসনিক</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div id="top-search-bar" class="collapse">
                            <div class="container">
                                <form role="search" action="#" class="search_form_top" method="get">
                                    <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
                                    <span class="search-close"><i class="fa fa-search"></i></span>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
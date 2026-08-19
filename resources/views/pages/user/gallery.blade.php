@extends('layouts.user')
@section('content')

    <!-----------Gallery Start------------>
    <style type="text/css">
      .modal-dialog {width:500px;}
      .thumbnail {margin-bottom:6px;}    
    </style>

    <section>
        <div class="container" style="background-color: #DBECFD;" >
            <div class="col-md-12" >
            <div class="row" >
              <div class="col-sm-12 col-md-12" >   
                 <div class="main-content" style="background-color: #DBECFD;" >
                        
                        <div class="col-md-12 text-left" style="background-color: #DBECFD; padding-left: 0px; padding-right: 10px; font-family: SolaimanLipi !important;" >

                        <div class="row" >
                          <div class="col-md-12" >
                            <h4 class="widget-title title-dots"><span>ফটো গ্যালারি:</span></h4>
                          </div>
                        
                        <div class="col-xs-10 col-sm-10 col-md-10" >
                                    
                         <div class="row" > 
                          @forelse($images as $image)
                                <div class="col-lg-5 col-md-5 col-sm-12 mb-30 line-content" style="display: block;" >
                                    <div class="single-item" >
                                        <div class="single-item-image overlay-effect single-gallery-img" >
                                            <a href="{{ env('IMG_URL')}}/{{$image->image_path}}" data-fancybox="images" >
                                                <img src="{{ env('IMG_URL')}}/{{$image->image_path}}" alt="{{ $image->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                                            </a>
                                            <div class="courses-hover-info" >
                                                <div class="courses-hover-action" >
                                                    <h4>{{ $image->title }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @empty
                                <div class="col-md-12 text-center py-5">
                                    <p>গ্যালারিতে কোনো ছবি পাওয়া যায়নি।</p>
                                </div>
                            @endforelse
                         </div>
                         <hr>

                         <!-- Pagination Row Start -->
                         <div class="row" >
                              <div class="col-lg-12 d-flex justify-content-center" >
                                  {{ $images->links('pagination::bootstrap-4') }}
                              </div>
                          </div>
                          <!-- Pagination Row End -->

                        </div>
                    </div>
                    <br>
                </div>
            </div>
         </div>
       </div>
    </div>
   </section>

@endsection
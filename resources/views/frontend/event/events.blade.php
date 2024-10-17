@extends('frontend.layouts.app')

@section('content')

<div class="bg-page">
<!-- Page Header Start -->
<header class="page-banner-header gradient-bg position-relative">
    <div class="section-overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="page-banner-content text-center">
                        <h3 class="page-banner-heading text-white pb-15">{{ __(@$pageTitle) }}</h3>

                        <!-- Breadcrumb Start-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item font-14"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item font-14 active" aria-current="page">{{ __(@$pageTitle) }}</li>
                            </ol>
                        </nav>
                        <!-- Breadcrumb End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Header End -->

<!-- Course Single Details Area Start -->
<section class="blog-page-area section-t-space">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-8">

                <div class="blog-page-left-content">

                    @forelse($events as $event)
                    <!-- Blog Item Start -->
                    <div class="blog-item">

                        <div class="blog-item-top-part">
                            <h3 class="card-title blog-title"><a href="{{ route('event-details', $event->slug) }}">{{ __($event->title) }}</a></h3>
                        </div>

                        <div class="blog-item-img-wrap overflow-hidden position-relative">
                            <a href="{{ route('event-details', $event->slug) }}"><img src="{{ getImageFile($event->main_image) }}" alt="img" class="img-fluid"></a>
                            <div class="blog-item-tag position-absolute font-12 font-semi-bold text-white bg-hover radius-3">{{ __(@$event->category->name) }}</div>
                        </div>

                        <div class="blog-item-bottom-part">
                            <p class="blog-author-name-publish-date font-13 font-medium color-gray">{{ $event->created_at->format(' j  M, Y')  }}</p>
                            {{-- <p class="card-text blog-content">{!!  Str::limit($event->details, 200) !!}</p> --}}

                            <div class="blog-read-more-btn">
                                <a href="{{ route('event-details', $event->slug) }}" class="nav-link theme-button1">{{ __('More About the Event') }} <i data-feather="arrow-right"></i></a>
                                <button type="button"
                                data-event-id="{{$event->id}}"
                                data-event-min-date="10-03-2023"
                                data-event-max-date="10-09-2023"class="nav-link theme-button1 eventBooking" 
                                data-bs-toggle="modal" data-bs-target="#consultationBookingModal">Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Blog Item End -->
                    @empty
                        <div class="no-course-found text-center">
                            <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img" class="img-fluid">
                            <h5 class="mt-3">{{ __('Event Not Found') }}</h5>
                        </div>
                    @endforelse
                    <div class="col-12">
                    <!-- Pagination Start -->
                    @if(@$events->hasPages())
                        {{ @$events->links('frontend.paginate.paginate') }}
                    @endif
                    <!-- Pagination End -->
                    </div>

                </div>

            </div>
            <div class="col-12 col-md-5 col-lg-4">
                <div class="blog-page-right-content bg-white">

                    <div class="blog-sidebar-box">
                        <form class="blog-sidebar-search-box position-relative">
                            <div class="input-group">
                                <input class="form-control border-0 searchBlog" type="search" placeholder="{{ __('Search...') }}">
                                <button class="bg-transparent border-0"><span class="iconify" data-icon="akar-icons:search"></span></button>
                            </div>

                            <!-- Search Bar Suggestion Box Start -->
                            <div class="search-bar-suggestion-box searchBlogBox d-none custom-scrollbar">
                                <ul class="appendBlogSearchList">

                                </ul>
                            </div>
                            <!-- Search Bar Suggestion Box End -->

                        </form>
                    </div>

                    <div class="blog-sidebar-box">
                        <h6 class="blog-sidebar-box-title">{{ __('Recent Blogs') }}</h6>
                        <ul class="popular-posts">
                            @foreach($recentEvents as $recentEvent)
                            <li>
                                <div class="sidebar-blog-item d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="sidebar-blog-item-img-wrap overflow-hidden">
                                            <a href="{{ route('event-details', $recentEvent->slug) }}"><img src="{{ getImageFile($recentEvent->main_image) }}" alt="img" class="img-fluid"></a>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 {{selectedLanguage()->rtl == 1 ? 'me-3' : 'ms-3' }}">
                                        <h6 class="sidebar-blog-item-title"><a href="{{ route('event-details', $recentEvent->slug) }}">{{ __(@$recentEvent->title) }}</a></h6>
                                        <p class="blog-author-name-publish-date font-12 font-medium color-gray mb-0">{{ @$recentEvent->created_at->format(' j  M, Y')  }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="blog-sidebar-box">
                        <h6 class="blog-sidebar-box-title">{{ __('Categories') }}</h6>
                        <ul class="blog-sidebar-categories">
                            @foreach($eventCategories as $eventCategory)
                            <li><a href="{{ route('categoryBlogs', $eventCategory->slug) }}" class="font-15">{{ __($eventCategory->name) }} ({{ $eventCategory->active_events_count }})</a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Course Single Details Area End -->

</div>

<input type="hidden" class="searchBlogRoute" value="{{ route('search-blog.list') }}">

@foreach($events as $event)
@include('frontend.home.partial.event-booking-modal')
@endforeach
@endsection

@push('script')
    <!-- Start:: Blog Search  -->
    <script src="{{ asset('frontend/assets/js/custom/search-blog-list.js') }}"></script>
    <!-- End:: Blog Search  -->
    <script src="{{ asset('frontend/assets/js/course/addToCart.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom/booking.js') }}"></script>
@endpush

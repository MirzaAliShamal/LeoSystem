<div class="col-md-4 col-lg-3 col-xl-3 coursesLeftSidebar">
    <div class="courses-sidebar-area bg-light">

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        <span>{{ __('Categories') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        @foreach($categories as $key => $category)
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterDifficultyLevel" type="checkbox" name="filterDifficultyLevel"
                                    id="exampleRadiosDifficulty{{ $key }}" value="{{ $category->id }}">
                                <label class="form-check-label" for="exampleRadiosDifficulty{{ $key }}">
                                    {{ __($category->name) }} ({{ $category->courses_count }})
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
                        @endforeach
                        @if($categories->count() >= 4)
                        <div class="d-block">
                            <button id="showMoreCategoriesBtn" data-offset="{{ $categories->count() }}" type="button"
                                class="theme-btn theme-button2 load-more-btn">{{ __('Show More') }}
                                <span class="iconify" data-icon="bi:chevron-down"></span>
                            </button>
                        </div>
                        @endif
                       {{-- subcategories goes here under categories --}}
                    </div>
                </div>
            </div>
            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseSix">
                        <span>{{ __('Sub Categories') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingSix">
                    <div class="accordion-body">
                         @foreach($subcategories as $key => $subcategory) 
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterDifficultyLevel" type="checkbox" name="filterDifficultyLevel"
                                    id="exampleRadiosDifficulty{{ $subcategory->id }}" value="{{ $subcategory->id }}">
                                <label class="form-check-label" for="exampleRadiosDifficulty{{ $subcategory->id }}">
                                    {{ __($subcategory->name) }} ({{ $subcategory->courses_count }})
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
                         @endforeach 
                        
                        @if($subcategories->count() >= 4)
                        <div class="d-block">
                            <button id="showMoreSubcategoriesBtn" data-offset="{{ $subcategories->count() }}" type="button"
                                class="theme-btn theme-button2 load-more-btn">{{ __('Show More') }}
                                <span class="iconify" data-icon="bi:chevron-down"></span>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseSix">
                        <span>{{ __('Course Languages') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingSix">
                    {{-- <div class="accordion-body">
                        @foreach($languages as $key => $lang)
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterDifficultyLevel" type="checkbox" name="filterDifficultyLevel"
                                    id="exampleRadiosDifficulty{{ $key }}" value="{{ $lang->id }}">
                                <label class="form-check-label" for="exampleRadiosDifficulty{{ $key }}">
                                    {{ __($lang->name) }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
                        @endforeach
                        @if($lang->count() >= 4)
                        <div class="d-block">
                            <button id="showMoreSubcategoriesBtn" data-offset="{{ $lang->count() }}" type="button"
                                class="theme-btn theme-button2 load-more-btn">{{ __('Show More') }}
                                <span class="iconify" data-icon="bi:chevron-down"></span>
                            </button>
                        </div>
                        @endif
                    </div> --}}
                </div>
            </div>

            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree">
                        <span>{{ __('Course Ratings') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios41" value="5">
                               <label class="form-check-label" for="exampleRadios41">
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-half"></span>
                                    {{ __('4.5 & up') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios42" value="4">
                                <label class="form-check-label" for="exampleRadios42">
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star"></span>
                                    {{ __('4.0 & up') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios43" value="3.5">
                                <label class="form-check-label" for="exampleRadios43">
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-half"></span>
                                    <span class="iconify" data-icon="bi:star"></span>
                                    {{ __('3.5 & up') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios44" value="3">
                                <label class="form-check-label" for="exampleRadios44">
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star"></span>
                                    <span class="iconify" data-icon="bi:star"></span>
                                    {{ __('3.0 & up') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios45" value="2.5">
                                <label class="form-check-label" for="exampleRadios45">
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-fill"></span>
                                    <span class="iconify" data-icon="bi:star-half"></span>
                                    <span class="iconify" data-icon="bi:star"></span>
                                    <span class="iconify" data-icon="bi:star"></span>
                                    {{ __('2.5 & up') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        <span>{{ __('Course Level') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        @foreach(@$difficulty_levels as $key => $level)
                            <div class="sidebar-radio-item">
                                <div class="form-check">
                                    <input class="form-check-input filterDifficultyLevel" type="checkbox" name="filterDifficultyLevel" id="exampleRadiosDifficulty{{ $key }}" value="{{ $level->id }}">
                                    <label class="form-check-label" for="exampleRadiosDifficulty{{ $key }}">
                                        {{ __($level->name) }}
                                    </label>
                                </div>
                                <div class="radio-right-text"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree">
                        <span>{{ __('Bundle Courses') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios41" value="2">
                                <label class="form-check-label" for="exampleRadios41">
                                    {{ __('2 Courses Included') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios42" value="3">
                                <label class="form-check-label" for="exampleRadios42">
                                    {{ __('3 Courses Included') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios43" value="4">
                                <label class="form-check-label" for="exampleRadios43">
                                    {{ __('4 Courses Included') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios44" value="5">
                                <label class="form-check-label" for="exampleRadios44">
                                    {{ __('5 Courses Included') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterRating" type="checkbox" name="filterRating"
                                    id="exampleRadios45" value="6">
                                <label class="form-check-label" for="exampleRadios45">
                                    {{ __('6 Courses Included') }}
                                </label>
                            </div>
                            <div class="radio-right-text"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                        <span>{{ __('Video Duration') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingFive">
                    <div class="accordion-body">

                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterDuration" type="checkbox" name="filterDuration" id="exampleRadiosDuration34" value="1">
                                <label class="form-check-label" for="exampleRadiosDuration34">{{ __('0-1 Hour') }}</label>
                            </div>
                        </div>
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterDuration" type="checkbox" name="filterDuration" id="exampleRadiosDuration35" value="2">
                                <label class="form-check-label" for="exampleRadiosDuration35">{{ __('1-3 Hours') }}</label>
                            </div>
                        </div>

                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterDuration" type="checkbox" name="filterDuration" id="exampleRadiosDuration36" value="3">
                                <label class="form-check-label" for="exampleRadiosDuration36">{{ __('3-6 Hours') }}</label>
                            </div>
                        </div>
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterDuration" type="checkbox" name="filterDuration" id="exampleRadiosDuration37" value="4">
                                <label class="form-check-label" for="exampleRadiosDuration37">{{ __('6-10 Hours') }}</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="accordion-item course-sidebar-accordion-item">
                <h2 class="accordion-header course-sidebar-title" id="panelsStayOpen-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseFour">
                        <span>{{ __('Price') }}</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingFour">
                    <div class="accordion-body">
                        <div id="slider-range"></div>
                        <div class="range-value-box">
                            <div class="range-value-wrap"><label for="min_price">{{ get_option('app_currency') }}{{ __('Min')
                                    }}:</label>
                                <input type="number" min=0 max="9900" value="0" id="" class="price-range-field min_price" />
                            </div>
                            <div class="range-value-wrap"><label for="max_price">{{ get_option('app_currency') }}{{ __('Max')
                                    }}:</label>
                                <input type="number" min=0 max="10000" value="{{ $highest_price }}" id=""
                                    class="price-range-field max_price" />
                            </div>
                            <div class="range-value-wrap-go-btn d-flex align-items-center">
                                <button type="button" class="filterPrice"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
            
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterLearnerAccessibility" type="checkbox"
                                    name="filterLearnerAccessibility" id="exampleRadiosAccessibility32" value="free">
                                <label class="form-check-label" for="exampleRadiosAccessibility32">
                                    {{ __('Free') }}
                                </label>
                            </div>
                        </div>
                        <div class="sidebar-radio-item">
                            <div class="form-check">
                                <input class="form-check-input filterLearnerAccessibility" type="checkbox"
                                    name="filterLearnerAccessibility" id="exampleRadiosAccessibility33" value="paid">
                                <label class="form-check-label" for="exampleRadiosAccessibility33">
                                    {{ __('Paid') }}
                                </label>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

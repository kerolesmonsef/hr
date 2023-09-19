@foreach ($offers as $offer)
    <tr data-row-key="{{ $offer->id }}" class="ant-table-row ant-table-row-level-0">

        <!-- {{-- new saad --}}
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
            <div class="userTabl">
                <img src="/new-theme/images/logoSmall.svg">
            </div>
            <div class="tooltip">@lang("View Details")</div>
        </td> -->

        {{-- new saad --}}
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
            {{ $offer->form_link }}
            <div class="tooltip">@lang("View Details")</div>
        </td>
        
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $offer->id }}"
            aria-controls="id{{ $offer->id }}">{{ $offer->title }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        {{-- new saad --}}
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">Mele Sbs
            <div class="tooltip">@lang("View Details")</div>
        </td>
        
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $offer->id }}"
            aria-controls="id{{ $offer->id }}">{{ $offer->start_date }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $offer->id }}"
            aria-controls="id{{ $offer->id }}"> {{ $offer->users_count }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $offer->id }}"
            aria-controls="id{{ $offer->id }}">
            <div class="buttonS2 enabled {{ $offer->isExpired() ? "danger" : "" }}">{{ $offer->get_status() }}</div>
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
    </tr>

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id{{ $offer->id }}"
         aria-labelledby="id1Label">
        <div class=" drawerS1">
            <div class="head_ flex align between">
                <div class="flex align gap-25">
                    <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                  fill="black"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                  fill="black"/>
                        </svg>
                    </div>
                    <h3>{{ __('Job Details') }}</h3>
                </div>
                <div class="flex gap-15">
                    @can('JobOffers-Edit')
                        <a href="{{ route('job-offers.edit',$offer) }}">
                            <img src="/new-theme/icons/edit.svg"/>
                        </a>
                    @endcan

                    @can('JobOffers-Delete')
                        <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                             data-route="{{ route('job-offers.destroy', $offer->id) }}" src="/new-theme/icons/delete.svg"/>
                    @endcan
                </div>
            </div>

            <div class="contentDrawer scroll">

                <div class="sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                         aria-controls="employeeInformation">
                        <div class="ant-collapse">
                            <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false" role="button"
                                 tabindex="0">
                                <div class="ant-collapse-expand-icon">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1"
                                         viewBox="0 0 17 17" class="ant-collapse-arrow" height="1em" width="1em"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g></g>
                                        <path
                                            d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ant-collapse-header-text">{{ __('Job Information') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="employeeInformation">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">
                                        <div class="cards">
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Job Title') }}</div>
                                                <div class="des">{{ $offer->title }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Job Type') }}</div>
                                                <div class="des">{{ $offer->job_type }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Experience Needed') }}</div>
                                                <div class="des">{{ $offer->experience }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Career Level') }} </div>
                                                <div class="des">{{ $offer->career_level }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Salary') }}</div>
                                                <div class="des">{{ $offer->salary }}</div>
                                            </div>

                                            <div class="cardS1">
                                                <div class="name mb-3">{{ __('Job Description') }}</div>
                                                <ul>
                                                    <li><span></span> {{ $offer->job_description }}</li>
                                                </ul>
                                            </div>  
                                            {{-- <div class="cardS1">
                                                <div class="name mb-3">{{ __('Job Description') }}</div>
                                                <ul>
                                                    <li><span></span> {{ $offer->job_requirement }}</li>
                                                </ul>
                                            </div> --}}

                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Publish Date') }}</div>
                                                <div class="des">{{ $offer->start_date }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Applications N...') }}</div>
                                                <div class="des">{{ $offer->job_requests->count() }}</div>
                                            </div>
                                            <div class="cardS1">
                                                <div class="name mb-2">{{ __('From Link') }}</div>
                                                <div class="des flex align between" style="width: 100%">
                                                    <span id='formLink'>{{ route('job-offer.guest.show',$offer->form_link ?? "NaN") }}</span>
                                                    <div onclick="copyFormLink()">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.75 18.5C4.17 18.5 1.25 15.58 1.25 12C1.25 8.42 4.17 5.5 7.75 5.5C8.16 5.5 8.5 5.84 8.5 6.25C8.5 6.66 8.16 7 7.75 7C4.99 7 2.75 9.24 2.75 12C2.75 14.76 4.99 17 7.75 17C10.51 17 12.75 14.76 12.75 12C12.75 11.59 13.09 11.25 13.5 11.25C13.91 11.25 14.25 11.59 14.25 12C14.25 15.58 11.33 18.5 7.75 18.5Z" fill="#066163"/>
                                                            <path d="M16 18.75C15.59 18.75 15.25 18.41 15.25 18C15.25 17.59 15.59 17.25 16 17.25C18.89 17.25 21.25 14.89 21.25 12C21.25 9.11 18.89 6.75 16 6.75C13.11 6.75 10.75 9.11 10.75 12C10.75 12.41 10.41 12.75 10 12.75C9.59 12.75 9.25 12.41 9.25 12C9.25 8.28 12.28 5.25 16 5.25C19.72 5.25 22.75 8.28 22.75 12C22.75 15.72 19.72 18.75 16 18.75Z" fill="#066163"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name mb-2">{{ __('Status') }}</div>
                                                <div class="des" style="width: fit-content;"><div class="buttonS2 danger small"> Not Available</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="contentDrawer scroll">

                    <div class="sectionDDS1 section allEmployees">
                        <div class="ant-collapse">
                            <div class="ant-collapse-header" aria-expanded="true"
                                 aria-disabled="false" role="button" tabindex="0">
                                <div class="ant-collapse-expand-icon"
                                     data-bs-toggle="collapse"
                                     data-bs-target="#sectionEmployees"
                                     aria-expanded="true" aria-controls="sectionEmployees">
                                    <svg stroke="currentColor" fill="currentColor"
                                         stroke-width="0" version="1.1"
                                         viewBox="0 0 17 17" class="ant-collapse-arrow"
                                         height="1em" width="1em"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g></g>
                                        <path
                                            d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ant-collapse-header-text">{{ __('Applications List') }}</span>

                            </div>
                        </div>

                        <div class="collapse show" id="sectionEmployees">
                            <div class="ant-collapse-content-box">


                                @foreach($offer->users as $user)
                                    <a href="{{ route('job-offer-user.show',$user) }}">
                                        <div class="evaluationCard flex align between gap-2 mb-4">
                                            <div class="flex align gap-2 ">
                                                <div class="icon">
                                                    <img src="/new-theme/icons/userS1.svg" alt="">
                                                </div>
                                                <div class="cardContent">
                                                    <h4>{{ $user->name ?? "No Name"}}</h4>
                                                </div>
                                            </div>
                                            <p>1/2/2023</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $offer->id }}"
         aria-labelledby="edit1Label">
        <div class="drawerS1">
            <div class="head_ flex align between">
                <h3>{{ __('Job Details') }}</h3>
                <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                     data-route="{{ route('job-offers.destroy', $offer->id) }}" src="/new-theme/icons/all/delete.svg"
                     alt="">
            </div>

            <div class="contentDrawer scroll">
                <form class="formS1" method="post" action="{{ route('job-offers.update', $offer->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @if ($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <div class="sectionDDS1 section">
                        <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                             aria-controls="employeeInformation">
                            <div class="ant-collapse">
                                <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                     role="button" tabindex="0">
                                    <div class="ant-collapse-expand-icon">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                             version="1.1" viewBox="0 0 17 17" class="ant-collapse-arrow"
                                             height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <g></g>
                                            <path
                                                d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="ant-collapse-header-text">{{ __('Job Information') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="collapse show" id="employeeInformation">
                            <div
                                class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                                <div class="ant-collapse-item ant-collapse-item-active">
                                    <div class="ant-collapse-content ant-collapse-content-active">
                                        <div class="ant-collapse-content-box">
                                            <div class="cards">
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Job Title') }}</div>
                                                    <div class="des">{{ $offer->title }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Job Type') }}</div>
                                                    <div class="des">{{ $offer->job_type }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Experience Needed') }}</div>
                                                    <div class="des">{{ $offer->experience }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Career Level') }} </div>
                                                    <div class="des">{{ $offer->career_level }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Salary') }}</div>
                                                    <div class="des">{{ $offer->salary }}</div>
                                                </div>

                                                <div class="cardS1">
                                                    <div class="name mb-3">{{ __('Job Description') }}</div>
                                                    <ul>
                                                        <li><span></span> {{ $offer->job_description }}</li>
                                                    </ul>
                                                </div> 
                                                <div class="cardS1">
                                                    <div class="name mb-3">{{ __('Job Description') }}</div>
                                                    <ul>
                                                        <li><span></span> {{ $offer->job_requirement }}</li>
                                                    </ul>
                                                </div>

                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Publish Date') }}</div>
                                                    <div class="des">{{ $offer->start_date }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Applications N...') }}</div>
                                                    <div class="des">{{ $offer->job_requests->count() }}</div>
                                                </div>
                                                <div class="cardS1">
                                                    <div class="name mb-2">{{ __('From Link') }}</div>
                                                    <div class="des">{{ $offer->form_link }}</div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Job Title') }}</div>
                                                    <div class="inputS1">
                                                        <input required name="title" type="text"
                                                               value="{{ old('title', $offer->title) }}" id="jobTitle"
                                                               placeholder="">
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Job Type') }}</div>
                                                    <div class="inputS1">
                                                        <input required name="job_type" type="text"
                                                               value="{{ old('job_type', $offer->job_type) }}"
                                                               id="jobType" placeholder="Enter Job Type">
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Experience Needed') }}
                                                    </div>
                                                    <div class="inputS1">
                                                        <input required name="experience" type="text"
                                                               value="{{ old('experience', $offer->experience) }}"
                                                               id="experience" placeholder="Enter Experience years">
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Career Level') }}
                                                    </div>
                                                    <div class="inputS1">
                                                        <input required name="career_level" type="text"
                                                               value="{{ old('career_level', $offer->career_level) }}"
                                                               id="careerLevel" placeholder="Enter Career Level">
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Education Level') }}
                                                    </div>
                                                    <div class="inputS1">
                                                        <input required name="education_level" type="text"
                                                               value="{{ old('education_level', $offer->education_level) }}"
                                                               id="" placeholder="Enter Education Level">
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Salary') }}</div>
                                                    <div class="inputS1">
                                                        <input required name="salary" type="text"
                                                               value="{{ old('salary', $offer->salary) }}"
                                                               id="" placeholder="Enter Salary">
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Job Description') }}</div>
                                                    <div class="inputS1">
                                                        <input required name="job_description" type="text"
                                                               value="{{ old('job_description', $offer->job_description) }}"
                                                               id="careerLevel" placeholder="Enter Job Description">
                                                    </div>
                                                </div> 
                                                
                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Job Requirement') }}</div>
                                                    <div class="inputS1">
                                                        <input required name="job_requirement" type="text"
                                                               value="{{ old('job_requirement', $offer->job_requirement) }}"
                                                               id="careerLevel" placeholder="Enter Job Requirement">
                                                    </div>
                                                </div>


                                                <!--dfdf-->

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Publish Date') }}</div>
                                                    <div class="inputS1 noHeight">
                                                        <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                                        <input required type="text" name="start_date"
                                                               value="{{ old('start_date', $offer->start_date) }}"
                                                               placeholder="Enter Publish Date" name="datepicker"
                                                               class="datePickerBasic" autocomplete="off"/>
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('End Date') }}</div>
                                                    <div class="inputS1 noHeight">
                                                        <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                                        <input required type="text" name="end_date"
                                                               value="{{ old('end_date', $offer->end_date) }}"
                                                               placeholder="Enter Publish Date" name="datepicker"
                                                               class="datePickerBasic" autocomplete="off"/>
                                                    </div>
                                                </div>

                                                <div class="cardS1 my-4">
                                                    <div class="name mb-3">{{ __('Form Link') }}</div>
                                                    <div class="inputS1">
                                                        <input required type="url"
                                                               value="{{ old('form_link', $offer->form_link) }}"
                                                               name="form_link" value="" id="careerLevel"
                                                               placeholder="">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>


                                    <div class="sectionDDS1 section">
                                        <div data-bs-toggle="collapse" data-bs-target="#sectionEmployees"
                                             aria-expanded="true" aria-controls="sectionEmployees">
                                            <div class="ant-collapse">
                                                <div class="ant-collapse-header" aria-expanded="true"
                                                     aria-disabled="false" role="button" tabindex="0">
                                                    <div class="ant-collapse-expand-icon">
                                                        <svg stroke="currentColor" fill="currentColor"
                                                             stroke-width="0" version="1.1" viewBox="0 0 17 17"
                                                             class="ant-collapse-arrow" height="1em" width="1em"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <g></g>
                                                            <path
                                                                d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <span
                                                        class="ant-collapse-header-text">{{ __('Company Information') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="collapse show" id="sectionEmployees">
                                            <div
                                                class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                                                <div class="ant-collapse-item ant-collapse-item-active">
                                                    <div class="ant-collapse-content ant-collapse-content-active">
                                                        <div class="ant-collapse-content-box">
                                                            <div class="cards">
                                                                <div class="cardS1 flex align">
                                                                    <div class="name">{{ __('Company Name') }}</div>
                                                                    <div class="des">{{ $offer->company_name }}
                                                                    </div>
                                                                </div>
                                                                <div class="cardS1 flex align">
                                                                    <div class="name">{{ __('Company Location') }}
                                                                    </div>
                                                                    <div class="des">
                                                                        {{ $offer->company_location }}</div>
                                                                </div>

                                                                <div class="cardS1 my-4">
                                                                    <div class="name mb-3">{{ __('Company Name') }}
                                                                    </div>
                                                                    <div class="inputS1">
                                                                        <input required name="company_name"
                                                                               type="text"
                                                                               value="{{ old('company_name', $offer->company_name) }}"
                                                                               id="" placeholder="">
                                                                    </div>
                                                                </div>

                                                                <div class="cardS1 my-4">
                                                                    <div class="name mb-3">
                                                                        {{ __('Company Location') }}</div>
                                                                    <div class="inputS1">
                                                                        <input required name="company_location"
                                                                               type="text"
                                                                               value="{{ old('company_location', $offer->company_location) }}"
                                                                               id="" placeholder="">
                                                                    </div>
                                                                </div>


                                                                <div class="cardS1 flex align uploadImg1">


                                                                    <div class="name">{{ __('Company Logo') }}
                                                                    </div>
                                                                    <div class="logo">
                                                                        <div class="editIcon"
                                                                             style=" padding: 10px 6px; ">
                                                                            <svg width="16" height="16"
                                                                                 viewBox="0 0 16 16" fill="none"
                                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M7.33331 1.33301H5.99998C2.66665 1.33301 1.33331 2.66634 1.33331 5.99967V9.99967C1.33331 13.333 2.66665 14.6663 5.99998 14.6663H9.99998C13.3333 14.6663 14.6666 13.333 14.6666 9.99967V8.66634"
                                                                                    stroke="#AAAAAA"
                                                                                    stroke-width="1.5"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path
                                                                                    d="M10.6933 2.0135L5.43998 7.26684C5.23998 7.46684 5.03998 7.86017 4.99998 8.14684L4.71331 10.1535C4.60665 10.8802 5.11998 11.3868 5.84665 11.2868L7.85331 11.0002C8.13331 10.9602 8.52665 10.7602 8.73331 10.5602L13.9866 5.30684C14.8933 4.40017 15.32 3.34684 13.9866 2.0135C12.6533 0.680168 11.6 1.10684 10.6933 2.0135Z"
                                                                                    stroke="#AAAAAA"
                                                                                    stroke-width="1.5"
                                                                                    stroke-miterlimit="10"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path
                                                                                    d="M9.94 2.7666C10.3867 4.35993 11.6333 5.6066 13.2333 6.05993"
                                                                                    stroke="#AAAAAA"
                                                                                    stroke-width="1.5"
                                                                                    stroke-miterlimit="10"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <input name="company_logo" type="file"
                                                                               onchange="onUploadFilePreviewCard2(event,'outputImge{{ $offer->id }}')">

                                                                        <img id="outputImge{{ $offer->id }}"
                                                                             style=" width: 100%; height: 100%; "
                                                                             src="{{ $offer->company_logo ? url('storage/' . $offer->company_logo) : url('/new-theme/images/logoSmall.svg') }}"/>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="actions flex align end gap-3 m-3 mb-4">
                        <a href="{{ route('job-offers.index') }}" class="buttonS1 rejected"
                           data-bs-dismiss="offcanvas" aria-label="Close">{{ __('Close') }}</a>
                        <button class="buttonS1 primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


@push('script')
    <script>
        function copyFormLink() {
            let copyText = document.getElementById("formLink");
            navigator.clipboard.writeText(copyText.textContent);
        }
    </script>
@endpush

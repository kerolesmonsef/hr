@foreach($news as $new)
    <div class="col-lg-4">
        <div class="newsCard" data-bs-toggle="offcanvas" data-bs-target="#id{{ $new->id }}" aria-controls="id{{ $new->id }}">
            <div class="cardBg" style="background: url('{{ $new->getImageUrl() }}')">
                <!-- <img src="{{ $new->getImageUrl() }}" alt=""> -->
            </div>
            <h4 class="title">{{ $new->title }}</h4>
            <div class="flex align gap-3">
                <div class="brandLogo" style="background: url('{{ $new->getLogoUrl() }}')">
                    <!-- <img src="{{ $new->getLogoUrl() }}" alt=""> -->
                </div>
                <div>
                    <h5 class="brandName">{{ (new \Carbon\Carbon($new->date))->format("D, d M Y") }}</h5>
                    <p class="date">{{ (new \Carbon\Carbon($new->date))->format("H:i A") }}</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id{{ $new->id }}"
         aria-labelledby="id1Label">
        <div class=" drawerS1">
            <div class="head_ flex align between">
                <div class="flex align gap-25">
                    <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                  fill="black" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                  fill="black" />
                        </svg>
                    </div>
                    <h3>@lang("News Details")</h3>
                </div>
                <div class="flex gap-15">
                    @can('News-Edit')
                        <div data-bs-toggle="offcanvas" data-bs-target="#edit{{ $new->id }}" aria-controls="edit{{ $new->id }}">
                            <img src="/new-theme/icons/edit.svg" alt="" />
                        </div>
                    @endcan

                    @can('News-Delete')
                        <div>
                            <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                data-route="{{ route('news.destroy' , $new) }}"
                                src="/new-theme/icons/delete.svg"/>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="contentDrawer scroll">

                <div class="sectionDDS1 section">

                    <div class="ant-collapse-content-box">
                        <div class="cards">
                            <div class="cardS1 flex">
                                <div class="name">@lang("Title")</div>
                                <div class="des">{{ $new->title }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">@lang("Date")</div>
                                <div class="des">{{ front_date($new->date) }} -  {{ front_date($new->end_date) }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">@lang("Time")</div>
                                <div class="des">{{ (new \Carbon\Carbon($new->date))->format("H:i A") }}</div>
                            </div>
                            <div class="cardS1">
                                <div class="name">@lang("Description")</div>
                                <div class="des my-3" style="width: 100%">{{ $new->description }}</div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="sectionDDS1 section">
                    <div class="ant-collapse-content-box">
                        <div class="cards mb-4">
                            <div class="cardS1 flex align">
                                <div class="name">@lang("Logo")</div>
                                <div class="logo"><img src="{{ $new->getLogoUrl() }}" /></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sectionDDS1 section">
                    <div class="ant-collapse-content-box">
                        <div class="cards mb-4">
                            <div class="cardS1 flex align">
                                <div class="name">@lang("News Photo")</div>
                                <div class="logo"><img src="{{ $new->getImageUrl() }}" /></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $new->id }}"
         aria-labelledby="editLabel">
        <div class=" drawerS1">
            <div class="head_ flex align between">
                <div class="flex align gap-25">
                    <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                  fill="black" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                  fill="black" />
                        </svg>
                    </div>
                    <h3>@lang("News Details")</h3>
                </div>
                <div class="flex gap-15">
                    <div>
                        <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                             data-route="{{ route('news.destroy' , $new) }}"
                             src="/new-theme/icons/delete.svg"/>
                    </div>
                </div>
            </div>

            <div class="contentDrawer scroll">

                <form action="{{ route("news.update",$new) }}" class="formS1" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="sectionDDS1 section">
                        <div class="ant-collapse-content-box">
                            <div class="cards">

                                <div class="cardS1">
                                    <label for="title" class="form-label name">@lang("Title")</label>
                                    <div class="inputS1">
                                        <input type="text" name="title" value="{{ $new->title }}" id="title"
                                               placeholder="@lang("Enter Title")">
                                    </div>
                                </div>

                                <div class="cardS1">
                                    <label for="date" class="form-label name">@lang("Date")</label>
                                    <div class="inputS1">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        <input type="text" name="date" value="{{ front_date($new->date) }}" id="date"
                                               placeholder="@lang("Enter Date")" class="datePickerRange">
                                    </div>
                                </div>

                                <div class="cardS1">
                                    <label for="description" class="form-label name">@lang("Description")</label>
                                    <div class="inputS1">
                                        <textarea id="description" name="description" class="scroll" style="height: 219px;">{{$new->description}}</textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="sectionDDS1 section">
                        <div class="ant-collapse-content-box">
                            <div class="cards mb-4">
                                <div class="cardS1 flex align">
                                    <div class="name">@lang("Logo")</div>
                                    <div class="logo">
                                        <div class="editIcon">
                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.33333 1.33203H6C2.66666 1.33203 1.33333 2.66536 1.33333 5.9987V9.9987C1.33333 13.332 2.66666 14.6654 6 14.6654H10C13.3333 14.6654 14.6667 13.332 14.6667 9.9987V8.66536"
                                                    stroke="#868686" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M10.6933 2.01155L5.44 7.26488C5.24 7.46488 5.04 7.85822 5 8.14488L4.71333 10.1515C4.60666 10.8782 5.12 11.3849 5.84666 11.2849L7.85333 10.9982C8.13333 10.9582 8.52666 10.7582 8.73333 10.5582L13.9867 5.30488C14.8933 4.39822 15.32 3.34488 13.9867 2.01155C12.6533 0.678215 11.6 1.10488 10.6933 2.01155Z"
                                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M9.94 2.76562C10.3867 4.35896 11.6333 5.60562 13.2333 6.05896"
                                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>

                                        <input name="logo" type="file" onchange="onUploadFilePreviewCard2(event,'outputImge{{ $new->id }}')">

                                        <img id="outputImge{{ $new->id }}" src="{{ $new->getLogoUrl() }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sectionDDS1 section">
                        <div class="ant-collapse-content-box">
                            <div class="cards mb-4">
                                <div class="cardS1 flex align">
                                    <div class="name">@lang("News Photo")</div>
                                    <div class="logo">
                                        <div class="editIcon">
                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.33333 1.33203H6C2.66666 1.33203 1.33333 2.66536 1.33333 5.9987V9.9987C1.33333 13.332 2.66666 14.6654 6 14.6654H10C13.3333 14.6654 14.6667 13.332 14.6667 9.9987V8.66536"
                                                    stroke="#868686" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M10.6933 2.01155L5.44 7.26488C5.24 7.46488 5.04 7.85822 5 8.14488L4.71333 10.1515C4.60666 10.8782 5.12 11.3849 5.84666 11.2849L7.85333 10.9982C8.13333 10.9582 8.52666 10.7582 8.73333 10.5582L13.9867 5.30488C14.8933 4.39822 15.32 3.34488 13.9867 2.01155C12.6533 0.678215 11.6 1.10488 10.6933 2.01155Z"
                                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M9.94 2.76562C10.3867 4.35896 11.6333 5.60562 13.2333 6.05896"
                                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>

                                        <input name="photo" type="file" onchange="onUploadFilePreviewCard2(event,'outputImge1news{{ $new->id }}')">

                                        <img id="outputImge1news{{ $new->id }}" src="{{ $new->getImageUrl() }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex align end gap-15 p-4">
                        <button class="buttonS1 rejected" type="button" data-bs-dismiss="offcanvas"
                           aria-label="Close">
                            {{__('Cancel')}}
                        </button>
                        <button class="buttonS1 primary" type="submit">
                            {{__('Save')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach

                   
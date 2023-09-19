@foreach ($categories as $value => $category)
    <tr data-row-key="{{ $value }}" class="ant-table-row ant-table-row-level-0">

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ app() -> isLocale('en') ? $category -> name : $category -> name_ar }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $category -> documents -> count() }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $category -> created_at -> format('Y-m-d') }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
    </tr>

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id{{ $value }}"
         aria-labelledby="id1Label">
        <div class=" drawerS1">
            <div class="head_ flex align between">
                <div class="flex align gap-25">
                    <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                  fill="black"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                  fill="black"/>
                        </svg>
                    </div>
                    <h3>{{ __('View Details') }}</h3>
                </div>
                <div class="flex gap-15">
                    @can('Library-Edit')
                        <div data-bs-toggle="offcanvas" data-bs-target="#edit{{ $value }}" aria-controls="edit{{ $value }}">
                            <img src="/new-theme/icons/edit.svg" class="iconImg"/>
                        </div>
                    @endcan

                    @can('Library-Delete')
                        <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                            data-route="{{ route('library.destroy' , $category->id ) }}" src="/new-theme/icons/delete.svg"
                            class="iconImg"/>
                    @endcan
                </div>
            </div>

            <div class="contentDrawer scroll">
                <div class="sectionDDS1 section">
                    <div class="ant-collapse-content-box">
                        <div class="cards">
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Full Name_ar') }}</div>
                                <div
                                    class="des"> {{ app() -> isLocale('en') ? $category -> name : $category -> name_ar }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Date') }}</div>
                                <div class="des"> {{ $category -> created_at -> format('Y-m-d') }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Documents N..') }}</div>
                                <div class="des"> {{ $category -> documents -> count() }}</div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#documentList" aria-expanded="true"
                         aria-controls="documentList">
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
                                <span class="ant-collapse-header-text">{{ __('Documents List') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="documentList">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">

                                        <div class="cards">
                                            @foreach ($category -> documents as $key => $document )
                                                <div class="cardS1 filePreviewCard flex align">
                                                    <div class="name" style="width: 30%">{{__("Document File")}} </div>
                                                    <div class="des" style="width: 70%">
                                                        <a target="_blank"
                                                           href="{{ url('storage/' . $document -> document ) }}">
                                                            <div class="filePreview">
                                                                <div class="icon">
                                                                    <img src="/new-theme/icons/folder.svg" alt=""/>
                                                                </div>
                                                                <div class="info">
                                                                    {{-- @php
                                                                        $file = new Illuminate\Http\File($document->name);
            
                                                                        $fileSize = $file->size(); // This will return the size of the file in bytes
            
                                                                        // You can then convert the size to a more readable format, such as KB, MB, or GB, by using a helper function:
                                                                        $humanReadableSize = human_filesize($fileSize); // This will return the size in a human-readable format (e.g. "1.23 MB")
                                                                    @endphp  --}}
                                                                    <h4>{{ $document -> name }}</h4>
                                                                    <p>
                                                                            <?php
                                                                            $file_path = storage_path($document->document); ?>
                                                                        @if(file_exists($file_path))
                                                                            {{ 
                                                                                humanFileSize(\Illuminate\Support\Facades\Storage::size($document->document)) }}
                                                                        @else
                                                                            0
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
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

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $value }}"
         aria-labelledby="edit1Label">
        <div class=" drawerS1">
            <div class="head_ flex align between">
                <div class="flex align gap-25">
                    <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                  fill="black"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                  fill="black"/>
                        </svg>
                    </div>
                    <h3>{{ __('View Details') }}</h3>
                </div>
                <div class="flex gap-15">
                    <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                         data-route="{{ route('library.destroy' , $category->id ) }}" src="/new-theme/icons/delete.svg"
                         class="iconImg"/>
                </div>
            </div>

            <div class="contentDrawer scroll">
                <form class="formS1 inputsS1 ajax-submit" action="{{route('library.update' , $category -> id)}}"
                      method="post" enctype="multipart/form-data">
                    <div class="sectionDDS1 section">
                        @csrf
                        @method('put')
                        <div class="ant-collapse-content-box">
                            <div class="cardS1 my-4">
                                <div class="name mb-3">{{ __('Name') }}</div>
                                <div class="inputS1">
                                    <input name="name" type="text" value="{{ old('name' , $category -> name) }}"
                                           placeholder="" autocomplete="off">
                                </div>
                                @include("new-theme.components.error1",['error' => "name"])
                            </div>
                        </div>
                    </div>

                    <div class="sectionDDS1 section">
                        <div data-bs-toggle="collapse" data-bs-target="#documentList" aria-expanded="true"
                             aria-controls="documentList">
                            <div class="ant-collapse">
                                <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                     role="button"
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
                                    <span class="ant-collapse-header-text">{{ __('Documents List') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="collapse show" id="documentList">
                            <div class="ant-collapse-content-box">
                                <div class="cards">
                                    @foreach ($category -> documents as $key => $document )
                                        <div class="cardS1 filePreviewCard mb-4">
                                            <div class="name mb-3">{{__("Document File")}}</div>
                                            <div class="des" style="width: 100%">
                                                <div class="filePreview">
                                                    <div class="icon">
                                                        <img src="/new-theme/icons/folder.svg" alt=""/>
                                                    </div>
                                                    <div class="info flex align between">
                                                        <div>
                                                            <h4>{{ $document -> name }}</h4>
                                                            <p>
                                                                    <?php
                                                                    $file_path = storage_path($document->document); ?>
                                                                @if(file_exists($file_path))
                                                                    {{ humanFileSize( \Illuminate\Support\Facades\Storage::size($document->document)) }}
                                                                @else
                                                                    0
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="flex align gap-3">
                                                            <a target="_blank"
                                                               href="{{ url('storage/' . $document -> document ) }}">
                                                                <img src="/new-theme/icons/view.svg" class="iconImg"/>
                                                            </a>
                                                            <img data-bs-toggle="modal" data-bs-target="#confirm1"
                                                                 class="delete"
                                                                 data-route="{{ route('company-document-upload.destroy' , $document->id) }}"
                                                                 src="/new-theme/icons/delete.svg" class="iconImg"/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="uploadFileBox" id="addFolderId{{ $value }}">
                                        <div class="uploadFileBoxContent flex align gap-3">
                                            <div class="uploadInput">
                                                <img src="/new-theme/icons/upload.svg" alt=""/>
                                                <input name="documents[]" multiple type="file"/>
                                            </div>
                                            <div class="title">{{ __('Upload File') }}</div>
                                        </div>
                                    </div>
                                    @include("new-theme.components.error1",['error' => "documents"])
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex align end gap-15 m-4">
                        <button class="buttonS1 rejected" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                            {{ __('Cancel') }}
                        </button>
                        <button class="buttonS1 primary" type="submit">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endforeach
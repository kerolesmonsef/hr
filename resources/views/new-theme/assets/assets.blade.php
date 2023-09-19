@foreach ($assets as $asset)
    <tr data-row-key="1" class="ant-table-row ant-table-row-level-0">
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id-{{ $asset->id }}" aria-controls="id1'">
            {{ $asset->name }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id-{{ $asset->id }}" aria-controls="id1">
            {{ $asset->type }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id-{{ $asset->id }}" aria-controls="id1'">
            {{ $asset->serial_number }}
            <div class="tooltip">
                {{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id-{{ $asset->id }}" aria-controls="id1">
            {{ $asset->amount }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id-{{ $asset->id }}" aria-controls="id1">
            <div class="buttonS2  {{ $asset->status == 'available' ? 'success' : 'danger' }}">
                {{ __('' . $asset->status) }}</div>
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id-{{ $asset->id }}" aria-controls="id1">
            {{ $asset->employee->name }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

    </tr>


    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id-{{ $asset->id }}"
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
                    <h3>{{ __('Assets Details') }}</h3>
                </div>
                <div class="flex gap-15">

                    @can('Assets-Edit')
                        <div data-bs-toggle="offcanvas" data-bs-target="#edit-{{ $asset->id }}" aria-controls="edit1">
                            <img src="/new-theme/icons/edit.svg" class="iconImg" />
                        </div>
                    @endcan

                    @can('Assets-Delete')
                    <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                        data-route="{{ route('account-assets.destroy', $asset->id) }}"
                        src="/new-theme/icons/delete.svg" />
                    @endcan
                    
                </div>
            </div>
            <div class="contentDrawer scroll">
                <div class="sectionDDS1 section">
                    <div class="ant-collapse-content-box">
                        <div class="cards">
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Asset name') }}</div>
                                <div class="des">{{ $asset->name }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Type') }}</div>
                                <div class="des">{{ $asset->type }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('S/N') }}</div>
                                <div class="des">{{ $asset->serial_number }} </div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Amount') }}</div>
                                <div class="des">{{ $asset->amount }}</div>
                            </div>
                            <div class="cardS1 flex align my-4">
                                <div class="name">{{ __('Status') }}</div>
                                <div class="des">
                                    <div
                                        class="buttonS2  {{ $asset->status == 'available' ? 'success' : 'danger' }} customeStatus">
                                        {{ __('' . $asset->status) }}</div>
                                </div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Employee Name') }}</div>
                                <div class="des">{{ $asset->employee->name }} </div>
                            </div>
                            <div class="cardS1 filePreviewCard flex align">
                                <div class="name">Asset Info</div>
                                <div class="des" style="width: 80%">
                                    <div class="filePreview">
                                        <div class="icon">
                                            <img src="/new-theme/icons/folder.svg" alt="" />
                                        </div>
                                        <div class="info">
                                            <h4>file attachment</h4>
                                            <p>127.15Kb</p>
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

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit-{{ $asset->id }}"
        aria-labelledby="edit1Label">
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
                    <h3>{{ __('Assets Details') }}</h3>
                </div>
                <div class="flex gap-15">
                    <div data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                        data-route="{{ route('account-assets.destroy', $asset->id) }}">

                        <img src="/new-theme/icons/delete.svg" class="iconImg" />
                    </div>
                </div>
            </div>
            <div class="contentDrawer scroll">
                <div class="sectionDDS1 section">
                    <div class="ant-collapse-content-box">
                        <form class="formS1 inputsS1 ajax-submit"
                            action="{{ route('account-assets.update', $asset->id) }}" method="post"
                            id="">
                            @method('PUT')
                            @csrf
                            <div class="cardS1 my-4">
                                <div class="name mb-3"> {{ __('Assets Name') }} </div>
                                <div class="inputS1 noHeight">
                                    <input type="text" name="name" value="{{ $asset->name }}"
                                        id="assetsName"
                                        placeholder='{{ __('Enter', ['val' => __('Assets Name')]) }}' />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'name'])
                            </div>
                           

                            <div class="cardS1 my-4">
                                <div class="name mb-3"> {{ __('Type') }} </div>
                                <div class="inputS1 noHeight">
                                    <select id="type" name="type">
                                        <option value="">{{ __('All') }}</option>
                                        @foreach($assets_types as $assets_type_id => $assets_type)
                                            <option value="{{ $assets_type_id  }}">{{ $assets_type      }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'type'])
                            </div>
                            <div class="cardS1 my-4">
                                <div class="name mb-3"> {{ __('S/N') }} </div>
                                <div class="inputS1 noHeight">
                                    <input name="serial_number" value="{{ $asset->serial_number }}" type="text"
                                        id="snCode" placeholder='{{ __('Enter', ['val' => __('S/N')]) }}'>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'serial_number'])
                            </div>
                            <div class="cardS1 my-4">
                                <div class="name mb-3"> {{ __('Amount') }} </div>
                                <div class="inputS1 noHeight">
                                    <input type="number" value="{{ $asset->amount }}" name="amount"
                                        value="" id="amount"
                                        placeholder="{{ __('Enter', ['val' => __('Amount')]) }}"
                                        autocomplete="off" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'amount'])
                            </div>
                            <div class="cardS1 my-4">
                                <div class="name mb-3"> {{ __('Employee Name') }} </div>
                                <div class="inputS1 noHeight">
                                    <select id="status" name="employee_id">
                                        <option value=""> {{ __('Select') }} </option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee['id'] }}"
                                                {{ $asset->employee_id == $employee['id'] ? 'selected' : '' }}>
                                                {{ $employee['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'employee_id'])
                            </div>
                            <div class="cardS1 my-4">
                                <div class="name mb-3"> {{ __('Status') }} </div>
                                <div class="inputS1">
                                    <select id="status" name="status">
                                        <option value="not_available"
                                            {{ $asset->employee_id == 'not_available' ? 'selected' : '' }}>
                                            {{ __('not_available') }}</option>
                                        <option value="available"
                                            {{ $asset->employee_id == 'available' ? 'selected' : '' }}>
                                            {{ __('available') }}</option>
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'status'])
                            </div>
                            <div class="cardS1 filePreviewCard my-4" id="filePreviewCard">
                                <div class="name mb-4">{{__("Employee File")}}</div>
                                <div class="des" style="width: 100%">
                                    <div class="filePreview mb-4">
                                        <div class="icon">
                                            <img src="/new-theme/icons/folder.svg" alt="" />
                                        </div>
                                        <div class="info flex align between">
                                            <div>
                                                <h4>file attachment</h4>
                                                <p>127.15Kb</p>
                                            </div>
                                            <div class="flex align gap-3">
                                                <img src="/new-theme/icons/view.svg" class="iconImg" />
                                                <img src="/new-theme/icons/delete.svg" class="iconImg" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uploadFileBox" id="folderUpload" >
                                        <div class="uploadFileBoxContent flex align gap-3">
                                            <div class="uploadInput">
                                                <img src="/new-theme/icons/upload.svg" alt="" />
                                                <input type="file"  onchange="onUploadFilePreviewCard(this,'folderUpload');"/>
                                            </div>
                                            <div class="title">{{__("Upload File")}}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex align end gap-15 orders  my-5">
                                <button class="buttonS1 rejected"  data-bs-dismiss="offcanvas" aria-label="Close">
                                    {{ __('Cancel') }}
                                </button>
                                <button class="buttonS1 primary" type="submit"> {{ __('Save') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endforeach

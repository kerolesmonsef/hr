<div class="tab-pane show active" id="assets" role="tabpanel" aria-labelledby="assets-tab">
    <div class='sectionS2'>
        <div class="head withBorder flex align between">
            <h3 class='small'>@lang("Assets")</h3>
            <a href="{{Route('account-assets.create')}}?employee={{$employee->id}}">
                <button class='buttonS1 primary'>
                    <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58105 9C2.58105 8.68934 2.86993 8.4375 3.22628 8.4375H17.4211C17.7775 8.4375 18.0663 8.68934 18.0663 9C18.0663 9.31066 17.7775 9.5625 17.4211 9.5625H3.22628C2.86993 9.5625 2.58105 9.31066 2.58105 9Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3237 2.25C10.68 2.25 10.9689 2.50184 10.9689 2.8125V15.1875C10.9689 15.4982 10.68 15.75 10.3237 15.75C9.96736 15.75 9.67848 15.4982 9.67848 15.1875V2.8125C9.67848 2.50184 9.96736 2.25 10.3237 2.25Z" fill="white"/>
                    </svg>
                    @lang("Add New")
                </button>
            </a>
        </div>

        <div class="tableS1 scroll ">
            <table>
                <thead>
                    <tr>
                        <th>@lang("Asset name")</th>
                        <th>@lang("Type")</th>
                        <th>@lang("Amount")</th>
                        <th>@lang("Action")</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assets as $asset)
                        <tr>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->type }}</td>
                            <td>{{ $asset->amount }}</td>
                            <td>
                                <div class='action flex gap-3'>
                                    <div>
                                        <a href="{{Route('account-assets.edit',[$asset->id])}}?employee={{$employee->id}}">
                                            <img src="{{ asset("new-theme/icons/all/edit2.svg") }}" alt="" />
                                        </a>
                                    </div>
                                    <div>
                                        <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('account-assets.destroy' , $asset->id) }}">
                                            <img src="/new-theme/icons/all/delete.svg" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
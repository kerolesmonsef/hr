@foreach ($competencies as $competencie)
    <tr>
        <td>{{ $competencie->name }}</td>
        <td>{{ $competencie->getPerformance_type->translated_name }}</td>
        <td>
            <div class='action flex gap-3'>
                <div data-bs-toggle="modal" data-bs-target="#edit-{{ $competencie->id }}">
                    <img src="/new-theme/icons/all/edit.svg" alt="" />
                </div>
                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                    <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                        data-route="{{ route('competencies.destroy', $competencie->id) }}"
                        src="/new-theme/icons/delete.svg" />
                </div>
            </div>
        </td>
    </tr>


    <!-- Add New Modal -->
    <div class="modal fade customeModal" id="edit-{{ $competencie->id }}" tabindex="-1" aria-labelledby="addNewLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="formS1 ajax-submit" method="put"
                        action="{{ route('competencies.update', $competencie->id) }}">
                        @csrf
                        <div class="sectionS2">
                            <div class="head withBorder flex align between">
                                <h3 class='small'>{{ __('Edit Performance') }}</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="content">
                                <div class="">
                                    <label for="performanceName" class="form-label">{{ __('Performance Name') }}</label>
                                    <div class="inputS1">
                                        {{ Form::text('name', $competencie->name, ['id' => 'performanceName', 'placeholder' => __('Enter', ['val' => __('Performance Name')])]) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'name'])
                                </div>
                                <div class="">
                                    <label for="yearlyLimit" class="form-label">{{ __('Performance Type') }}</label>
                                    <div class="inputS1">
                                        {{ Form::select('type', $types, $competencie->type, ['class' => '']) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'type'])
                                </div>
                                <div class="flex align end gap-15 orders  mt-5 mb-4">
                                    <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button class="buttonS1 primary" type="submit">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

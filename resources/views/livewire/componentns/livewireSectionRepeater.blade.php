@foreach ($sections as $sectionIndex => $section)
    <div class='sectionS2'>
        <div class=" drawerS1">
            <div class="head flex align between">
                <div>
                    <div class="ant-collapse flex align between">
                        <div class="flex align gap-15 ant-collapse-header" aria-expanded="true"
                             aria-disabled="false" role="button" tabindex="0">
                            <div data-bs-toggle="collapse" data-bs-target="#section-{{ $sectionIndex }}"
                                 class="ant-collapse-expand-icon">
                                <img src="{{ asset('new-theme/icons/circle-arrow-up.svg') }}">
                            </div>
                            <span class="inputS1 mb-0">
                                <input wire:model="sections.{{ $sectionIndex }}.title" class="" placeholder="Section Title" style="border: none !important; font-weight: bold">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-15">

                    <button type="button" class='buttonS2 danger deleteSection'
                            wire:click="removeSection({{ $sectionIndex }})">
                        @lang('Delete Section')
                        <img src="{{ asset('new-theme/icons/delete.svg') }}">
                    </button>

                    <button type="button" class='buttonS1 primary'
                            wire:click="appendQuestion({{ $sectionIndex }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14"
                             viewBox="0 0 17 14" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                  fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                  fill="white"/>
                        </svg>
                        @lang('New Question')
                    </button>

                </div>
            </div>

            <div class=" sectionDDS1">
                <div class="collapse show" id="section-{{ $sectionIndex }}">

                    @foreach ($section['questions'] as $questionIndex => $question)
                            <?php
                            $prefix = "sections.$sectionIndex.questions.$questionIndex";
                            ?>
                        <div class='question'>
                            <div class="row gx-5">
                                <div class="col-lg-6">

                                    <div class="labelWithOptions mb-3">
                                        <label for="questionName-{{ $questionIndex }}"
                                               class="form-label mb-0">Question
                                            {{ $loop->iteration }}
                                        </label>
                                        <div class='DeleteQuestion' title="@lang('Delete Question')"
                                             wire:click="removeQuestion({{ $sectionIndex }} , {{ $questionIndex }})">
                                            <img src="{{ asset('new-theme/icons/all/delete.svg') }}">

                                        </div>
                                    </div>
                                    <div class="inputS1">
                                                <textarea rows="3" wire:model="{{ $prefix }}.content" type="text"
                                                          id="questionName-{{ $questionIndex }}"
                                                          placeholder='Enter Question'></textarea>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="type-{{ $questionIndex }}"
                                               class="form-label">Type</label>
                                        <div class="inputS1">
                                            <select id="type-{{ $questionIndex }}" placeholder="Short Answer"
                                                    wire:model="{{ $prefix }}.type">
                                                <option value="multi_select">{{__("Multi Select")}}</option>
                                                <option value="single_select">{{__("Single Select")}}</option>
                                                <option value="short_text">{{__("Short Text")}}</option>
                                                <option value="paragraph">{{__("Paragraph")}}</option>
                                            </select>
                                        </div>
                                    </div>
                                        <?php
                                        $radioStatusModel = "$prefix.status";
                                        ?>
                                    <div class="flex align gap-4  mb-3">
                                        <div style='color: #313030'>Status</div>
                                        <div class="flex align gap-3">
                                            <input wire:model="{{ $radioStatusModel }}" type="radio"
                                                   value="required"
                                                   id="required-{{ $sectionIndex }}-{{ $questionIndex }}">
                                            <label for="required-{{ $sectionIndex }}-{{ $questionIndex }}"
                                                   class="mb-0">@lang('Required')</label>
                                        </div>
                                        <div class="flex align gap-3">
                                            <input wire:model="{{ $radioStatusModel }}" type="radio"
                                                   value="notRequired-{{ $sectionIndex }}-{{ $questionIndex }}"
                                                   id="notRequired-{{ $sectionIndex }}-{{ $questionIndex }}">
                                            <label for="notRequired-{{ $sectionIndex }}-{{ $questionIndex }}"
                                                   class="mb-0">@lang('Not Required')</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @if ($question['type'] == 'short_text' or $question['type'] == 'paragraph')
                                @include('livewire.componentns.questions.text_questions')
                            @elseif($question['type'] == 'multi_select' or $question['type'] == 'single_select')
                                @include('livewire.componentns.questions.multi_select')
                            @endif


                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach


<button class="buttonS1 addNewButton mb-4" style="height: 74px; background: rgba(6, 97, 99, 0.1);box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.04);"  type="button" wire:click="addNewSection">
    {{-- <button class='btn_new withBorder m-4 addSectionBtn'> --}}
        <img src="{{ asset('new-theme/icons/plusPrimary.svg') }}">
        <span> @lang('New Section')</span>
    {{-- </button> --}}
</button>
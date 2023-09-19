<div class="question">
    <div class="row">
        <div class="col-lg-8">
            <div class="employeeCard">
                <h5 class="mb-4">{{ $question->title }}</h5>
                @if($question->isTextType())
                    <div class="inputS1">
                        <textarea data-id="{{ $question->id }}" readonly>{{ $user->answers->where("job_offer_question_id",$question->id)->first()?->answer ?? "No Answer Found" }}</textarea>
                    </div>
                @else
                    <div class="flex align gap-3">
                        @foreach($question->options as $options) 
                            <div class="inputCheckbox" data-id="{{ $question->id }}">
                                <?php
                                    $checked = $user->answers->where("job_offer_question_id",$question->id)->where("answer",$options->title)->isNotEmpty();
                                    ?>
                                <input
                                    {{ $checked ? "checked" : "" }}
                                    type="{{ $question->type == "multi_select" ? "checkbox" : "radio" }}" disabled>
                                <label  class="mb-0">{{ $options->title }}</label>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="employeeCard flex align gap-3">
                <h5>@lang("Points")</h5>
                <p>{{ $question->getUserPoint($user) }}/{{ $question->getPoints() }}</p>
            </div>
        </div>
    </div>
</div>
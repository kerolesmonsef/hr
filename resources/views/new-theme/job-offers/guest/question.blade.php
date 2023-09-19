<?php
$id = \Illuminate\Support\Str::uuid();
?>
<div class="form_section">
    <label for="{{ $id }}">{{ $question->title }}</label>
    @if($question->isTextType())
        <div class="inputS1">
            <textarea id="{{ $id }}"
                      name="question[{{ $question->id }}][]">{{ old("question.$question->id")[0] ?? "" }}</textarea>
        </div>
    @else
            <?php
            $name = "question[$question->id][]";
            if ($question->type == "multi_select") {
                $type = "checkbox";
            } else {
                $type = "radio";
            }
            ?>

        <div class="checkboxes">
            @foreach($question->options as $option)
                <div class="inputCheckbox">
                    <input id="{{ $id }}"
                        {{ in_array($option->title,old("question.$question->id") ?? []) ? "checked" : "" }}
                        type="{{ $type }}"
                        name="{{ $name }}"
                        value="{{ $option->title }}">
                    <label for="{{ $id }}">{{ $option->title }}</label>
                </div>
            @endforeach
        </div>
    @endif
    @error("question.$question->id")
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
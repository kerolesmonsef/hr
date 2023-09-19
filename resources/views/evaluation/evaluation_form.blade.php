<!DOCTYPE html>
<html  dir="{{ app()->isLocale('en') ? 'rtl' : 'rtl'  }}" style="text-align:{{ app()->isLocale('en') ? 'left' : 'right'  }}">
<head>
    <title>{{ $formtitle }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" >
    
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">

    <style>
        html,
        body {
            min-height: 100%;
            font-family: 'sans-serif';
            background: #E2F1EB;
        }
        body,
        input {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            color: #666;
            line-height: 22px;
        }

        h1,
        h4 {
            font-weight: 400;
        }

        h4 {
            margin: 22px 0 4px;
        }

        h5 {
            text-transform: uppercase;
            color: #095484;
        }

        .main-block {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3px;
            max-width:800px;
            margin: auto;

        }

        form {
            width: 100%;
            padding: 20px;
            box-shadow: 0 2px 5px #ccc;
            background: #fff;
            border-radius: 0px 0px 10px 10px;
        }



        input:hover,
        textarea:hover {
            outline: none;
            border: 1px solid #095484;
        }

        th,
        td {
            width: 15%;
            padding: 15px 0;
            border-bottom: 1px solid #ccc;
            text-align: center;
            vertical-align: unset;
            line-height: 18px;
            font-weight: 400;
            word-break: break-all;
        }

        .additional-question th,
        .additional-question td {
            width: 38%;
        }

        .course-rate th,
        .course-rate td {
            width: 19%;
        }

        .,
        .additional-question .,
        .course-rate . {
            width: 24%;

        }

        .question,
        .comments {
            margin: 15px 0 5px;
        }

        .question-answer label {
            display: inline-block;
            padding: 0 20px 15px 0;
        }

        .question-answer input {
            width: auto;
        }

        .question-answer,
        table {
            width: 100%;
        }

        .btn-block {
            margin-top: 20px;
            text-align: center;
        }

        button {
            width: 150px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #095484;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: #0666a3;
        }
        .cover{
            height: 50vh;
            width:100%;
            background-size:cover;
            background-position:center center ;
            background-repeat:no-repeat;
            background-image: url({{ url('employees.jpg') }});
        }


        @keyframes animatedBackground {
            from {
              background-position: 0 center;
            }
            to {
              background-position: 100% center;
            }
        }
        @media (min-width: 568px) {
            th,
            td {
                word-break: keep-all;
            }
        }
        .background{
            border-radius: 10px 10px 0px 0px;
            width:100%;
            overflow: hidden;
            height: 40vh;
            position:relative;
            background-repeat: no-repeat;
            background-image:url({{ url('employees.jpg') }});
            background-position: 0px center;
            background-repeat: repeat-x;
            animation: animatedBackground 10s linear infinite alternate;
        }
        .overlay{
            position: absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background: #0000009e;
        }
        .question{
            border-top:10px solid #3C9F78;
        }
        .div-answer{
            margin: 0.5em 0 0.5em 0.5em;
        }
        .div-answer label{
            display: inline-block;
            margin-left: .75em;
            margin-right: .75em;

        }
        .card{
            margin-bottom: 10px;
            border: 1px solid #dadce0;

        }
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap');
    </style>
</head>
<body>

    <div class="main-block" style="margin-top:30px;margin-bottom:30px;">
        <div class="container">
            <div class="background" style="" >
                <h1 style="position:absolute;top:50%;left:50%;color:#fff;z-index:5;transform:translate(-50% , -50%);font-weight:bold;">{{ $formtitle}}</h1>
                <div class="overlay"> </div>
            </div>
            <form action="{{ route('submit-evaluation-answers') }}" method="post" >
                <input type="hidden" name="evaluation_id" value="{{ $id }}" />
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <strong>الموظف: </strong> {{ app()->isLocale('en') ? $evaluation->employee->name : $evaluation->employee->name_ar}}<br>
                        <strong>المسمى الوظيفى: </strong>  {{ app()->isLocale('en') ? $evaluation->employee->jobtitle->name : $evaluation->employee->jobtitle->name_ar  }}<br>
                        <strong>القسم: </strong>    {{ app()->isLocale('en') ? $evaluation->employee->department->name : $evaluation->employee->department->name_ar }} <br>
                    </div>
                    <div class="col-md-6">
                        <strong>تم الانشاء بواسطة Badia Company Egypt</strong><br>
                        <strong>{{ $evaluation->created_at->diffForHumans()}}</strong>
                    </div>
                </div>
                <div class="card question">
                    <div class="card-body">
                      <h5 class="card-title">{{ $formtitle }}</h5>
                    </div>
                </div>
                @php
                    $counter = 0;
                @endphp
                @foreach($questions as $question)
                    @if($question -> type == 'text')
                    <div class="card text">
                        <div class="card-header">
                            {{ app()->isLocale('en') ? $question->title : $question->title_ar  }}
                        </div>
                        <div class="card-body">
                            <input type="text" name="{{ $question->id }}-{{ $question->type  }}" class="form-control"  placeholder="{{ __('Answer') }}"/>
                        </div>
                    </div>
                    @else
                    <div class="card choice">
                        <div class="card-header">
                            {{ app()->isLocale('en') ? $question->title : $question->title_ar  }}
                        </div>
                        <div class="card-body">
                            <div class="div-answer">
                                <input type="radio" value="0" name="{{ $question->id }}-{{ $question->type  }}" /><label style="maring-left:5px;">{{ __('Weak') }}</label>
                            </div>
                            <div class="div-answer">
                                <input type="radio" value="1" name="{{ $question->id }}-{{ $question->type  }}" /><label style="maring-left:5px;">{{ __('Medium') }}</label>
                            </div>
                            <div class="div-answer">
                                <input type="radio" value="2" name="{{ $question->id }}-{{ $question->type  }}" /><label style="maring-left:5px;">{{ __('Good') }}</label>
                            </div>
                            <div class="div-answer">
                                <input type="radio" value="3" name="{{ $question->id }}-{{ $question->type  }}" /><label style="maring-left:5px;">{{ __('Very good') }}</label>
                            </div>
                            <div class="div-answer">
                                <input type="radio" value="4" name="{{ $question->id }}-{{ $question->type  }}" /><label style="maring-left:5px;">{{ __('Excellent') }}</label>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach

                <div>
                    <button class="btn btn-primary" type="submit">{{ __('Send') }}</button>
                </div>
            </form>
        </div>

    </div>


    <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></scrip>
</body>

</html>

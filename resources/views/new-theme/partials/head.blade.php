<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashbord</title>
<!-- Bootstrap CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

{{-- font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600;700&display=swap"
    rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;900&display=swap"
    rel="stylesheet" />

{{-- datePicker --}}
<link href="{{ asset('css/flatpickr.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/monthSelect.css') }}" rel="stylesheet">
{{-- end datePicker --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />



<link rel="stylesheet" href="{{ url('new-theme/styles/global.css') }}" />
<link rel="stylesheet" href="{{ url('new-theme/styles/all.css') }}" />
<link rel="stylesheet" href="{{ url('new-theme/styles/sections.css') }}" />

@stack('style')

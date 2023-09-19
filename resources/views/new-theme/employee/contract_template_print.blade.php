<!DOCTYPE html>
<html>
<head>
    <title>Print Contact</title>
</head>
<body>
@if(isset($template))
    {!! $template !!}
@else
    {!! $printtemplate -> template !!}

@endif
</body>
<script>
    window.print();
    window.onfocus = function () {
        window.close();
    }
</script>
</html>

<!--  -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ url('new-theme/js/app.js') }}"></script>

{{-- time --}}
<script src="{{ asset('js/monthSelect.js') }}"></script>
<script src="{{ asset('js/flatpickr.js') }}"></script>

<script>
    flatpickr(".datePickerBasic", {
        dateFormat: "d/m/Y",
    })

    flatpickr(".datePickerRange", {
        mode: "range",
        conjunction: " :: ",
        // defaultDate: [new Date(), new Date() + 1]

    })

    flatpickr(".time-pickable", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: false,
    })

    flatpickr(".datePickerMonth", {
        plugins: [
            new monthSelectPlugin({
                shorthand: true, //defaults to false
                dateFormat: "Y/m", //defaults to "F Y"
            }),
        ],
    })
</script>


<script src="{{ asset('js/chart.js') }}"></script>
<script>
    $('.delete').click(function() {
        var route = $(this).data('route');
        $('.modal-delete').find('form').attr('action', route);
    });
</script>

<script>
    $(function() {
        $('.ajax-submit').submit(function(event) {
            event.preventDefault(); // prevent default form submission behavior
            var formData = new FormData($(this)[0]); // serialize form data
            $('.ajax-validation').addClass('d-none');
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function(field, messages) {
                            var arr = field.split('.');
                            var input = '#' + arr[0] + '_error';
                            console.log(input);
                            $(input).removeClass('d-none').text(messages.join(
                                '<br>'));
                        });

                    }
                }
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    let dirSelect = "ltr";
    if (document.documentElement.lang === "ar") {
        dirSelect = "rtl"
    }

    $(".select1").select2({
        dir: dirSelect
    });
    $(".select2").select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
        allowClear: false,
        dir: dirSelect,
        closeOnSelect: false
    });
</script>


@stack('script')

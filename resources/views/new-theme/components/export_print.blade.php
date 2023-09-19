<script>
    function objectToQueryParams(obj) {
        const params = new URLSearchParams();
        for (const key in obj) {
            if (obj.hasOwnProperty(key)) {
                params.append(key, obj[key]);
            }
        }
        return params.toString();
    }

    $("#export").click(function(e){
        e.preventDefault();
        let queryParameters = {
            search: $('#search').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
        }
        let queryParams = objectToQueryParams(queryParameters);
        window.location.href = "{{ $export_url }}"  {!! isset($no_query_param) ? "" : "+'?'+queryParams"  !!};
    });



    $("#print").click(function(e){
        e.preventDefault();
        let queryParameters = {
            search: $('#search').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
        }
        let queryParams = objectToQueryParams(queryParameters);
        window.open("{{ $print_url }}" {!! isset($no_query_param) ? "" : "+'?'+queryParams"  !!}, '_blank');
    });
</script>
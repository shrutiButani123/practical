<script>
    $(document).ready(function() {
        console.log('heeee');

        $('#state').on('change', function() {
            var stateId = $(this).val();
             $('#city').empty().append('<option value="">Select a City</option>');
            if(stateId) {
                $.ajax({
                    url: 'cities/' + stateId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {               
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                 console.error("Error fetching cities:", error);
                $('#city').empty().append('<option value="">Select a City</option>');
            }
        });
    });
</script>
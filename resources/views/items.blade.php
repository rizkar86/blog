<div id="items-list">
    <!-- The paginated items will be displayed here -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Initial AJAX request to load the first page of items
        loadItems(1);

        // Function to load items via AJAX
        function loadItems(page) {
            $.ajax({
                url: "{{ route('items.index') }}",
                method: "POST",
                data: { page: page, _token: "{{ csrf_token() }}" },
                success: function (data) {
                    // Update the items list with the paginated data
                    $("#items-list").html(data);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        }

        // Event listener for pagination links
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            loadItems(page);
        });
    });
</script>


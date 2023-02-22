<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
          event.preventDefault();
          let page = $(this).attr('href').split('page=')[1];
          getMoreUsers(page);
        });
        $('#search').on('keyup', function() {
          // $value = $(this).val();
          getMoreUsers(1);
        });
        $('#select').on('change', function() {
          getMoreUsers();
        });

    });
    function getMoreUsers(page) {
      
      let search = $('#search').val();

      let select = $('#select').val();
      
      $.ajax({
        type: "GET",
        data: {
          'search_query':search,
          'select':select,
        },
        url: "{{ route('management.project.index') }}" + "?page=" + page,
        success:function(data) {
          $('#project-load').html(data);
        }
      });
    }
</script>

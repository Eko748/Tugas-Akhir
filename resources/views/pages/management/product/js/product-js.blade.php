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
        $('#country').on('change', function() {
          getMoreUsers();
        });
        $('#sort_by').on('change', function (e) {
					getMoreUsers();
        });
        
        $('#salary_range').on('change', function (e) {
					getMoreUsers();
				});
    });
    function getMoreUsers(page) {
      
      let search = $('#search').val();

      let select = $('#select').val();
      // Search on based of country
      let selectedCountry = $("#country option:selected").val();
      // Search on based of type
      let selectedType = $("#sort_by option:selected").val();
      // Search on based of salary
      let selectedRange = $("#salary_range option:selected").val();
      $.ajax({
        type: "GET",
        data: {
          'search_query':search,
          'select':select,
          'country': selectedCountry,
          'sort_by': selectedType,
          'range': selectedRange
        },
        url: "{{ route('management.product.fetch') }}" + "?page=" + page,
        success:function(data) {
          $('#user_data').html(data);
        }
      });
    }
    // $(document).ready(function() {
    //     // function clear_icon() {
    //     //     $('#id_icon').html('');
    //     //     $('#post_title_icon').html('');
    //     // }

    //     function fetch_data(page, sort_type, sort_by, query) {
    //         $.ajax({
    //             type: "GET",
    //             // data: {
    //             //   'search_query':search,
    //             //   'country': selectedCountry,
    //             //   'sort_by': selectedType,
    //             //   'range': selectedRange
    //             // },
    //             url: "{{ route('management.product.index') }}" + "?page=" + page + "&sortby=" +
    //                 sort_by +
    //                 "&sorttype=" + sort_type + "&query=" + query,
    //             success: function(data) {
    //                 $('#user_data').html('');
    //                 $('#user_data').html(data);
    //             }
    //         });
    //     }


    //     $(document).on('keyup', '#search', function() {
    //         let query = $('#search').val();
    //         let column_name = $('#hidden_column_name').val();
    //         let sort_type = $('#hidden_sort_type').val();
    //         let page = $('#hidden_page').val();
    //         fetch_data(page, sort_type, column_name, query);
    //     });

    //     $(document).on('click', '.sorting', function() {
    //         var column_name = $(this).data('column_name');
    //         var order_type = $(this).data('sorting_type');
    //         var reverse_order = '';
    //         if (order_type == 'asc') {
    //             $(this).data('sorting_type', 'desc');
    //             reverse_order = 'desc';
    //             clear_icon();
    //             $('#' + column_name + '_icon').html(
    //                 '<span class="glyphicon glyphicon-triangle-bottom"></span>');
    //         }
    //         if (order_type == 'desc') {
    //             $(this).data('sorting_type', 'asc');
    //             reverse_order = 'asc';
    //             clear_icon
    //             $('#' + column_name + '_icon').html(
    //                 '<span class="glyphicon glyphicon-triangle-top"></span>');
    //         }
    //         $('#hidden_column_name').val(column_name);
    //         $('#hidden_sort_type').val(reverse_order);
    //         var page = $('#hidden_page').val();
    //         var query = $('#search').val();
    //         fetch_data(page, reverse_order, column_name, query);
    //     });

    //     $(document).on('click', '.pagination a', function(event) {
    //         event.preventDefault();
    //         var page = $(this).attr('href').split('page=')[1];
    //         $('#hidden_page').val(page);
    //         var column_name = $('#hidden_column_name').val();
    //         var sort_type = $('#hidden_sort_type').val();

    //         var query = $('#search').val();

    //         $('li').removeClass('active');
    //         $(this).parent().addClass('active');
    //         fetch_data(page, sort_type, column_name, query);
    //     });
    // });


    // function getMoreUsers(page, sort_type, sort_by, query) {

    //     // let search = $('.search').val();

    //     // // Search on based of country
    //     // let selectedCountry = $("#country option:selected").val();

    //     // // Search on based of type
    //     // let selectedType = $("#sort_by option:selected").val();

    //     // // Search on based of salary
    //     // let selectedRange = $("#salary_range option:selected").val();

    //     // var append = url.indexOf("?")==-1?"?":"&";
    //     //     var finalURL=url+append+$("#searchform").serialize();

    //     $.ajax({
    //         type: "GET",
    //         // data: {
    //         //   'search_query':search,
    //         //   'country': selectedCountry,
    //         //   'sort_by': selectedType,
    //         //   'range': selectedRange
    //         // },
    //         url: "{{ route('management.product.index') }}" + "?page=" + page + "&sortby=" + sort_by +
    //             "&sorttype=" + sort_type + "&query=" + query,
    //         success: function(data) {
    //             $('#user_data').html('');
    //             $('#user_data').html(data);
    //         }
    //     });
    // }
</script>

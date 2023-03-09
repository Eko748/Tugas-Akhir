<script>
  $(document).ready(function(){
      $('#search-input').on('keyup', function(){
          var query = $(this).val();

          $.ajax({
              url:"{{ route('slr.get') }}",
              method:'GET',
              data:{query:query},
              dataType:'json',
              success:function(data)
              {
                  // Tampilkan data hasil pencarian pada halaman
              }
          });
      });
  });
</script>

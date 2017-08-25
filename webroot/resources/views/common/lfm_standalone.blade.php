<script>
 var route_prefix = "{{ url(config('lfm.prefix')) }}";
</script>
<script>
  {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
</script>
<script>
  $('#lfm').filemanager('image', {prefix: route_prefix});
</script>

<form action="{{ route('blog.store') }}" method="POST">
    <h3>Show your working hard to others</h3>
    @include('common.errors')
    {{ csrf_field() }}
    <label>Title</label>
    <input name="title">
    <textarea id="ckeditor" class="form-control" rows="3" placeholder="blog" name="content">{{ old('content') }}</textarea>

    <script type="text/javascript">
        CKEDITOR.replace( 'ckeditor' );
    </script>
    <button type="submit" class="btn btn-primary pull-right">Submit</button>
</form>

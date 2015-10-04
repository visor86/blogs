<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="title" class="col-md-2 control-label">
                Title
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" autofocus
                       id="title" value="{{ $title }}">
            </div>
        </div>
        <div class="form-group">
            <label for="subtitle" class="col-md-2 control-label">
                Subtitle
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="subtitle"
                       id="subtitle" value="{{ $subtitle }}">
            </div>
        </div>
        <div class="form-group">
            <label for="page_image" class="col-md-2 control-label">
                Page Image
            </label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="images"
                               id="page_image" onchange="handle_image_change()"
                               alt="Image thumbnail" value="{{ $images }}">
                    </div>
                    <div class="visible-sm space-10"></div>
                    <div class="col-md-4 text-right">
                        <img src="{{ page_image($images) }}" class="img img_responsive"
                             id="page-image-preview" style="max-height:40px">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-md-2 control-label">
                Preview
            </label>
            <div class="col-md-10">
        <textarea class="form-control" name="preview" rows="7"
                  id="preview">{{ $preview }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-md-2 control-label">
                Content
            </label>
            <div class="col-md-10">
        <textarea class="form-control" name="text" rows="14"
                  id="text">{{ $text }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="publish_date" class="col-md-3 control-label">
                Pub Date
            </label>
            <div class="col-md-8">
                <input class="form-control" name="date_from" id="publish_date"
                       type="text" value="{{ $date_from }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input {{ checked($enabled) }} type="checkbox" name="enabled">
                        Enabled
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="meta_description" class="col-md-3 control-label">
                Meta Description
            </label>
            <div class="col-md-8">
            <textarea class="form-control" name="meta_description"
                  id="meta_description"
                  rows="6">{{ $meta_description }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="meta_description" class="col-md-3 control-label">
                Meta Keywords
            </label>
            <div class="col-md-8">
        <textarea class="form-control" name="meta_keywords"
                  id="meta_description"
                  rows="6">{{ $meta_keywords }}</textarea>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('preview');
        CKEDITOR.replace('text');
    });
</script>
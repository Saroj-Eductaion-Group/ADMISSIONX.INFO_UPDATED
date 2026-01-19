<h2>Metadeta</h2>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Page Title</label>
            <input class="form-control" type="text" name="seopagetitle" placeholder="Enter page title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter page title">
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO H1 Title</label>
            <input class="form-control" type="text" name="seoh1title" placeholder="Enter H1 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H1 title">
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Meta Keyword</label>
            <input class="form-control" type="text" name="seokeyword" placeholder="Enter meta keyword here"  data-parsley-trigger="change" data-parsley-error-message="Please enter meta keyword">
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Description</label>
            {!! Form::textarea('seoDescription', null, ['class' => 'form-control summernote', 'data-parsley-error-message' => 'Please enter page description ', 'data-parsley-trigger' => 'change', 'placeholder' => 'Enter page description']) !!}
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Canonical Url</label>
            <input class="form-control" type="text" name="seocanonical" placeholder="Enter canonical here"  data-parsley-trigger="change" data-parsley-error-message="Please enter canonical">
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<h2>Content</h2>
<div class="row">
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO H2 Title</label>
            <input class="form-control" type="text" name="seoh2title" placeholder="Enter H2 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H2 title">
        </div>
    </div>
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO H3 Title</label>
            <input class="form-control" type="text" name="seoh3title" placeholder="Enter H3 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H3 title">
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO Image</label>
            <input type="file" class="form-control" name="seoimage" class="input input-file featuredImage"  data-parsley-error-message="Please upload only png , jpg or jpeg." onchange="readURL1(this);" autofocus="" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">
            <img  class="img-responsive margin-top15"  id="uploadImage1" src="/assets/images/no-college-logo.jpg" alt="your image" style="width: 200px; height: 160px; "/>
            <p class="text-danger hide" id="logoDoc">(please upload .png, .jpg and .jpeg file only)</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO Image alt text</label>
            <input class="form-control" type="text" name="seoimagealttext" placeholder="Enter image alt text here"  data-parsley-trigger="change" data-parsley-error-message="Please enter image alt text">
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Content Description</label>
             {!! Form::textarea('seocontent', null, ['class' => 'form-control summernote', 'data-parsley-error-message' => 'Please enter page content ', 'data-parsley-trigger' => 'change', 'placeholder' => 'Enter page content here']) !!}
        </div>
    </div>
</div>
<h2>Metadeta</h2>
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Page Title</label>
            @if(!empty($seocontent[0]->pagetitle))
                <input class="form-control" type="text" name="seopagetitle" placeholder="Enter page title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter page title" value="{{ $seocontent[0]->pagetitle }}">
            @else
                <input class="form-control" type="text" name="seopagetitle" placeholder="Enter page title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter page title" value="">
            @endif
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO H1 Title</label>
            @if(!empty($seocontent[0]->h1title))
                <input class="form-control" type="text" name="seoh1title" placeholder="Enter H1 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H1 title" value="{{ $seocontent[0]->h1title }}">
            @else
                <input class="form-control" type="text" name="seoh1title" placeholder="Enter H1 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H1 title">
            @endif
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Meta Keyword</label>
            @if(!empty($seocontent[0]->keyword))
                <input class="form-control" type="text" name="seokeyword" placeholder="Enter meta keyword here"  data-parsley-trigger="change" data-parsley-error-message="Please enter meta keyword" value="{{ $seocontent[0]->keyword }}">
            @else
                <input class="form-control" type="text" name="seokeyword" placeholder="Enter meta keyword here"  data-parsley-trigger="change" data-parsley-error-message="Please enter meta keyword" value="{{ $seocontent[0]->keyword }}">
            @endif
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Description</label>
            @if(!empty($seocontent[0]->SEODescription))
                <textarea name="seoseoDescription" placeholder="Enter page description here"  data-parsley-trigger="change" data-parsley-error-message="Please enter page description" class="summernote">{{ $seocontent[0]->SEODescription }}</textarea>
            @else
                <textarea name="seoseoDescription" placeholder="Enter page description here"  data-parsley-trigger="change" data-parsley-error-message="Please enter page description" class="summernote"></textarea>
            @endif
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Canonical Url</label>
            @if(!empty($seocontent[0]->canonical))
                <input class="form-control" type="text" name="seocanonical" placeholder="Enter canonical here"  data-parsley-trigger="change" data-parsley-error-message="Please enter canonical" value="{{ $seocontent[0]->canonical }}">
            @else
                <input class="form-control" type="text" name="seocanonical" placeholder="Enter canonical here"  data-parsley-trigger="change" data-parsley-error-message="Please enter canonical">
            @endif
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<h2>Content</h2>
<div class="row">
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO H2 Title</label>
            @if(!empty($seocontent[0]->h2title))
                <input class="form-control" type="text" name="seoh2title" placeholder="Enter H2 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H2 title" value="{{ $seocontent[0]->h2title }}">
            @else
                <input class="form-control" type="text" name="seoh2title" placeholder="Enter H2 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H2 title">
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO H3 Title</label>
            @if(!empty($seocontent[0]->h3title))
                <input class="form-control" type="text" name="seoh3title" placeholder="Enter H3 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H3 title" value="{{ $seocontent[0]->h3title }}">
            @else
                <input class="form-control" type="text" name="seoh3title" placeholder="Enter H3 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H3 title" value="{{ $seocontent[0]->h3title }}">
            @endif
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO Image</label>
            <input type="file" class="form-control" name="seoimage" class="input input-file featuredImage"  data-parsley-error-message="Please upload only png , jpg or jpeg." onchange="readURL1(this);" autofocus="" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">
             @if($seocontent[0]->image != '')
                <img class="img-thumbnail img-responsive" src="{{ asset('seo-content') }}/{{ $seocontent[0]->image }}" style="width: 200px; height: 160px; ">
            @else
                <img  class="img-responsive margin-top15"  id="uploadImage1" src="/assets/images/no-college-logo.jpg" alt="your image" style="width: 200px; height: 160px; "/>
            @endif
            <p class="text-danger hide" id="logoDoc">(please upload .png, .jpg and .jpeg file only)</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="margin-bottom-20">
            <label>SEO Image alt text</label>
            @if(!empty($seocontent[0]->imagealttext))
                <input class="form-control" type="text" name="seoimagealttext" placeholder="Enter image alt text here"  data-parsley-trigger="change" data-parsley-error-message="Please enter image alt text" value="{{ $seocontent[0]->imagealttext }}">
            @else
                <input class="form-control" type="text" name="seoimagealttext" placeholder="Enter image alt text here"  data-parsley-trigger="change" data-parsley-error-message="Please enter image alt text">
            @endif
        </div>
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <div class="margin-bottom-20">
            <label>SEO Image Description</label>
             @if(!empty($seocontent[0]->content))
                <textarea name="seocontent" placeholder="Enter image alt long description here"  data-parsley-trigger="change" data-parsley-error-message="Please enter image alt long description" class="summernote">{{ $seocontent[0]->content }}</textarea>
            @else
                <textarea name="seocontent" placeholder="Enter image alt long description here"  data-parsley-trigger="change" data-parsley-error-message="Please enter image alt long description" class="summernote"></textarea>
            @endif
        </div>
    </div>
</div>
@props(['category'])

<div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.{{ array_rand([1, 3, 5, 7]) }}s">
    <a class="cat-item rounded p-4" href="">
        <i class="fa fa-3x fa-book-reader text-primary mb-4"></i>
        <h6 class="mb-3" title="{{ $category->name }}">{{ $category->short_name }}</h6>
        <p class="mb-0">{{ $category->jobs_count }} {{ Str::plural('job', $category->jobs_count) }}</p>
    </a>
</div>
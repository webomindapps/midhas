<x-frontend.page>
    <section class="section breadcrumb pb-0 seo_content w-100">
        <div class="container text-start">
            <ul class="list_styled d-flex breadcrumb mb-5">
                <li><a href="{{ url('/') }}">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                <li>{{ $blogs->blog_title }}</li>
            </ul>

        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-2">
                    <div class="sidebar p-3 border rounded shadow-sm">
                        <!-- All Main Categories -->
                        <h5 class="mb-3">CATEGORY</h5>
                        <ul class="list-unstyled">
                            @foreach ($allCategories->where('parent_id', null) as $category)
                                <li>
                                    <a
                                        href="{{ route('blog.list', $category->id) }}">{{ \Illuminate\Support\Str::ucfirst(Str::lower($category->name)) }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Current Blog's Category -->
                        @if ($blogs->blogcategory)
                            <h5 class="mt-4 mb-2">This Blog Belongs To</h5>
                            <p><strong>{{ $blogs->blogcategory->name }}</strong></p>
                        @endif

                        <!-- Recent Posts -->
                        <h5 class="mt-4 mb-3">Recent Posts</h5>
                        <ul class="list-unstyled">
                            @foreach ($recentPosts as $recent)
                                <li class="d-flex mb-3">
                                    <div class="me-2" style="width: 60px;">
                                        <img src="{{ asset('storage/' . $recent->blog_image) }}"
                                            alt="{{ $recent->blog_title }}" class="img-fluid rounded"
                                            style="object-fit: cover;">
                                    </div>
                                    <div>
                                        <a href="{{ route('blog.view', $recent->id) }}" class="d-block">
                                            {{ Str::limit($recent->blog_title, 50) }}
                                        </a>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($recent->blog_date)->format('M d, Y') }}
                                        </small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Blog Content -->
                <div class="col-lg-8">
                    <h1 class="blog__title blog__title--1">
                        {{ $blogs->blog_title }} </h1>
                    <div class="col-md-4">
                        <p class="blog-date mt-2">
                            <i
                                class="fa-solid fa-calendar-days me-3"></i>{{ strtoupper(\Carbon\Carbon::parse($blogs->blog_date)->format('M d Y')) }}
                        </p>
                    </div>
                    <div class="clo-md-12 mt-4 mb-4">
                        <img class="blog_image" src="{{ asset('storage/' . $blogs->blog_image) }}">
                    </div>
                </div>
                <div class="clo-md-12 mt-4 mb-4 ms-4 p-5">
                    {!! $blogs->blog_description !!}
                </div>
            </div>
        </div>
        </div>
    </section>

</x-frontend.page>

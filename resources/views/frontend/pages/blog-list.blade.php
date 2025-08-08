<x-frontend.page>
    <section class="section breadcrumb pb-0 seo_content w-100">
        <div class="container text-start">
            <ul class="list_styled d-flex breadcrumb mb-5">
                <li><a href="{{ url('/') }}">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                <li>{{ $category->name }}</li>
            </ul>

        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <h3 class="blog__title blog__title--1 text-center mb-4">
                CATEGORY</h3>
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

                        {{-- <!-- Current Blog's Category -->
                        @if ($blog->blogcategory)
                            <h5 class="mt-4 mb-2">This Blog Belongs To</h5>
                            <p><strong>{{ $blog->blogcategory->blog_title }}</strong></p>
                        @endif --}}

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

                    <div class="row g-4">
                        @forelse($blogs as $blog)
                            <div class="col-12">
                                <div class="d-md-flex align-items-start gap-4 border-bottom pb-4 mb-4">
                                    <!-- Image with date badge -->
                                    <div class="position-relative" style="flex-shrink: 0; width: 280px;">
                                        <img src="{{ asset('storage/' . $blog->blog_image) }}"
                                            alt="{{ $blog->blog_title }}" class="img-fluid rounded"
                                            style="object-fit: cover; width: 100%; height: auto;">

                                        <div
                                            class="position-absolute top-0 end-0 bg-light px-2 py-1 m-2 text-dark small">
                                            {{ \Carbon\Carbon::parse($blog->blog_date)->format('d/m/Y') }}
                                        </div>
                                    </div>

                                    <!-- Blog Content -->
                                    <div class="flex-grow-1">
                                        <p class="text-success mb-1">
                                            {{ \Illuminate\Support\Str::ucfirst(Str::lower($blog->blogcategory->name)) }}
                                        </p>


                                        <h5 class="fw-bold text-dark">
                                            <a href="{{ route('blog.view', $blog->id) }}"
                                                class="text-decoration-none text-dark">
                                                {{ $blog->blog_title }}
                                            </a>
                                        </h5>

                                        <p class="text-muted">
                                            {{ Str::limit(strip_tags($blog->blog_description), 250) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>No blogs found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend.page>

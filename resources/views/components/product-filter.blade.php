@props(['subcategories'=>[], 'filters' => [], 'brands' => []])

<div class="sidebar">
    <ul class="list-group border-0 text_hind">
        <li class="list-group-item">
            <a class="btn btn-category">Your Selection</a>
            <div class="card card-body bg-white">
                <p class="mb-0"><span class="fw-medium">Type :</span> {{ $currentCategory->name ?? ''}}</p>
            </div>
        </li>

        <!-- Departments Section with Checkboxes -->
        <li class="list-group-item">
            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="true" aria-controls="collapseExample">
                Departments <i class="fa-solid fa-plus pt-1 float-end"></i>
            </a>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body bg-white">
                    @foreach ($subcategories as $category)
                        <div class="form-check">
                            <a href="{{ route('productByCategory', $category->slug) }}">
                                <label class="form-check-label" for="flexCheckDefault-{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample1" role="button"
                aria-expanded="false" aria-controls="collapseExample1"> Brands <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample1">
                <div class="card card-body bg-white">
                    @foreach ($brands as $brand)
                        <div class="form-check">
                            <input class="form-check-input brand" type="checkbox" name="brand"
                                value="{{ $brand->id }}" id="flexCheckDefault-{{ $brand->id }}">
                            <label class="form-check-label" for="flexCheckDefault-{{ $brand->id }}">
                                {{ $brand->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </li>
        {{-- Availability filters --}}
        @foreach ($filters as $filter)
            <li class="list-group-item">
                <a class="btn btn-category collapsed" data-bs-toggle="collapse"
                    href="#collapseFilter{{ $filter['id'] }}" role="button" aria-expanded="false"
                    aria-controls="collapseFilter{{ $filter['id'] }}"> {{ $filter['name'] }}
                    <i class="fa-solid fa-plus pt-1 float-end"></i>
                </a>
                <div class="collapse" id="collapseFilter{{ $filter['id'] }}">
                    <div class="card card-body bg-white">
                        @if ($filter['type'] == 'checkbox')
                            @foreach ($filter['values'] as $value)
                                @php
                                    $prdCount = \App\Models\Product\Product::whereIn('id', $filter['productsIds'])
                                        ->where($filter['column'], $value['value'])
                                        ->count();
                                @endphp
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input specifications"
                                        id="checkbox-{{ $filter['id'] }}-{{ Str::slug($value['value'], '-') }}"
                                        value="{{ $value['value'] }}">
                                    <label class="form-check-label"
                                        for="checkbox-{{ $filter['id'] }}-{{ Str::slug($value['value'], '-') }}">{{ $value['value'] }}
                                        ({{ $prdCount }})
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample4" role="button"
                aria-expanded="false" aria-controls="collapseExample4"> Price <i
                    class="fa-solid fa-plus pt-1 float-end"></i>
            </a>
            <div class="collapse" id="collapseExample4">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="0-1000"
                            id="price1">
                        <label class="form-check-label" for="price1">
                            Under 1,000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="1001-2000"
                            id="price2">
                        <label class="form-check-label" for="price2">
                            1,001 - 2,000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="2001-3000"
                            id="price3">
                        <label class="form-check-label" for="price3">
                            2,001 - 3,000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="3001-4000"
                            id="price3">
                        <label class="form-check-label" for="price3">
                            3,001 - 4,000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="4001-5000"
                            id="price3">
                        <label class="form-check-label" for="price3">
                            4,001 - 5,000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="5001-10000"
                            id="price3">
                        <label class="form-check-label" for="price3">
                            Above 5,001
                        </label>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
@push('scripts')
    <script src="{{ asset('frontend/js/product-filter.js') }}"></script>
@endpush

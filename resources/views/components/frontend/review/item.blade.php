@props(['review'])
<div class="row ">
    <div class="col-lg-10 pt-4">
        <div class="ratting">
            <div class="pr-rating-star">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($review->rating))
                        <div class="rating-star">
                            <i class="fas fa-star"></i>
                        </div>
                    @else
                        <div class="rating-star-not-selected">
                            <i class="fas fa-star"></i>
                        </div>
                    @endif
                @endfor
                <div class="rating-value">
                    <span>{{ round($review->rating) }}</span>
                </div>
                <h5 class="ps-lg-4 my-auto">{{ $review->title }}<h5>
            </div>
        </div>

        <div class="feedback-cmt px-0">
            <p>
                {{ $review->description }}
            </p>
        </div>



    </div>
    <div class="col-lg-2 pt-4 px-lg-4">
        <div class="user-details">
            <p>
                <b>Submitted</b> {{ $review->created_at->format('d M Y') }}
            </p>
            <p>
                <b>By</b> {{ $review->user->name }}
            </p>

        </div>
    </div>
</div>

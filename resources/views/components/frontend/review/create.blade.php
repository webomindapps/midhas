<div class="col-lg-8 mx-auto">
    <form action="{{ route('review.store', ['product' => $product->id]) }}" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
        <div class="review-form py-5">
            <h4 class="text-center">Write A Review</h4>
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Your Rating</label>
                    <div id="front-app">
                        <div class="star-rating d-flex flex-row-reverse justify-content-end">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating"
                                    value="{{ $i }}">
                                <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
                            @endfor
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <label for="">Review Title</label>
                    <input type="text" name="title" placeholder="I would buy this product again and again">
                </div>
                <div class="col-lg-12">
                    <label for="">Comments</label>
                    <textarea name="description" id="" rows="4">

                </textarea>
                </div>
                <div class="col-lg-4 my-auto">
                    <label for="">Upload image</label>
                    <input type="file" name="images[]" id="" multiple>
                </div>

                <div class="col-lg-12">
                    <button class="submit-review">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<x-page-content title="Review Details" :isBack="true">

    <div class="accordion-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Product</td>
                            <td>{{ $review->reviewable_type::find($review->reviewable_id)->title }}</td>
                        </tr>
                        <tr>
                            <td>Rating</td>
                            <td>{{ $review->rating }}</td>
                        </tr>
                        <tr>
                            <td> Title</td>
                            <td>{{ $review->title }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $review->description }}</td>
                        </tr>
                        <tr>
                            <td>
                                Images
                            </td>
                            <td>
                                <div class="flex">
                                    @foreach ($review->images as $image)
                                        <img style="margin-right: 10px" src="{{ asset('storage/' . $image->url) }}"
                                            height="100px" alt="">
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('put')
                                    <div class="d-flex">
                                        <select name="status" id="status">
                                            <option @if ($review->status == 0) selected @endif value="0">
                                                Pending
                                            </option>
                                            <option @if ($review->status == 1) selected @endif value="1">
                                                Approved
                                            </option>
                                        </select>
                                        <button class="submit-btn bg-success mx-1 mt-0">Update</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-page-content>

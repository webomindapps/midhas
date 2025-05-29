<x-page-content title="Enquiry Details" :isBack="true">

    <div class="accordion-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Product</td>
                            <td>{{ $enquiry->product_name }}</td>
                        </tr>
                        <tr>
                            <td>Sku</td>
                            <td>{{ $enquiry->sku }}</td>
                        </tr>
                        <tr>
                            <td> Brand </td>
                            <td>{{ $enquiry->brand }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $enquiry->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                Phone
                            </td>
                            <td>
                                {{ $enquiry->phone }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Message
                            </td>
                            <td>
                                {{ $enquiry->message }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <form action="{{ route('admin.enquiries.update', $enquiry->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('put')
                                    <div class="d-flex">
                                        <select name="status" id="status">
                                            <option @if ($enquiry->status == 1) selected @endif value="1">
                                                Created
                                            </option>
                                            <option @if ($enquiry->status == 2) selected @endif value="2">
                                                Completed
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

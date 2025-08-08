<x-page-content :title="'#' . $order->id" :isBack="true">
    <form id="submitForm" action="{{ route('admin.invoice.store', ['order' => $order->id]) }}" method="POST">

        <x-slot:breadcrumb>
            <button class="submit-btn bg-success mx-1 mt-0 breadcrumbForm">
                Save Invoice
            </button>
        </x-slot:breadcrumb>

        @csrf
        <div class="col-lg-12">
            <div class="mt-5">
                <div class="col-md-12">
                    <div class="col-md-12 order-detail">
                        <x-orders.details :order="$order" id="invoice">
                            <x-slot:orderSection>
                                <div class="row">
                                    <x-forms.textarea label="Invoice Comments" name="comments" id="comments"
                                        :required="false" size="col-lg-12 mb-2" :value="old('comments')" />
                                </div>
                            </x-slot:orderSection>
                        </x-orders.details>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-page-content>

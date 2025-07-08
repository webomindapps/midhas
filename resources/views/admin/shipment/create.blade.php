<x-page-content :title="'#' . $order->id" :isBack="true">
    <form id="submitForm" action="{{ route('admin.shipment.store', ['order' => $order->id]) }}" method="POST">

        <x-slot:breadcrumb>
            <button class="submit-btn bg-success mx-1 mt-0 breadcrumbForm">
                Save Shipment
            </button>
        </x-slot:breadcrumb>

        @csrf
        <div class="col-lg-12">
            <div class="mt-5">
                <div class="col-md-12">
                    <div class="col-md-12 order-detail">
                        <x-orders.details :order="$order" id="shipemnt">
                            <x-slot:addressSection>
                                <div class="row">
                                    <x-forms.input label="Shipment Name" type="text" name="shipment_name"
                                        id="shipment_name" :required="false" size="col-lg-4 mt-4" :value="old('shipment_name')" />

                                    <x-forms.input label="Tracking Id" type="text" name="tracking_id"
                                        id="tracking_id" :required="false" size="col-lg-4 mt-4" :value="old('tracking_id')" />

                                    <x-forms.input label="Shipment Date" type="date" name="shipment_date"
                                        id="shipment_date" :required="false" size="col-lg-4 mt-4" :value="old('shipment_date')" />

                                    <x-forms.textarea label="Shipment Comments" name="comments" id="comments"
                                        :required="false" size="col-lg-12 mb-2" :value="old('comments')" />
                                </div>
                            </x-slot:addressSection>
                        </x-orders.details>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-page-content>

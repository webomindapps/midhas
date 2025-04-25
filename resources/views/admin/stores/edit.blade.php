<x-page-content title="Edit Store" isBack="{{ true }}">
    <div class="col-lg-12 py-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.stores.update', $store) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-accordion.group>
                    <x-accordion.item id="generay" title="General">
                        <div class="row">
                            <x-forms.input label="Store Name" type="text" name="name" id="name"
                                :required="true" size="col-lg-4 mt-4" :value="$store->name" class="slug" />
                            <x-forms.input label="Manager Name" type="text" name="manager_name" id="manager_name"
                                :required="true" size="col-lg-4 mt-4" :value="$store->manager_name" class="slug" />

                            <x-forms.input label="Location" type="text" name="location" id="location"
                                :required="true" size="col-lg-4 mt-4" :value="$store->location" class="slug" />

                            <x-forms.textarea label="Address" name="address" id="editor-4" :required="true"
                                size="col-lg-12 mt-4" :value="$store->address" class="slug" :editor="true" />

                            <x-forms.textarea label="Map Link" name="map_link" id="map_link" :required="true"
                                size="col-lg-4 mt-4" :value="$store->map_link" class="slug" />

                            {{-- <x-forms.textarea label="Working Hours" name="working_hours" id="working_hours"
                                :required="true" size="col-lg-4 mt-4" :value="$store->working_hours" class="slug" /> --}}

                            <x-forms.input label="Phone" type="text" name="phone" id="phone"
                                :required="true" size="col-lg-4 mt-4" :value="$store->phone" class="slug" />

                            <x-forms.input label="Email" type="email" name="email" id="email"
                                :required="true" size="col-lg-4 mt-4" :value="$store->email" class="slug" />

                            <x-forms.input label="Password" type="password" name="password" id="password"
                                :required="false" size="col-lg-4 mt-4" :value="old('password')" class="slug" />

                            <x-forms.input label="Confirm Password" type="password" name="password_confirmation"
                                id="password_confirmation" :required="false" size="col-lg-4 mt-4" :value="old('password_confirmation')"
                                class="slug" />

                            <div class="col-lg-12">
                                <x-admin.working-hours :items="$store->workingHours" />
                            </div>

                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="employee" title="Employees">
                        <div class="row">
                            <div class="col-lg-12" id="admin-app-one">
                                <multiple-item :headings="{{ json_encode(getMultipleItemMenu('employees')) }}"
                                    :existing="{{ json_encode($store->employees) }}" name="stores" />
                            </div>
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="media-gallery" title="Media Gallery">
                        <div class="row">
                            <x-forms.textarea label="Video Link" name="video_link" id="video_link" :required="false"
                                size="col-lg-12 mt-4" :value="$store->video_link" class="slug" />

                            <x-forms.input label="Upload Image" type="file" name="store_image" id="store_image"
                                :required="false" size="col-lg-4 mt-4" :value="$store->store_image" class="image-file"
                                :image="true" imageValue="{{ $store->store_image }}" />
                            <div class="col-lg-1 my-auto text-center">
                                <h5 class="pt-5">OR</h5>
                            </div>
                            <x-forms.input label="Image Link" type="text" name="store_image_link"
                                id="store_image_link" :required="false" size="col-lg-4 mt-4" :value="$store->store_image_link"
                                class="slug" />
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="support" title="Support">
                        <div class="row">
                            <x-forms.textarea label="Customer Care" name="customer_care" id="editor-1"
                                :required="false" size="col-lg-12 mt-4" :value="$store->customer_care" :editor="true"
                                class="slug" />

                            <x-forms.textarea label="Delivery Enquiries" name="delivery_enquiries" id="editor-2"
                                :required="false" size="col-lg-12 mt-4" :value="$store->delivery_enquiries" :editor="true"
                                class="slug" />

                            <x-forms.textarea label="Sales Info" name="sales_info" id="editor-3" :required="false"
                                size="col-lg-12 mt-4" :value="$store->sales_info" class="slug" :editor="true" />
                        </div>
                    </x-accordion.item>

                </x-accordion.group>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

    {{-- <x-slot:scripts>
        <x-admin.editor />
    </x-slot:scripts> --}}

</x-page-content>

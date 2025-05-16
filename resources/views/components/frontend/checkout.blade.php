 {{-- <div class="row">
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="First Name" required="">
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="Last Name" required="">
     </div>
     <div class="col-md-4">
         <input type="email" class="form-control" id="" name="" placeholder="E-mail" required="">
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="Company Name"
             required="">
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="Address line 1"
             required="">
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="Address line 2"
             required="">
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="City" required="">
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="Province" required="">
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="" placeholder="Postal Code"
             required="">
     </div>
     <div class="col-md-4">
         <input type="tel" class="form-control" id="" name="" placeholder="Contact Number"
             required="">
     </div>
     <div class="col-md-4">
         <input type="tel" class="form-control" id="" name="" placeholder="Work Phone Number"
             required="">
     </div>
     <div class="col-md-4">
         <input type="tel" class="form-control" id="" name="" placeholder="Alternate Number"
             required="">
     </div>
     <div class="col-md-6">
         <select id="country" name="country" class="form-select form-control">
             <!-- <option value="" selected></option> -->
             <option value="" selected disabled>How did you find out about us?</option>
             <option value="usa">United States</option>
             <option value="canada">Canada</option>
             <option value="uk">United Kingdom</option>
             <option value="australia">Australia</option>
         </select>
     </div>
 </div> --}}

 @props([
     'prefix' => 'shipping',
 ])

 <div class="row">

     <div class="col-md-4">

         <input type="text" class="form-control" name="{{ $prefix }}_first_name" placeholder="First Name" required>
     </div>
     <div class="col-md-4">

         <input type="text" class="form-control" id="" name="{{ $prefix }}_last_name"
             placeholder="Last Name" required>
     </div>
     <div class="col-md-4 a-d-company">
         <input type="email" class="form-control" id="" name="{{ $prefix }}_email" placeholder="E-mail"
             required>
     </div>

     <div class="col-md-4 a-d-company">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_company_name"
             placeholder="Company Name" required>
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_address_1"
             placeholder="Address line 1" required>
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_address_2"
             placeholder="Address line 2" required>
     </div>


     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_city" placeholder="City"
             required>
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_province"
             placeholder="Province" required>
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_postal_code"
             placeholder="Postal Code" required>
     </div>

     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_contact_number"
             placeholder="Contact Number" required>
     </div>
     <div class="col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_phone_number"
             placeholder="Work Phone Number" required>
     </div>
     <div class=" col-md-4">
         <input type="text" class="form-control" id="" name="{{ $prefix }}_alternate_number"
             placeholder="Alternate Number" required>
     </div>


     <div class="col-md-6 a-d-company">

         <select name="{{ $prefix }}_how_you_know_about_us" class="form-select form-control">

             <option value="">How did you find out about us?</option>
             <option value="usa">United States</option>
             <option value="canada">Canada</option>
             <option value="uk">United Kingdom</option>
             <option value="australia">Australia</option>
         </select>
     </div>



 </div>

@props([
    'existing' => null,
])
<x-accordion.item id="filter-form-details" title="Filter Form">
    <div class="row">

        <x-forms.input label="Color" type="text" name="color" id="color" :required="false" size="col-lg-2 mt-1"
            :value="old('color', $existing?->color)" />

        <x-forms.input label="Width Group" type="text" name="width_group" id="width_group" :required="false"
            size="col-lg-2 mt-1" :value="old('width_group', $existing?->width_group)" />


        <x-forms.input label="Capacity (cuft)" type="text" name="capacity_cuft" id="capacity_cuft" :required="false"
            size="col-lg-2 mt-1" :value="old('capacity_cuft', $existing?->capacity_cuft)" class="price" />

        <x-forms.select label="Counter Depth" name="counter_depth" id="counter_depth" :required="false"
            size="col-lg-2 mt-1" :value="old('counter_depth', $existing?->counter_depth)" :options="Teletime::getCondition()" />

        <x-forms.input label="Built In" type="text" name="built_in" id="built_in" :required="false"
            size="col-lg-2 mt-1" :value="old('built_in', $existing?->built_in)" />

        <x-forms.select label="Accept Custom Panel" name="accept_custom_panel" id="accept_custom_panel"
            :required="false" size="col-lg-2 mt-1" :value="old('accept_custom_panel', $existing?->accept_custom_panel)" :options="Teletime::getCondition()" />

        <x-forms.input label="Water Dispenser" type="text" name="water_dispenser" id="water_dispenser"
            :required="false" size="col-lg-2 mt-1" :value="old('water_dispenser', $existing?->water_dispenser)" />

        <x-forms.input label="Ice Maker" type="text" name="ice_maker" id="ice_maker" :required="false"
            size="col-lg-2 mt-1" :value="old('ice_maker', $existing?->ice_maker)" />

        <x-forms.input label="Height (Inches)" type="text" name="height_inch" id="height_inch" :required="false"
            size="col-lg-2 mt-1" :value="old('height_inch', $existing?->height_inch)" class="price" />

        <x-forms.input label="Depth (Inches)" type="text" name="depth_inch" id="depth_inch" :required="false"
            size="col-lg-2 mt-1" :value="old('depth_inch', $existing?->depth_inch)" class="price" />

        <x-forms.input label="Width (Inches)" type="text" name="width_inch" id="width_inch" :required="false"
            size="col-lg-2 mt-1" :value="old('width_inch', $existing?->width_inch)" class="price" />

        <x-forms.select label="Energy Star Certified" name="energy_star_certified" id="energy_star_certified"
            :required="false" size="col-lg-2 mt-1" :value="old('energy_star_certified', $existing?->energy_star_certified)" :options="Teletime::getCondition()" />

        <x-forms.input label="Freezer Capacity (cuft)" name="freezer_capacity_cuft" id="freezer_capacity_cuft"
            :required="false" size="col-lg-2 mt-1" :value="old('freezer_capacity_cuft', $existing?->freezer_capacity_cuft)" class="price" />


        <x-forms.input label="Interior Light (Refrigerator)" type="text" name="interior_light_refrigerator"
            id="interior_light_refrigerator" :required="false" size="col-lg-2 mt-1" :value="old('interior_light_refrigerator', $existing?->interior_light_refrigerator)" />


        <x-forms.select label="Sabbath Mode Function" name="sabbath_mode_function" id="sabbath_mode_function"
            :required="false" size="col-lg-2 mt-1" :value="old('sabbath_mode_function', $existing?->sabbath_mode_function)" :options="Teletime::getCondition()" />

        <x-forms.input label="Doors" type="text" name="doors" id="doors" :required="false"
            size="col-lg-2 mt-1" :value="old('doors', $existing?->doors)" class="price" />


        <x-forms.select label="Fingerprint Resistant" name="fingerprint_resistant" id="fingerprint_resistant"
            :required="false" size="col-lg-2 mt-1" :value="old('fingerprint_resistant', $existing?->fingerprint_resistant)" :options="Teletime::getCondition()" />


        <x-forms.select label="Wifi Enabled" name="wifi_enabled" id="wifi_enabled" :required="false"
            size="col-lg-2 mt-1" :value="old('wifi_enabled', $existing?->wifi_enabled)" :options="Teletime::getCondition()" />


        <x-forms.input label="Defrost" type="text" name="defrost" id="defrost" :required="false"
            size="col-lg-2 mt-1" :value="old('defrost', $existing?->defrost)" />

        <x-forms.select label="Lock" name="lock" id="lock" :required="false" size="col-lg-2 mt-1"
            :value="old('lock', $existing?->lock)" :options="Teletime::getCondition()" />


        <x-forms.select label="Reversible Door" name="reversible_door" id="reversible_door" :required="false"
            size="col-lg-2 mt-1" :value="old('reversible_door', $existing?->reversible_door)" :options="Teletime::getCondition()" />

        <x-forms.select label="Under the Counter" name="under_the_counter" id="under_the_counter" :required="false"
            size="col-lg-2 mt-1" :value="old('under_the_counter', $existing?->under_the_counter)" :options="Teletime::getCondition()" />

        <x-forms.select label="Convertible Fridge/Freezer" name="convertible_fridge_freezer"
            id="convertible_fridge_freezer" :required="false" size="col-lg-2 mt-1" :value="old('convertible_fridge_freezer', $existing?->convertible_fridge_freezer)"
            :options="Teletime::getCondition()" />


        <x-forms.input label="Power Type" type="text" name="power_type" id="power_type" :required="false"
            size="col-lg-2 mt-1" :value="old('power_type', $existing?->power_type)" />


        <x-forms.input label="Range Style" type="text" name="range_style" id="range_style" :required="false"
            size="col-lg-2 mt-1" :value="old('range_style', $existing?->range_style)" />

        <x-forms.input label="Exterior Width" type="text" name="exterior_width" id="exterior_width"
            :required="false" size="col-lg-2 mt-1" :value="old('exterior_width', $existing?->exterior_width)" />


        <x-forms.select label="Self Clean" name="self_clean" id="self_clean" :required="false" size="col-lg-2 mt-1"
            :value="old('self_clean', $existing?->self_clean)" :options="Teletime::getCondition()" />

        <x-forms.select label="Convection" name="convection" id="convection" :required="false" size="col-lg-2 mt-1"
            :value="old('convection', $existing?->convection)" :options="Teletime::getCondition()" />


        <x-forms.input label="Number of Burners" name="number_of_burners" id="number_of_burners" :required="false"
            size="col-lg-2 mt-1" :value="old('number_of_burners', $existing?->number_of_burners)" class="price" />

        <x-forms.input label="Warmer/Bake Drawer" type="text" name="warmer_bake_drawer" id="warmer_bake_drawer"
            :required="false" size="col-lg-2 mt-1" :value="old('warmer_bake_drawer', $existing?->warmer_bake_drawer)" />

        <x-forms.select label="Air Fry" name="air_fry" id="air_fry" :required="false" size="col-lg-2 mt-1"
            :value="old('convection', $existing?->air_fry)" :options="Teletime::getCondition()" />

        <x-forms.input label="Ovens" name="ovens" id="ovens" :required="false" size="col-lg-2 mt-1"
            :value="old('ovens', $existing?->ovens)" class="price" />


        <x-forms.input label="Cooktop Surface" type="text" name="cooktop_surface" id="cooktop_surface"
            :required="false" size="col-lg-2 mt-1" :value="old('cooktop_surface', $existing?->cooktop_surface)" />

        <x-forms.select label="Certified Sabbath Mode" name="certified_sabbath_mode" id="certified_sabbath_mode"
            :required="false" size="col-lg-2 mt-1" :value="old('certified_sabbath_mode', $existing?->certified_sabbath_mode)" :options="Teletime::getCondition()" />


        <x-forms.input label="Highest Burner" type="text" name="highest_burner" id="highest_burner"
            :required="false" size="col-lg-2 mt-1" :value="old('highest_burner', $existing?->highest_burner)" />


        <x-forms.input label="Liquid Propane Conversion" type="text" name="liquid_propane_conversion"
            id="liquid_propane_conversion" :required="false" size="col-lg-2 mt-1" :value="old('liquid_propane_conversion', $existing?->liquid_propane_conversion)" />


        <x-forms.input label="Highest Burner Element (Watts)" type="text" name="highest_burner_element_watts"
            id="highest_burner_element_watts" :required="false" size="col-lg-2 mt-1" :value="old('highest_burner_element_watts', $existing?->highest_burner_element_watts)" />


        <x-forms.input label="Electric Oven Broil Element (Watts)" name="electric_oven_broil_element_watts"
            id="electric_oven_broil_element_watts" :required="false" size="col-lg-2 mt-1" :value="old('electric_oven_broil_element_watts', $existing?->electric_oven_broil_element_watts)"
            class="price" />

        <x-forms.input label="Electric Oven Bake Element (Watts)" name="electric_oven_bake_element_watts"
            id="electric_oven_bake_element_watts" :required="false" size="col-lg-2 mt-1" :value="old('electric_oven_bake_element_watts', $existing?->electric_oven_bake_element_watts)"
            class="price" />

        <x-forms.input label="Controls" type="text" name="controls" id="controls" :required="false"
            size="col-lg-2 mt-1" :value="old('controls', $existing?->controls)" />


        <x-forms.input label="Cooktop Burners" type="text" name="cooktop_burners" id="cooktop_burners"
            :required="false" size="col-lg-2 mt-1" :value="old('cooktop_burners', $existing?->cooktop_burners)" />

        <x-forms.select label="Downdraft" name="downdraft" id="downdraft" :required="false" size="col-lg-2 mt-1"
            :value="old('downdraft', $existing?->downdraft)" :options="Teletime::getCondition()" />

        <x-forms.select label="Induction" name="induction" id="induction" :required="false" size="col-lg-2 mt-1"
            :value="old('induction', $existing?->induction)" :options="Teletime::getCondition()" />


        <x-forms.select label="Temperature Probe" name="temperature_probe" id="temperature_probe" :required="false"
            size="col-lg-2 mt-1" :value="old('temperature_probe', $existing?->temperature_probe)" :options="Teletime::getCondition()" />

        <x-forms.select label="Optional Trim Kit" name="optional_trim_kit" id="optional_trim_kit" :required="false"
            size="col-lg-2 mt-1" :value="old('optional_trim_kit', $existing?->optional_trim_kit)" :options="Teletime::getCondition()" />


        <x-forms.input label="Venting Type" type="text" name="venting_type" id="venting_type" :required="false"
            size="col-lg-2 mt-1" :value="old('venting_type', $existing?->venting_type)" />

        <x-forms.input label="Style" type="text" name="style" id="style" :required="false"
            size="col-lg-2 mt-1" :value="old('style', $existing?->style)" />


        <x-forms.input label="Mounting" type="text" name="mounting" id="mounting" :required="false"
            size="col-lg-2 mt-1" :value="old('mounting', $existing?->mounting)" />

        <x-forms.input label="CFM" name="cfm" id="cfm" :required="false" size="col-lg-2 mt-1"
            :value="old('cfm', $existing?->cfm)" class="price" />

        <x-forms.input label="Blower" name="blower" id="blower" :required="false" size="col-lg-2 mt-1"
            :value="old('blower', $existing?->blower)" class="price" />

        <x-forms.input label="Cooktop Light" type="text" name="cooktop_light" id="cooktop_light"
            :required="false" size="col-lg-2 mt-1" :value="old('cooktop_light', $existing?->cooktop_light)" />

        <x-forms.input label="Fan Speeds" name="fan_speeds" id="fan_speeds" :required="false" size="col-lg-2 mt-1"
            :value="old('fan_speeds', $existing?->fan_speeds)" class="price" />


        <x-forms.select label="Dishwasher Safe Filters" name="dishwasher_safe_filters" id="dishwasher_safe_filters"
            :required="false" size="col-lg-2 mt-1" :value="old('dishwasher_safe_filters', $existing?->dishwasher_safe_filters)" :options="Teletime::getCondition()" />


        <x-forms.input label="Sones Rating" name="sones_rating" id="sones_rating" :required="false"
            size="col-lg-2 mt-1" :value="old('sones_rating', $existing?->sones_rating)" class="price" />


        <x-forms.input label="Filter Type" type="text" name="filter_type" id="filter_type" :required="false"
            size="col-lg-2 mt-1" :value="old('filter_type', $existing?->filter_type)" />


        <x-forms.input label="Decibel Level" name="decibel_level" id="decibel_level" :required="false"
            size="col-lg-2 mt-1" :value="old('decibel_level', $existing?->decibel_level)" class="price" />


        <x-forms.input label="Control Style" type="text" name="control_style" id="control_style"
            :required="false" size="col-lg-2 mt-1" :value="old('control_style', $existing?->control_style)" />

        <x-forms.select label="Stainless Stell(Interior)" name="stainless_steel_interior"
            id="stainless_steel_interior" :required="false" size="col-lg-2 mt-1" :value="old('stainless_steel_interior', $existing?->stainless_steel_interior)"
            :options="Teletime::getCondition()" />

        <x-forms.input label="Wash Cycle" name="wash_cycle" id="wash_cycle" :required="false" size="col-lg-2 mt-1"
            :value="old('wash_cycle', $existing?->wash_cycle)" class="price" />


        <x-forms.input label="Capacity (Place Settings)" name="capacity_place_setting" id="capacity_place_setting"
            :required="false" size="col-lg-2 mt-1" :value="old('capacity_place_setting', $existing?->capacity_place_setting)" class="price" />

        <x-forms.select label="Hard Food Disposal" name="hard_food_disposal" id="hard_food_disposal"
            :required="false" size="col-lg-2 mt-1" :value="old('hard_food_disposal', $existing?->hard_food_disposal)" :options="Teletime::getCondition()" />

        <x-forms.input label="Loading Racks" name="loading_racks" id="loading_racks" :required="false"
            size="col-lg-2 mt-1" :value="old('loading_racks', $existing?->loading_racks)" class="price" />

        <x-forms.select label="Steam" name="steam" id="steam" :required="false" size="col-lg-2 mt-1"
            :value="old('steam', $existing?->steam)" :options="Teletime::getCondition()" />

        <x-forms.input label="Temperature Settings" name="temperature_settings" id="temperature_settings"
            :required="false" size="col-lg-2 mt-1" :value="old('temperature_settings', $existing?->temperature_settings)" class="price" />

        <x-forms.select label="Stackable" name="stackable" id="stackable" :required="false" size="col-lg-2 mt-1"
            :value="old('stackable', $existing?->stackable)" :options="Teletime::getCondition()" />


        <x-forms.input label="Wash Basket Interior" type="text" name="wash_basket_interior"
            id="wash_basket_interior" :required="false" size="col-lg-2 mt-1" :value="old('wash_basket_interior', $existing?->wash_basket_interior)" />

        <x-forms.input label="Washer Spin Speed(RPM)" name="washer_spin_speed_rpm" id="washer_spin_speed_rpm"
            :required="false" size="col-lg-2 mt-1" :value="old('washer_spin_speed_rpm', $existing?->washer_spin_speed_rpm)" class="price" />

        <x-forms.select label="Water Heater" name="water_heater" id="water_heater" :required="false"
            size="col-lg-2 mt-1" :value="old('water_heater', $existing?->water_heater)" :options="Teletime::getCondition()" />

        <x-forms.input label="Laundry Size" type="text" name="laundry_size" id="laundry_size" :required="false"
            size="col-lg-2 mt-1" :value="old('laundry_size', $existing?->laundry_size)" />


        <x-forms.select label="Agitator" name="agitator" id="agitator" :required="false" size="col-lg-2 mt-1"
            :value="old('agitator', $existing?->agitator)" :options="Teletime::getCondition()" />


        <x-forms.input label="Dry Cycles" name="dry_cycles" id="dry_cycles" :required="false" size="col-lg-2 mt-1"
            :value="old('dry_cycles', $existing?->dry_cycles)" class="price" />


        <x-forms.select label="Portable" name="portable" id="portable" :required="false" size="col-lg-2 mt-1"
            :value="old('portable', $existing?->portable)" :options="Teletime::getCondition()" />

        <x-forms.input label="Vented" type="text" name="vented" id="vented" :required="false"
            size="col-lg-2 mt-1" :value="old('vented', $existing?->vented)" />

        <x-forms.input label="Volts" type="text" name="volts" id="volts" :required="false"
            size="col-lg-2 mt-1" :value="old('volts', $existing?->volts)" />


    </div>
</x-accordion.item>

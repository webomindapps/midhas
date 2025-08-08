<template>
    <div class="row">
        <div class="col-lg-10 mx-auto ">
            <input type="hidden" name="selected_date" v-model="selectedDate" />
            <input type="hidden" name="selected_time" v-model="selectedTime" />
            <input type="hidden" name="selected_price" v-model="selectedPrice" />
            <div class="col-12">
                <div class="row reverse align-items-center">
                    <div class="col-md-12 pt-5">
                        <div class="select-pickup">
                            <h2 class="text-left">
                                Select Delivery or Pickup
                            </h2>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-sm-6 col-md-8">
                                <div class="booking-button d-inline-block me-4">
                                    <select
                                        type="text"
                                        v-model="deliveryType"
                                        class="form-control"
                                    >
                                        <!---->
                                        <option
                                            selected="selected"
                                            disabled="disabled"
                                        >
                                            Select Delivery or Pickup
                                        </option>
                                        <option value="delivery">Delivery</option>
                                        <option value="pickup">Pickup</option>
                                    </select>
                                </div>
                                <div class="select-city d-inline-block">
                                    <div class="custom-form">
                                        <select
                                            type="text"
                                            v-model="deliveryTypeLocation"
                                            class="form-control"
                                            v-if="deliveryType == 'delivery'"
                                            @change="handleLocationSelection"
                                        >
                                            <option value="">Select City</option>
                                            <option
                                                :value="city.id"
                                                v-for="city in props.cities"
                                                :key="city.id"
                                            >
                                                {{ city.city }}
                                            </option>
                                        </select>
                                        <select
                                            type="text"
                                            v-model="deliveryTypeLocation"
                                            class="form-control"
                                            @change="handleLocationSelection"
                                            v-else
                                        >
                                            <option value="Midhas">Midhas</option>
                                        </select>
    
                                        <div class="select-icon-container">
                                            <i
                                                class="select-icon rango-arrow-down"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 text-end">
                                <button
                                    type="submit"
                                    name="action"
                                    class="book-time btn btn-success m-2"
                                    @click="previousDays"
                                >
                                    <i class="material-icons left"></i>
                                    <span>Previous</span>
                                </button>
                                <button
                                    @click="nextDays"
                                    type="submit"
                                    name="action"
                                    class="book-time btn btn-primary"
                                >
                                    <span>Next</span> <i class="material-icons"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="position-relative book-table">
                <div id="pills-tabContent" class="tab-content p-0">
                    <div
                        class="tab-pane fade active show"
                        style=""
                        id="pills-home"
                        role="tabpanel"
                        aria-labelledby="pills-home-tab"
                    >
                        <div class="table-responsive slots">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Time \ Days</th>
    
                                        <th
                                            v-for="day in records.days"
                                            :key="day"
                                            scope="col"
                                        >
                                            {{ day.formatDate }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template
                                        :key="slot"
                                        v-for="slot in records.slots"
                                    >
                                        <tr class="tr-divide">
                                            <td
                                                class=""
                                                :colspan="records.days.length + 1"
                                            >
                                                <b>{{ slot.type }}</b>
                                            </td>
                                        </tr>
    
                                        <tr
                                            v-for="st in slot.slots"
                                            :key="slot + st.startTime"
                                        >
                                            <th scope="row" class="time-slots">
                                                {{
                                                    st.startTime +
                                                    " - " +
                                                    st.endTime
                                                }}
                                            </th>
    
                                            <td
                                                class="pointer"
                                                :key="st.startTime + index"
                                                v-for="(price, index) in st.price"
                                                @click="handleSlot(st, price)"
                                            >
                                                <template
                                                    v-if="price.amount != null"
                                                >
                                                    ${{ price.amount }}
                                                </template>
                                                <template v-else> - </template>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <modal :show="isShow" @show="isShow = true" @hide="isShow = false">
        <div class="card crt-time-modal">
            <div class="card-body">
                <div class="text-center">
                    <h3>You have reserved a slot</h3>
                    <h1 class="pt-4"><i class='bx bxs-shopping-bag'></i></h1>
                    <p class="deliveryType">{{ toUpper(deliveryType) }}</p>
                    <p><small>Slot reserved for</small></p>
                    <p class="slot-time">
                        {{ formateDate }} {{ toUpper(selectedTime) }}
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-danger mr-2" @click="isShow = false"
                        >Change Date Time</a
                    >
                    <a
                        class="btn btn-success"
                        :class="{
                            disabled: selectedPrice == null,
                        }"
                        href="https://www.furniturestore.to/staging/public/checkout"
                        >Checkout</a
                    >
                </div>
            </div>
        </div>
    </modal>
</template>

<script setup>
import { ref, watch } from "vue";
import { onMounted } from "vue";
import moment from "moment";
import Modal from "./Modal.vue";
import axios from "axios";

const startDate = ref(moment().format("YYYY-MM-DD"));
const endDate = ref(moment().add(7, "days").format("YYYY-MM-DD"));

const props = defineProps(["cities", "cart"]);

const selectedDate = ref(null);
const formateDate = ref(null);

const selectedTime = ref(null);
const minimumPriceForDelivery = ref(null);
const selectedPrice = ref(0);

const deliveryType = ref("pickup");
const deliveryTypeLocation = ref("Midhas");

const isShow = ref(false);

const records = ref({
    days: [],
    slots: [],
});

onMounted(() => {
    generateDays();
});

watch(
    () => deliveryType.value,
    () => {
        selectedPrice.value = null;
        if (deliveryType.value == "pickup") {
            deliveryTypeLocation.value = "Midhas";
            selectedPrice.value = 0;
        } else {
            deliveryTypeLocation.value = "";
            selectedPrice.value = null;
        }
        generateDays();
    }
);

const handleLocationSelection = () => {
    if (deliveryType.value == "pickup") {
        selectedPrice.value = 0;
        minimumPriceForDelivery.value = null;
    } else {
        let index = props.cities.findIndex(
            (itm) => itm.id == deliveryTypeLocation.value
        );
        let item = props.cities[index];

        if (item) {
            selectedPrice.value = item.delivery_price;
            minimumPriceForDelivery.value = item.min_amt_for_shipping;
        } else {
            selectedPrice.value = null;
        }
    }
    generateDays();
};

const handleSlot = (st, price) => {
    if (price.amount != null) {
        selectedDate.value = price.date.actualDate;
        formateDate.value = price.date.formatDate;
        selectedTime.value = st.startTime + " - " + st.endTime;
        selectedPrice.value = price.amount;
        isShow.value = true;

        axios
            .post("https://www.furniturestore.to/staging/public/update-delivery-locations", {
                type: deliveryType.value,
                city: deliveryTypeLocation.value,
                date: selectedDate.value,
                time: selectedTime.value,
                price: selectedPrice.value,
                min_price: minimumPriceForDelivery.value,
            })
            .then((res) => {
                console.log("response", res.data);
            })
            .catch((e) => {
                console.log("error", e);
            });
    } else {
        alert("Please select the delivery city");
        return false;
    }
};

const toUpper = (string) => {
    return string?.toUpperCase();
};

const nextDays = () => {
    startDate.value = moment(endDate.value).format("YYYY-MM-DD");
    endDate.value = moment(startDate.value).add(7, "days").format("YYYY-MM-DD");
    generateDays();
};

const previousDays = () => {
    if (startDate.value == moment().format("YYYY-MM-DD")) {
        return;
    }

    startDate.value = moment(startDate.value)
        .subtract(7, "days")
        .format("YYYY-MM-DD");

    endDate.value = moment(startDate.value).add(7, "days").format("YYYY-MM-DD");
    generateDays();
};

const generateDays = () => {
    records.value = {
        days: [],
        slots: [],
    };
    for (
        var m = moment(startDate.value);
        m.isBefore(endDate.value);
        m.add(1, "days")
    ) {
        records.value.days.push({
            actualDate: m.format("YYYY-MM-DD"),
            formatDate: m.format("ddd | MMM DD"),
        });
    }

    getSlots("Afternoon", "12:00 Pm", "04:00 Pm");
    getSlots("Evening", "5:00 Pm", "08:00 Pm");
};

const getSlots = (type, stTime, endTime) => {
    let inTime = stTime;
    let outTime = endTime;

    var start = moment(inTime, "hh:mm a");
    var end = moment(outTime, "hh:mm a");

    start.minutes(Math.ceil(start.minutes() / 60) * 60);

    var current = moment(start);

    if (
        !records.value.slots[type] ||
        records.value.slots[type].findIndex((it == it.type) == type) < 0
    ) {
        records.value.slots.push({
            type: type,
            slots: [],
        });
    }

    let index = records.value.slots.findIndex((it) => it.type == type);

    while (current <= end) {
        if (
            records.value.slots[index].slots.findIndex(
                (it) => it.startTime == current.format("hh:mm a")
            ) > -1
        ) {
            return null;
        } else {
            let startTimeSlot = current.format("hh:mm a");
            let endTimeSlot = moment(startTimeSlot, "hh:mm a")
                .add(60, "minutes")
                .format("hh:mm a");

            records.value.slots[index].slots.push({
                startTime: startTimeSlot,
                endTime: endTimeSlot,
                price: getPrices(),
            });
            current.add(60, "minutes");
        }
    }
};

const getPrices = () => {
    let prices = [];

    //check for minimum price
    if (deliveryType.value == "delivery") {
        if (
            minimumPriceForDelivery.value &&
            props.cart >= minimumPriceForDelivery.value
        ) {
            selectedPrice.value = 0;
        }
    }

    console.log(selectedPrice.value);

    records.value.days.map((item) => {
        prices.push({
            amount: selectedPrice.value,
            date: item,
        });
    });

    return prices;
};
</script>

<style scoped>
.pointer {
    cursor: pointer;
}

.pointer:hover {
    background-color: #cccc;
}

.deliveryType {
    font-size: 22px;
    font-weight: 600;
    margin: 5px;
}

.slot-time {
    font-size: 14px;
    font-weight: 500;
}
th{
    white-space: nowrap;
     background-color: #f58b33;
     color: white;
}

@media screen and (max-width: 768px) {
    h3{
        font-size: 18px;
    }
    .deliveryType {
    font-size: 18px
}
}
.book-time{
    background-color: #f58b33;
    border-radius: 18px;
    border: 1px solid #f58b33;
}
.tr-divide{
    background-color: rgba(0, 0, 0, 0.125);
}
</style>

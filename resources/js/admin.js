import { createApp, defineComponent } from "vue";
import PromoPrice from "./admin/products/PromoPrice.vue";
import ProductStock from "./admin/products/Stock.vue";
import ImageUploader from "./admin/ImageUploader.vue";
import Variant from "./admin/products/Variant.vue";
import MultipleItem from "./admin/MultipleItem.vue";
import Filter from "./admin/Filter.vue";
import Finance from "./admin/products/Finance.vue";

const root = defineComponent({});

const multipleApps = ["one", "two", "manuals", "variants", "financing"];

multipleApps.map((item) => {
    let appName = item;
    appName = createApp(root);
    appName.component("promo-price", PromoPrice);
    appName.component("product-stock", ProductStock);
    appName.component("multiple-item", MultipleItem);
    appName.component("product-variant", Variant);
    appName.component("image-uploader", ImageUploader);
    appName.component("filter-section", Filter);
    appName.component("finance-section", Finance);
    appName.mount(`#admin-app-${item}`);
});

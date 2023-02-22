import $bus from "./lib/Vue3EventBus";
import SeoSettingElement from "./SeoSettingElement.vue";
import SeoDataModal from "./SeoDataModal.vue";
import SeoModalButton from "./SeoModalButton.vue";

const seoSettingsPlugin = {
    install(app, options) {
        app.provide("bus", $bus);

        app.component('SeoSettingElement', SeoSettingElement);
        app.component('SeoDataModal', SeoDataModal);
        app.component('SeoModalButton', SeoModalButton);
    },
};

export default seoSettingsPlugin;

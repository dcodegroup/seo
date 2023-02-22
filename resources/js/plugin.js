import $bus from "./lib/Vue3EventBus";
import SeoSettingElement from "./SeoSettingElement.vue";

const seoSettingsPlugin = {
    install(app, options) {
        app.provide("bus", $bus);

        app.component('SeoSettingElement', SeoSettingElement);
    },
};

export default seoSettingsPlugin;

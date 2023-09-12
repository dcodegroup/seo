<template>
  <div class="seo-module seo-settings">
    <button type="button" class="seo-btn seo-btn-secondary" v-if="setting" @click="open = !open">
      <span v-html="'<'"></span>
      {{ setting.tag ? setting.tag : 'ADD TAG' }}
      <span v-for="attribute in attributes">
        {{ attribute.key }}="{{ attribute.value }}"
      </span>
      <span v-html="'>'"></span>
    </button>
    <div class="seo-settings-wrapper" v-if="open">
      <div class="seo-module-input-wrapper">
        <label for="tag" class="seo-module-label">Tag (meta, link, etc):</label>
        <input class="seo-module-input" type="text" v-model="setting.tag" name="tag" id="tag">
      </div>
      <div class="seo-module-input-wrapper">
        <label for="tag" class="seo-module-label">Group:</label>
        <input class="seo-module-input" type="text" v-model="setting.group" name="group" id="group">
      </div>
      <div class="">
				<button @click="addAttribute" class="seo-btn seo-btn-primary" type="button">Add attribute</button>
        <div v-if="attributes.length > 0" class="seo-module-input-wrapper attributes">
          <label for="attributes" class="seo-module-label">Attributes:</label>
          <div class="seo-module-input-wrapper-flex" v-for="(attribute, index) in attributes">
            <input class="seo-module-input" type="text" :name="'attributes['+index+'][key]'" v-model="attribute.key">
            <input class="seo-module-input" type="text" :name="'attributes['+index+'][value]'" v-model="attribute.value">
            <button type="button" class="seo-btn seo-btn-secondary" @click="attributes.splice(index, 1)">Remove</button>
          </div>
          <div v-if="setting.tag === 'script'">
            <label for="value" class="seo-module-label">Script body:</label>
            <textarea class="seo-module-input" name="value" id="value" cols="30" rows="10" v-model="setting.value"></textarea>
          </div>
        </div>
      </div>
      <div v-if="inlineEdit">
        <button type="button" class="seo-btn seo-btn-primary" @click="update">Update</button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  props: {
    inlineEdit: {
      type: Boolean,
      default: false
    },
    defaultSetting: {
      type: Object,
      default: {}
    },
    updateEndpoint: {
      type: String,
      default: '',
    }
  },
  data() {
    return {
      setting: this.defaultSetting ? this.defaultSetting : {},
      attributes: this.defaultSetting.attributes ? this.defaultSetting.attributes : [],
      open: false,
    }
  },
  methods: {
    addAttribute() {
      this.attributes.push({
        key: '',
        value: '',
      });
    },
    async update() {
      try {
        const response = await axios.put(this.updateEndpoint, this.setting)

        this.open = false;
      } catch (e) {
        console.error(e);
      }
    }
  }
}
</script>
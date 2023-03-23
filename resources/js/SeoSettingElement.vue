<template>
  <div class="my-4">
    <div class="cursor-pointer" v-if="setting" @click="open = !open">
      <span v-html="'<'"></span>
      {{ setting.tag ? setting.tag : 'ADD TAG' }}
      <span v-for="attribute in attributes">
        {{ attribute.key }}="{{ attribute.value }}"
      </span>
      <span v-html="'>'"></span>
    </div>
    <div class="w-1/3" v-if="open">
      <div class="my-4">
        <label for="tag">Tag (meta, link, etc):</label>
        <input class="w-full my-2" type="text" v-model="setting.tag" name="tag" id="tag">
      </div>
      <div class="my-4">
        <label for="tag">Group:</label>
        <input class="w-full my-2" type="text" v-model="setting.group" name="group" id="group">
      </div>
      <div class="my-8">
        <div class="my-4">
          <button @click="addAttribute" class="btn btn-primary" type="button">Add attribute</button>
        </div>
        <div class="attributes">
          <label for="attributes">Attributes:</label>
          <div class="flex my-2" v-for="(attribute, index) in attributes">
            <input class="w-1/3 mx-2" type="text" :name="'attributes['+index+'][key]'" v-model="attribute.key">
            <input class="w-1/3 mx-2" type="text" :name="'attributes['+index+'][value]'" v-model="attribute.value">
            <button type="button" @click="attributes.splice(index, 1)">Remove</button>
          </div>
          <div v-if="setting.tag === 'script'">
            <label for="value">Script body:</label>
            <textarea class="w-full" name="value" id="value" cols="30" rows="10" v-model="setting.value"></textarea>
          </div>
        </div>
      </div>
      <div class="form-row" v-if="inlineEdit">
        <button type="button" class="btn btn-primary" @click="update">Update</button>
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
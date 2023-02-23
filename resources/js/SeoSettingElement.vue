<template>
  <div>
    <div v-if="setting" @click="open = !open">
      <span v-html="'<'"></span>
      {{ setting.tag }}
      <span v-for="attribute in attributes">
        {{ attribute.key }}="{{ attribute.value }}"
      </span>
      <span v-html="'>'"></span>
    </div>
    <div class="editor" v-if="open">
      <div class="form-row">
        <label for="tag">Tag (meta, link, etc):</label>
        <input type="text" v-model="setting.tag" name="tag" id="tag">
      </div>
      <div class="form-row">
        <label for="tag">Group:</label>
        <input type="text" v-model="setting.group" name="group" id="group">
      </div>
      <div class="form-row">
        <button @click="addAttribute" class="btn btn-primary" type="button">Add attribute</button><br>
        <label for="attributes">Attributes:</label>
        <div class="attribute" v-for="(attribute, index) in attributes">
          <input type="text" :name="'attributes['+index+'][key]'" v-model="attribute.key">
          <input type="text" :name="'attributes['+index+'][value]'" v-model="attribute.value">
          <button type="button" @click="attributes.splice(index, 1)">Remove</button>
        </div>
        <div v-if="setting.tag === 'script'">
          <label for="value">Script body:</label>
          <textarea name="value" id="value" cols="30" rows="10" v-model="setting.value"></textarea>
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
      setting: this.defaultSetting ?? {},
      attributes: this.defaultSetting.attributes ?? [],
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
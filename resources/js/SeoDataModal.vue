<template>
  <div v-if="open">
    <div class="form-row">
      <label for="title">Title</label>
      <input type="text" v-model="model.title" id="title">
    </div>
    <div class="form-row">
      <label for="description">Description</label>
      <textarea v-model="model.description" id="description" rows="5"></textarea>
    </div>
    <div class="form-row">
      <label for="keywords">Keywords</label>
      <textarea v-model="model.keywords" id="keywords" rows="2"></textarea>
    </div>
    <div class="form-row">
      <label for="image">Image URL</label>
      <input type="text" v-model="model.image" id="image">
    </div>
    <div class="form-row">
      <label for="author">Author</label>
      <input type="text" v-model="model.author" id="author">
    </div>
    <div class="form-row">
      <label for="copyright">Copyright</label>
      <input type="text" v-model="model.copyright" id="copyright">
    </div>
    <div class="form-row">
      <label for="date">Date</label>
      <input type="text" v-model="model.date" id="date">
    </div>
    <div class="form-row">
      <label for="region">Region</label>
      <input type="text" v-model="model.region" id="region">
    </div>
    <div class="form-row">
      <label for="url">URL</label>
      <input type="text" v-model="model.url" id="url">
    </div>
    <div class="form-row">
      <label for="markup">Markup</label>
      <textarea v-model="model.markup" id="markup" rows="5"></textarea>
    </div>
    <button type="button" @click="open = false">
      Close
    </button>
    <button class="btn btn-primary" type="button" @click="save">
      Save
    </button>
  </div>
</template>
<script>
import axios from "axios";

export default {
  inject: ["bus"],
  created() {
    this.bus.$on('openSeoModal', (data) => {
      this.open = true;
      this.modelClass = data.modelClass;
      this.modelId = data.modelId;

      this.getModel();
    })
  },
  data() {
    return {
      model: {},
      open: false,
      modelClass: null,
      modelId: null,
    }
  },
  methods: {
    async getModel()
    {
      try {
        const response = await axios.get('/seo-data/'+this.modelClass+'/'+this.modelId);

        this.model = response.data.model;
      } catch (e) {
        console.error(e);
      }
    },
    async save()
    {
      try {
        const response = await axios.post('/seo-data/'+this.modelClass+'/'+this.modelId, this.model)

        this.open = false;
      } catch (e) {
        console.error(e);
      }
    }
  }
}
</script>
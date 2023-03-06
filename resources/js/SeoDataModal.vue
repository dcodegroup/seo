<template>
  <div v-if="open">
    <div class="fixed top-0 left-0 h-full w-full flex content-center justify-center bg-neutral-300/50">
      <div class="w-1/2 overflow-y-auto bg-white max-h-96 self-center rounded relative">
        <div class="p-8">
          <h3 class="my-4">
            SEO
          </h3>
          <div class="flex flex-wrap my-4">
            <label for="title" class="w-full my-2">Title</label>
            <input type="text" v-model="model.title" id="title" class="w-full rounded">
          </div>
          <div class="flex flex-wrap my-4">
            <label for="description" class="w-full my-2">Description</label>
            <textarea v-model="model.description" id="description" rows="5" class="w-full rounded"></textarea>
          </div>
          <div class="flex flex-wrap my-4">
            <label for="keywords" class="w-full my-2">Keywords</label>
            <textarea v-model="model.keywords" id="keywords" rows="2" class="w-full rounded"></textarea>
          </div>
          <div class="flex flex-wrap my-4">
            <label for="image" class="w-full my-2">Image URL</label>
            <input type="text" v-model="model.image" id="image" class="w-full rounded">
          </div>
          <div class="flex flex-wrap my-4">
            <label for="author" class="w-full my-2">Author</label>
            <input type="text" v-model="model.author" id="author" class="w-full rounded">
          </div>
          <div class="flex flex-wrap my-4">
            <label for="copyright" class="w-full my-2">Copyright</label>
            <input type="text" v-model="model.copyright" id="copyright" class="w-full rounded">
          </div>
          <div class="flex flex-wrap my-4">
            <label for="date" class="w-full my-2">Date</label>
            <input type="text" v-model="model.date" id="date" class="w-full rounded">
          </div>
          <div class="flex flex-wrap my-4">
            <label for="region" class="w-full my-2">Region</label>
            <input type="text" v-model="model.region" id="region" class="w-full rounded">
          </div>
          <div class="flex flex-wrap my-4">
            <label for="url" class="w-full my-2">URL</label>
            <input type="text" v-model="model.url" id="url" class="w-full rounded">
          </div>
          <div class="flex flex-wrap my-4">
            <label for="markup" class="w-full my-2">Markup</label>
            <textarea v-model="model.markup" id="markup" rows="5" class="w-full rounded"></textarea>
          </div>
        </div>
        <div class="flex justify-between sticky bottom-0 left-0 w-full bg-white p-8">
          <button type="button" @click="open = false">
            Close
          </button>
          <button class="btn btn-primary" type="button" @click="save">
            Save
          </button>
        </div>
      </div>
    </div>
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
        let url = new URL(window.location.origin+'/admin/seo-data');
        url.searchParams.append('modelClass', this.modelClass);
        url.searchParams.append('modelId', this.modelId);
        const response = await axios.get(url);

        if (response.data.model) {
          this.model = response.data.model;
        }
      } catch (e) {
        console.error(e);
      }
    },
    async save()
    {
      let url = new URL(window.location.origin+'/admin/seo-data');
      url.searchParams.append('modelClass', this.modelClass);
      url.searchParams.append('modelId', this.modelId);

      try {
        const response = await axios.post(url, this.model)

        // this.open = false;
      } catch (e) {
        console.error(e);
      }
    }
  }
}
</script>
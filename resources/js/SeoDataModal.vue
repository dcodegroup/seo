<template>
  <div v-if="open" class="seo-module seo-modal">
    <div class="seo-modal-wrapper">
			<div class="seo-modal-content">

				<header class="seo-modal-header">
					<h3>SEO</h3>
				</header>
	
				<div class="seo-modal-body">
					<div class="seo-module-input-wrapper">
						<label for="title" class="seo-module-label">Title</label>
						<input type="text" v-model="model.title" id="title" class="seo-module-input">
					</div>
					<div class="seo-module-input-wrapper">
						<label for="description" class="seo-module-label">Description</label>
						<textarea v-model="model.description" id="description" rows="5" class="seo-module-input"></textarea>
					</div>
					<div class="seo-module-input-wrapper">
						<label for="keywords" class="seo-module-label">Keywords</label>
						<textarea v-model="model.keywords" id="keywords" rows="2" class="seo-module-input"></textarea>
					</div>
					<div class="seo-module-input-wrapper">
						<label for="image" class="seo-module-label">Image URL</label>
						<input type="text" v-model="model.image" id="image" class="seo-module-input">
					</div>
					<div class="seo-module-input-wrapper">
						<label for="author" class="seo-module-label">Author</label>
						<input type="text" v-model="model.author" id="author" class="seo-module-input">
					</div>
					<div class="seo-module-input-wrapper">
						<label for="copyright" class="seo-module-label">Copyright</label>
						<input type="text" v-model="model.copyright" id="copyright" class="seo-module-input">
					</div>
					<div class="seo-module-input-wrapper">
						<label for="date" class="seo-module-label">Date</label>
						<input type="text" v-model="model.date" id="date" class="seo-module-input">
					</div>
					<div class="seo-module-input-wrapper">
						<label for="region" class="seo-module-label">Region</label>
						<input type="text" v-model="model.region" id="region" class="seo-module-input">
					</div>
					<div class="seo-module-input-wrapper">
						<label for="url" class="seo-module-label">URL</label>
						<input type="text" v-model="model.url" id="url" class="seo-module-input">
					</div>
					<div class="seo-module-input-wrapper">
						<label for="markup" class="seo-module-label">Markup</label>
						<textarea v-model="model.markup" id="markup" rows="5" class="seo-module-input"></textarea>
					</div>
				</div>
	
				<footer class="seo-modal-footer">
					<button type="button" class="seo-btn seo-btn-secondary" @click="open = false">
						Close
					</button>
					<button class="seo-btn seo-btn-primary" type="button" @click="save">
						Save
					</button>
				</footer>
				
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
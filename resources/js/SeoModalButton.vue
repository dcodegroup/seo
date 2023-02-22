<template>
  <div>
    <button :class="style" type="button" @click="openModal">SEO</button>
  </div>
</template>
<script>
export default {
  inject: ["bus"],
  props: {
    style: {
      required: false,
      type: String
    },
    modelClass: {
      required: true,
      type: String
    },
    modelId: {
      required: true,
      type: Number
    }
  },
  methods: {
    openModal(){
      this.bus.$emit('openSeoModal', {
        modelClass: this.modelClass,
        modelId: this.modelId
      })
    }
  },
}
</script>
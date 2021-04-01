<template>
  <div>
    <v-btn
        color="deep-purple accent-4"
        class="white--text"
        @click="overlay = true"
    >
      Launch Application
      <v-icon right>
        mdi-open-in-new
      </v-icon>
    </v-btn>


  </div>
</template>

<script>
export default {
  name: "codigo",
  data: () => ({
    overlay: false,
  }),

  /*watch: {
    overlay (val) {
      val && setTimeout(() => {
        this.overlay = false
      }, 3000)
    },
  },*/
}
</script>

<style scoped>

</style>
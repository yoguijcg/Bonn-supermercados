<template>
  <div>
    <v-app id="inspire">
      <router-view></router-view>
    </v-app>
  </div>
</template>

<script>

export default {
  name: 'App',

  components: {

  },

  data: () => ({
    //
  }),
};
</script>
<style>
::-webkit-scrollbar {
  width: 5px;
}
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px yellow;
  border-radius: 10px;
}
::-webkit-scrollbar-thumb {
  background: #9bc220;
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
  background: #dedc03;
}
</style>
<template>
  <div id="app">
    <div class="row">
      <text-for-send class="col m6 s12" ref="text-for-send"></text-for-send>
      <list-mails class="col m6 s12" ref="list-mails"></list-mails>
    </div>
  </div>
</template>

<script>
  import listMails from './components/listMails'
  import textForSend from './components/textForSend'
  import menuMain from './components/menuMain'

  export default {
    name: 'app',
    components: {
      listMails,
      textForSend,
      menuMain
    },
    mounted() {
      console.log('loading app')
    }
  }
</script>

<style>
  #app {}
</style>
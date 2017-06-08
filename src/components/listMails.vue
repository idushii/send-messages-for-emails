<template>
  <div class="root">
    <ul class="collection with-header">
      <li class="collection-header"><h5>Список email`ов <a class="waves-effect waves-light btn right btn-add-mails" @click="openModalForList"><i class="material-icons">add</i></a></h5></li>
      <li class="collection-item" v-for="mail in listMails">
        <i class="material-icons left btn-select" @click="select(mail)">{{mail.select ? 'turned_in' : 'turned_in_not' }}</i>
        {{mail.text}}
        <i class="material-icons right">{{mail.done ? 'done' : '' }}</i>
      </li>
      <li class="collection-item" v-if="!listMails.length">Список пустой</li>
    </ul>
    <!-- MODAL -->
    <div id="modal1" class="modal">
      <div class="modal-content">
        <h5>Введите список email`ов.</h5>
        <div class="input-field">
          <textarea id="textIsMails" class="materialize-textarea" placeholder="mail@mail.com" cols="10"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat" @click="moveEmails">Ок</a>
      </div>
    </div>
    <!-- //MODAL -->
  </div>
</template>

<script>
  export default {
    name: 'list-mails',
    data() {
      return {
        listMails: []
      }
    },
    mounted() {
      let mails = localStorage.getItem('list-mails');
      this.listMails = mails ? JSON.parse(mails) : [];
    },
    methods: {
      openModalForList() {
        $('.modal').modal();
        $('#modal1').modal('open');
        textIsMails.value = this.listMails.map(mail => mail.text).join('\n');
      },
      moveEmails() {
        this.listMails = textIsMails.value ? textIsMails.value.replace(new RegExp(' ', 'g'), '').split('\n').filter(line => line.length).join(',').split(',').map(mail => {
          return {
            text: mail,
            done: false,
            select: true
          }
        }) : []
        localStorage.setItem('list-mails', JSON.stringify(this.listMails));
      },
      select(mail) {
        mail.select = !mail.select;
        localStorage.setItem('list-mails', JSON.stringify(this.listMails));
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .btn-add-mails {
    height: 25px;
    padding: 0px 10px;
  }
  
  .btn-add-mails i {
    top: -5px;
    position: relative;
  }
  
  .btn-select {
    cursor: pointer;
  }
  
  .root {
    margin-top: 20px;
  }
</style>
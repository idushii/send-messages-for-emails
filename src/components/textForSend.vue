<template>
  <div class="root">
    <div class="card">
      <div class="card-content">
        <div class="card-title">Текст сообщения</div>
        <input type="text" class="" id="Title" placeholder="Заголовок" @keyup="changeText" :disabled="isSending" />
        <input type="text" class="" id="From" placeholder="С какого email" @keyup="changeText" :disabled="isSending" />
        <textarea id="TextMes" class="materialize-textarea" placeholder="Здравствуйте." @keyup="changeText" :disabled="isSending"></textarea>
        <div id="conteiner-button">
          <a class="btn waves-effect waves-light right" @click="send" :disabled="isSending">Начать рассылку</a>          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'list-mails',
    data() {
      return {
        isSending: false
      }
    },
    computed: {
      listMails() {
        return this.$parent.$refs["list-mails"].listMails;
      },
      listSelectMails() {
        return this.$parent.$refs["list-mails"].listMails.filter(mail => mail.select);
      }
    },
    mounted() {
      Title.value = localStorage.getItem('Title')
      From.value = localStorage.getItem('From')
      TextMes.value = localStorage.getItem('Text')
      console.log('loading text for send')
    },
    methods: {
      changeText() {
        localStorage.setItem('Title', Title.value)
        localStorage.setItem('From', From.value)
        localStorage.setItem('Text', TextMes.value)
      },
      send(e, num = 0) {
        this.isSending = true;
        if (num >= this.listMails.length) {
          this.isSending = false;
          return;
        }

        if (!this.listMails[num].select) {
          this.send(null, num + 1);
          return;
        }

        fetch(`http://vando.company/contacts-organization/send.php?Title=${Title.value}&From=${From.value}&Text=${TextMes.value}&Email=${this.listMails[num].text}`)
          .then(res => res.text())
          .then(text => {
            if (text == 1) {
              this.listMails[num].done = true;
              setTimeout(() => {
                this.send(null, num + 1);
              }, 1000)
            } else {
              return Promise.reject(`Сообщение на почту ${this.listMails[num].text} не отправлено.`)
            }
          })
          .catch(err => {
            if (num = this.listMails.length) {
              this.isSending = false;
            }
            Materialize.toast(err, 10000)
          })

      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .root {
    margin-top: 20px;
  }
  
  #conteiner-button {
    min-height: 35px;
  }
</style>
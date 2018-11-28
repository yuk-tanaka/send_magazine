<template>
  <div class="send-magazine">
    <el-card class="box-card">
      <h1>メールマガジン送信</h1>
      <ul>
        <li>メールアドレス、送信先名が記載されたCSVファイルを利用してメールマガジンを送信します。</li>
        <li>送信日時が過去日付の場合は即時にメールが送信されます。</li>
      </ul>
      <ImportCSV></ImportCSV>
      <SendMagazineForm></SendMagazineForm>
    </el-card>
  </div>
</template>

<style scoped>
  .box-card {

  }
</style>

<script>
  import ImportCSV from '../components/ImportCSV'
  import SendMagazineForm from '../components/SendMagazineForm'

  export default {
    name: 'SendMagazine',
    components: {
      ImportCSV,
      SendMagazineForm,
    },
    data() {
      return {};
    },
  }
</script>
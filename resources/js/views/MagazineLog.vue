<template>
  <div class="magazine-log">
    <el-card class="box-card">
      <h1>送信履歴</h1>
      <ul>
        <li>カラムをクリックすることでソートを行います。</li>
        <li>行をクリックすることで詳細内容を表示します。</li>
      </ul>
      <MagazineLogTable></MagazineLogTable>
    </el-card>
  </div>
</template>

<style scoped>
  .box-card {

  }
</style>

<script>
  import MagazineLogTable from '../components/MagazineLogTable'

  export default {
    name: 'MagazineLog',
    components: {
      MagazineLogTable,
    },
    data() {
      return {};
    },
  }
</script>
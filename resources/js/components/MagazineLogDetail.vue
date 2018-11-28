<template>
  <div>
    <el-dialog :visible.sync="dialogTableVisible" title="送信履歴詳細" top="5vh" width="95%">
      <dl>
        <dt>ID</dt>
        <dd>{{data.id}}</dd>
        <dt>送信日時</dt>
        <dd>{{data.send_at}}</dd>
        <dt>送信数</dt>
        <dd>{{data.count}}</dd>
        <dt>タイトル</dt>
        <dd>{{data.titleFull}}</dd>
        <dt>内容</dt>
        <dd><span v-html="data.descriptionFull"></span></dd>
        <dt>フッター</dt>
        <dd><span v-html="data.footerFull"></span></dd>
      </dl>
    </el-dialog>
  </div>
</template>

<script>
  export default {
    name: 'MagazineLogDetail',
    props: {
      dialogTableVisible: {type: Boolean, required: true},
      data: {type: Object, required: true},
    },
  }
</script>
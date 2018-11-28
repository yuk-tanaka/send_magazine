<template>
  <div>
    <el-button
        type="text"
        @click="dialogTableVisible = true">
      取り込むCSVのルールはこちらをクリックして確認してください。
    </el-button>
    <el-dialog
        :visible.sync="dialogTableVisible"
        title="取り込むCSVのルール"
        @open="fetchData">
      <template v-if="data">
        <dl>
          <dt>送信可否判定を行う</dt>
          <dd>{{isValidate ? 'はい' : 'いいえ'}}</dd>
          <template v-if="isValidate">
            <dt>送信可否判定を行うカラム番号</dt>
            <dd>{{data.isSendColumnNumber}}</dd>
            <dt>送信可能とするカラム文字列</dt>
            <dd>{{data.isSendValidateString}}</dd>
          </template>
          <dt>送信先氏名カラム番号</dt>
          <dd>{{data.nameColumnNumber}}</dd>
          <dt>送信先メールアドレスカラム番号</dt>
          <dd>{{data.emailColumnNumber}}</dd>
        </dl>
      </template>
      <template v-else>
        <p>データの取得に失敗しました。</p>
      </template>
    </el-dialog>
  </div>
</template>

<script>
  export default {
    name: 'CSVRule',
    data() {
      return {
        dialogTableVisible: false,
        loading: false,
        data: null,
      }
    },
    computed: {
      isValidate() {
        if (!this.data) {
          return false;
        }
        return this.data.isValidate !== null;
      },
    },
    methods: {
      /**
       *
       */
      fetchData() {
        this.loading = true;
        axios.get('./webApi/rule')
          .then(response => {
            this.data = response.data;
            this.loading = false;
          })
          .catch(error => {
            console.log(error);
            this.$message.error('データ取得に失敗しました。エラーメッセージはWebコンソールを参照してください。');
            this.loading = false;
          });
      }
    },
  }
</script>
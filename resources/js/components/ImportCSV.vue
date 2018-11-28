<template>
  <div class="import-csv">
    <el-upload
        :before-upload="validate"
        :limit="1"
        :on-error="error"
        :on-exceed="exceed"
        :on-success="success"
        action="./webApi/import">
      <el-button
          icon="el-icon-upload"
          size="small"
          type="success">
        CSVアップロード
      </el-button>
      <div slot="tip" class="el-upload__tip">
        <span v-if="$store.getters.sendsCount">送信対象は<strong>{{$store.getters.sendsCount}}</strong>件です。</span>
        <span v-else><CSVRule></CSVRule></span>
      </div>
    </el-upload>
  </div>
</template>

<style scoped>
  .import-csv {
    margin-top: 1em;
    margin-bottom: 1em
  }
</style>

<script>
  import CSVRule from '../components/CSVRule'

  export default {
    name: 'ImportCSV',
    components: {
      CSVRule,
    },
    methods: {
      /**
       * @param file
       * @returns {boolean}
       */
      validate(file) {
        //excelで作ったシートも許可する
        const isCSV = file.type === 'text/csv' || 'application/vnd.ms-excel';

        if (!isCSV) {
          this.$message.error('選択されたファイルはCSVファイルではありません。MIME:' + file.type);
        }

        return isCSV;
      },
      exceed() {
        this.$message.error('すでにファイルがアップロードされています。');
      },
      /**
       * @param err
       */
      error(err) {
        console.log(err);
        this.$message.error('アップロードに失敗しました。エラーメッセージはWebコンソールを参照してください。');
      },
      /**
       * @param response
       */
      success(response) {
        this.$store.commit('sends', response);

        this.$message.success('CSVをアップロードしました。');
      },
    }
  }
</script>
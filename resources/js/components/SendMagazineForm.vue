<template>
  <el-form
      :model="values"
      :rules="rules"
      label-width="120px"
      ref="form"
      v-loading="loading">
    <el-form-item label="送信日時" prop="send_at">
      <el-date-picker
          :picker-options="pickerOptions"
          v-model="values.send_at"
          format="yyyy-MM-dd HH:mm"
          type="datetime"
          value-format="yyyy-MM-dd HH:mm:ss">
      </el-date-picker>
    </el-form-item>

    <el-form-item label="件名" prop="title">
      <el-input v-model="values.title"></el-input>
    </el-form-item>

    <el-form-item label="本文" prop="description">
      <wysiwyg v-model="values.description"></wysiwyg>
    </el-form-item>

    <el-form-item label="フッター" prop="footer">
      <wysiwyg v-model="values.footer"></wysiwyg>
    </el-form-item>
    <template v-if="canClickButton">
      <el-button
          icon="el-icon-message"
          type="primary"
          @click="submit">
        メール送信
      </el-button>
    </template>
    <template v-else>
      <el-tooltip
          class="item"
          content="送信対象が存在しません。正しいCSVファイルをアップロードしてください。"
          effect="dark"
          placement="top">
        <span class="wrapper el-button">
          <el-button
              icon="el-icon-message"
              type="primary"
              disabled>
            メール送信
          </el-button>
        </span>
      </el-tooltip>
    </template>
  </el-form>
</template>

<style scoped>
  /** disabled buttonにtooltipを反応させるために必要なspan **/
  .wrapper.el-button {
    display: inline-block;
    padding: 0;
    margin: 0;
    border: none;
  }
</style>

<script>
  export default {
    name: 'SendMagazineForm',
    data() {
      return {
        loading: false,
        values: {
          send_at: this.$moment().add(1, 'hours').format('YYYY-MM-DD HH:mm:ss'),
          title: '',
          description: '',
          footer: '',
        },
        pickerOptions: {
          disabledDate(time) {
            return time.getTime() < Date.now();
          },
        },
        rules: {
          send_at: [
            {required: true, message: '入力必須です。', trigger: 'blur'},
          ],
          title: [
            {required: true, message: '入力必須です。', trigger: 'blur'},
            {max: 255, message: '255文字以内で入力してください。', trigger: 'blur'},
          ],
          description: [
            {required: true, message: '入力必須です。', trigger: 'blur'},
            {max: 10000, message: '10000文字以内で入力してください。', trigger: 'blur'},
          ],
          footer: [
            {max: 10000, message: '10000文字以内で入力してください。', trigger: 'blur'},
          ],
        }
      };
    },
    computed: {
      canClickButton() {
        return this.$store.getters.sendsCount > 1;
      }
    },
    mounted() {
      //loadingは使用しない
      axios.get('./webApi/footer')
        .then(response => this.$set(this.values, 'footer', response.data))
        .catch(error => {
          console.log(error);
          this.$message.error('フッター取得に失敗しました。エラーメッセージはWebコンソールを参照してください。');
        });
    },
    methods: {
      submit() {
        this.$refs['form'].validate((valid) => {
          if (valid) {
            this.loading = true;
            axios.post('./webApi/send', this.$store.getters.postValues(this.values))
              .then(response => {
                this.$message.success('メール送信処理に成功しました。');
                this.loading = false;
              })
              .catch(error => {
                console.log(error);
                this.$message.error('メール送信処理に失敗しました。エラーメッセージはWebコンソールを参照してください。');
                this.loading = false;
              });
          } else {
            this.$message.error('入力内容に誤りがあります。');
            return false;
          }
        });
      },
    }
  }
</script>
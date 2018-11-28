<template>
  <div>
    <MagazineLogDetail :dialog-table-visible="detail.dialogTableVisible" :data="detail.data"></MagazineLogDetail>
    <v-client-table :columns="columns"
                    :data="data"
                    :options="options"
                    v-loading="loading"
                    @row-click="showDetail"></v-client-table>
  </div>
</template>

<script>
  import MagazineLogDetail from '../components/MagazineLogDetail'

  export default {
    name: 'MagazineLogTable',
    components: {
      MagazineLogDetail,
    },
    data() {
      return {
        loading: false,
        columns: [],
        data: [],
        detail: {
          dialogTableVisible: false,
          data: {},
        },
        options: {
          headings: {
            id: 'ID',
            title: 'タイトル',
            description: '内容',
            send_at: '送信日時',
            footer: 'フッター',
            count: '送信数',
          },
          orderBy: {
            ascending: false,
            column: 'id',
          },
          pagination: {
            pagination: true,
            edge: true,
          },
          texts: {
            filterPlaceholder: '検索',
          },
        },
      }
    },
    mounted() {
      this.loading = true;
      axios.get('./webApi/logs')
        .then(response => {
          console.log(response);
          this.columns = response.data.columns;
          this.data = response.data.data;
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
          this.$message.error('データ取得に失敗しました。エラーメッセージはWebコンソールを参照してください。');
          this.loading = false;
        });
    },
    methods: {
      showDetail(data) {
        this.$set(this.detail, 'dialogTableVisible', true);
        this.$set(this.detail, 'data', data.row);
      }
    },
  }
</script>
<template>
  <el-menu :default-active="active" class="el-menu-demo" mode="horizontal">
    <el-menu-item index="/" @click="link('./')">
      メールマガジン送信
    </el-menu-item>
    <el-menu-item index="logs" @click="link('./logs')">
      送信履歴
    </el-menu-item>
  </el-menu>
</template>

<script>
  export default {
    name: 'HeaderNav',
    props: {
      active: {type: String, required: true},
    },
    methods: {
      link(path) {
        window.location.href = path;
      }
    },
  }
</script>
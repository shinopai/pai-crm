<template>
<div class="form-wrap">
  <h2 class="form__heading">新規商品登録</h2>
  <form action="" class="form">
    <div class="form__item">
      <input type="text" name="name" placeholder="商品名" class="form__input--text">
    </div>
    <div class="form__item">
      <input type="text" name="price" placeholder="値段" class="form__input--text">
    </div>
    <div class="form__item">
      <input type="button" value="登録" class="form__input--button" @click="storeItem">
    </div>
    <RouterLink :to="{ name: 'item-index' }" class="form__link">戻る</RouterLink>
  </form>
</div>
</template>

<script>
  import { ref, onMounted, inject } from 'vue'
  import axios from 'axios';

  export default{
  setup(){

  // 商品を新規登録
  const storeItem = async () => {
    await axios.post('/api/items/store')
          .then(res => {
            console.log(res.data);
          })
          .catch(e => {
            console.log(e.response.data.message)
          })
  }

  return {
    storeItem
  }
}
  }
</script>

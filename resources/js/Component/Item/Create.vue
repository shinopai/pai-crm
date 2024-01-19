<template>
<div class="form-wrap">
  <h2 class="form__heading">新規商品登録</h2>
  <form action="" class="form" novalidate>
    <div class="form__item">
      <input type="text" name="name" placeholder="商品名" class="form__input--text" v-model="name">
      <p class="err-msg" v-if="isNameErrorExists">
        {{ errors['name'][0] }}
      </p>
    </div>
    <div class="form__item">
      <input type="text" name="price" placeholder="値段" class="form__input--text" v-model="price">
        <p class="err-msg" v-if="isPriceErrorExists">
          {{ errors['price'][0] }}
        </p>
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
  import { useRouter } from 'vue-router'

  export default{
  setup(){
    let name = ref()
    let price = ref()
    let errors = ref([])
    let isNameErrorExists = ref(false)
    let isPriceErrorExists = ref(false)
    const status = '販売中'
    const router = useRouter()

  // 商品を新規登録
  const storeItem = async () => {
    await axios.post('/api/items/store', {
      name: name.value,
      price: price.value,
      status: status
    })
          .then(res => {
            router.push({ name: 'item-index' })
          })
          .catch(e => {
            errors.value = e.response.data.errors
            isNameErrorExists.value = false
            isPriceErrorExists.value = false
              // 商品名関連のエラーの存在チェック
              if(errors.value.name){
                  isNameErrorExists.value = true
              }
              // 値段関連のエラーの存在チェック
                if(errors.value.price){
                  isPriceErrorExists.value = true
              }
            console.log(errors)
          })
  }
  return {
    name,
    price,
    errors,
    isNameErrorExists,
    isPriceErrorExists,
    storeItem
  }
}
  }
</script>

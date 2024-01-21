<template>
<div class="form-wrap" v-if="isItemExists">
  <h2 class="form__heading">商品情報編集</h2>
  <form action="" class="form" novalidate>
    <div class="form__item">
      <input type="text" name="name" placeholder="商品名" class="form__input--text" v-model="item.name">
      <p class="err-msg" v-if="isNameErrorExists">
        {{ errors['name'][0] }}
      </p>
    </div>
    <div class="form__item">
      <input type="text" name="price" placeholder="値段" class="form__input--text" v-model="item.price">
        <p class="err-msg" v-if="isPriceErrorExists">
          {{ errors['price'][0] }}
        </p>
    </div>
    <div class="form__item">
      <label for="status" class="form__label">販売状況</label><br>
      <select name="status" id="status" class="form__select" v-model="item.status">
        <option v-for="status in statusArrays" :value="status" :key="status">
        {{ status }}</option>
      </select>
    </div>
    <div class="form__item">
      <input type="button" value="更新" class="form__input--button" @click="updateItem">
    </div>
    <RouterLink :to="{ name: 'item-show', params: { id : item.id } }" class="form__link">戻る</RouterLink>
  </form>
</div>
<p v-else>詳細情報がありません</p>
</template>

<script>
  import { ref, onMounted } from 'vue'
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router'

  export default{
    setup(){
      const item = ref([])
      const route = useRoute()
      const router = useRouter()
      const paramsId = route.params.id
      const statusArrays = [
        '販売中',
        '販売停止中',
        '販売終了'
      ]
      let isItemExists = ref(false)
      let errors = ref([])
      let isNameErrorExists = ref(false)
      let isPriceErrorExists = ref(false)

      // 商品の詳細情報を取得
      const getItem = async () => {
        await axios.get('/api/items/item/' + paramsId)
              .then(res => {
                item.value = res.data.item[0]
              })
              .catch(e => {
                console.log(e.response.data.message)
              })
      }

      // 商品情報を更新
      const updateItem = async () => {
        await axios.patch('/api/items/item/' + paramsId + '/update', {
          name: item.value.name,
          price: item.value.price,
          status: item.value.status
        })
        .then( res => {
          router.push({ name: 'item-show', params: { id: paramsId } })
        })
        .catch( e => {
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
        })
      }

  // 商品が存在しているかチェック
  const checkIsItemExists = () => {
    if(item.value){
      return true
    }
  }

    onMounted(async () => {
      await getItem()
      isItemExists.value = checkIsItemExists()
    })

    return {
      item,
      isItemExists,
      errors,
      statusArrays,
      updateItem,
      isNameErrorExists,
      isPriceErrorExists
    }
    }
  }
</script>

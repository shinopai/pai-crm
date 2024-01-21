<template>
  <table class="detail-table" v-if="isItemExists">
    <caption>商品詳細</caption>
<tr>
<td class="heading">商品名</td>
<td>
  {{ item.name }}
</td>
</tr>
<tr>
<td class="heading">値段</td>
<td>
  {{ item.price.toLocaleString() }}
</td>
</tr>
<tr>
<td class="heading">販売状態</td>
<td>
  {{ item.status }}
</td>
</tr>
<tr>
<td colspan="2">
  <div class="flex">
    <RouterLink :to="{ name: 'item-edit', params: { id : item.id } }" class="detail-table__btn edit">編集</RouterLink>
    <a href="" class="detail-table__btn delete">削除</a>
    <RouterLink :to="{ name: 'item-index' }" class="detail-table__btn back">戻る</RouterLink>
  </div>
</td>
</tr>
  </table>
<p v-else>商品情報はありません</p>
</template>

<script>
  import { ref, onMounted } from 'vue'
  import axios from 'axios';
  import { useRoute } from 'vue-router'

  export default{
    setup(){
      const item = ref([])
      const route = useRoute()
      const paramsId = route.params.id
      let isItemExists = ref(false)

      // 商品の詳細情報を取得
      const getItem = async () => {
        await axios.get('/api/items/item/' + paramsId)
              .then(res => {
                item.value = res.data.item[0]
                console.log(item.value)
              })
              .catch(e => {
                console.log(e.response.data.message)
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
      isItemExists
    }
    }
  }
</script>

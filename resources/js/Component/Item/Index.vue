<template>
    <div class="table-wrap">
      <div class="table__header flex">
        <h2>商品一覧</h2>
        <RouterLink :to="{ name: 'item-create' }">商品登録</RouterLink>
      </div>
    <div class="table-area" v-if="isItemsExists">
      <table class="table">
        <tr>
          <td class="heading">商品名</td>
          <td class="heading">値段</td>
          <td class="heading">状態</td>
          <td class="heading">登録日</td>
          <td class="heading"></td>
        </tr>
        <tr v-for="item in items" :key="item">
          <td>
            <RouterLink :to="{ name: 'item-show', params: { id: item.id } }">{{ item.name }}</RouterLink>
          </td>
          <td>{{ item.price.toLocaleString() }}</td>
          <td>{{ item.status }}</td>
          <td>{{ dayjs(item.created_at).format('YYYY年MM月DD日') }}</td>
          <td>
            <RouterLink :to="{ name: 'item-show', params: { id: item.id } }" class="btn">詳細</RouterLink>
          </td>
        </tr>
      </table>
    </div>
    <p v-else>商品はありません</p>
    <nav>
    <ul class="pagination flex" v-if="isItemsExists">
      <li v-for="link in pageLinks" :key="link" :class="{ 'current' : link.active }" @click="clickPage(link.url)">
        {{ link.label }}
      </li>
    </ul>
  </nav>
  </div>
</template>

<script>
  import { ref, onMounted, inject } from 'vue'
  import axios from 'axios';

  export default{
  setup(){

  const items = ref()
  const pageLinks = ref()
  const dayjs = inject('dayjs')
  let isItemsExists = ref(false)

  // 全ての商品情報を取得
  const getAllItems = async (q) => {
    if(q == undefined){
      q = ''
    }
    await axios.get('/api/items/' + q)
          .then(res => {
            items.value = res.data.items.data
            pageLinks.value = res.data.items.links
            console.log(pageLinks.value)
          })
          .catch(e => {
            console.log(e.response.data.message)
          })
  }

  // 商品が1つ以上存在しているかチェック
  const checkIsItemsExists = () => {
    if(items._value.length > 1){
      return true
    }
  }

  onMounted(async () => {
    await getAllItems()
    isItemsExists.value = await checkIsItemsExists()
  })

  // ページャークリックで商品データを再取得
  const clickPage = (url) => {
    let res = new URL(url)
    getAllItems(res.search)
  }

  return {
    getAllItems,
    checkIsItemsExists,
    isItemsExists,
    items,
    pageLinks,
    dayjs,
    clickPage
  }
}
  }
</script>

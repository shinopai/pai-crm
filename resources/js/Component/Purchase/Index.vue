<template>
    <div class="table-wrap">
      <div class="table__header flex">
        <h2>購買履歴一覧</h2>
      </div>
    <div class="table-area" v-if="isPurchasesExists">
      <table class="table">
        <tr>
          <td class="heading">商品名</td>
          <td class="heading">購入者名</td>
          <td class="heading">購入数</td>
          <td class="heading">総購入額</td>
          <td class="heading">購入日時</td>
          <td class="heading"></td>
        </tr>
        <tr v-for="(purchase, index) in purchases" :key="purchase">
          <td>
            {{ items[index].name }}
          </td>
          <td>{{ customers[index].name }}</td>
          <td>{{ purchase.quantity }}</td>
          <td>{{ getPurchaseAmount(purchase.quantity, items[index].price).toLocaleString() }}</td>
          <td>
            {{ dayjs(purchase.purchase_datetime).format('YYYY年MM月DD日 H時m分s秒') }}
          </td>
          <td class="flex">
            <RouterLink :to="{ name: 'purchase-show', params: { id: purchase.id } }" class="btn show">詳細</RouterLink>
            <!-- <RouterLink :to="{ name: 'purchase-create', params: { purchase_id: purchase.id } }" class="btn purchase" v-if="purchase.status == '販売中'">購入</RouterLink> -->
          </td>
        </tr>
      </table>
    </div>
    <p v-else>購買履歴はありません</p>
    <nav>
    <ul class="pagination flex" v-if="isPurchasesExists">
      <li v-for="link in pageLinks" :key="link" :class="{ 'current' : link.active, 'disabled' : link.url == null }" @click="clickPage(link.url)">
        {{ link.label }}
      </li>
    </ul>
  </nav>
  </div>
</template>

<script>
  import { ref, onMounted, computed, inject } from 'vue'
  import axios from 'axios';

  export default{
  setup(){

  const purchases = ref([])
  const customers = ref([])
  const items = ref([])
  const pageLinks = ref()
  const dayjs = inject('dayjs')
  let isPurchasesExists = ref(false)

  // 全ての購入履歴情報を取得
  const getAllPurchases = async (q) => {
    if(q == undefined){
      q = ''
    }
    await axios.get('/api/purchases/' + q)
          .then(res => {
            console.log(res.data)
            purchases.value = res.data.purchases.data
            customers.value = res.data.customers
            items.value = res.data.items
            pageLinks.value = res.data.purchases.links
          })
          .catch(e => {
            console.log(e.response)
          })
  }

  // 購買履歴1つ以上存在しているかチェック
  const checkIsPurchasesExists = () => {
    if(purchases._value.length > 1){
      return true
    }
  }

  // 総購入額を算出
  const getPurchaseAmount = (quantity, price) => {
    return quantity * price
  }

  onMounted(async () => {
    await getAllPurchases()
    isPurchasesExists.value = await checkIsPurchasesExists()
  })

  // ページャークリックで商品データを再取得
  const clickPage = (url) => {
    let res = new URL(url)
    getAllPurchases(res.search)
  }

  return {
    getAllPurchases,
    checkIsPurchasesExists,
    isPurchasesExists,
    purchases,
    customers,
    items,
    pageLinks,
    dayjs,
    clickPage,
    getPurchaseAmount
  }
}
  }
</script>

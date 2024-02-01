<template>
    <div class="table-wrap">
      <div class="table__header flex">
        <h2>顧客一覧</h2>
        <RouterLink :to="{ name: 'customer-create' }">顧客登録</RouterLink>
      </div>
    <div class="table-area" v-if="isCustomersExists">
      <table class="table">
        <tr>
          <td class="heading">顧客名</td>
          <td class="heading">電話番号</td>
          <td class="heading">メールアドレス</td>
          <td class="heading">郵便番号</td>
          <td class="heading">住所</td>
          <td class="heading">生年月日</td>
          <td class="heading">性別</td>
          <td class="heading">備考</td>
          <td class="heading"></td>
        </tr>
        <tr v-for="customer in customers" :key="customer">
          <td>
            <RouterLink :to="{ name: 'customer-show', params: { id: customer.id } }">{{ customer.name }}</RouterLink>
          </td>
          <td>{{ customer.tel }}</td>
          <td>{{ customer.email }}</td>
          <td>{{ customer.postcode }}</td>
          <td>{{ customer.address }}</td>
          <td>{{ dayjs(customer.birthday).format('YYYY年MM月DD日') }}</td>
          <td>{{ customer.gender }}</td>
          <td>{{ customer.memo }}</td>
          <td>
            <RouterLink :to="{ name: 'customer-show', params: { id: customer.id } }" class="btn">詳細</RouterLink>
          </td>
        </tr>
      </table>
    </div>
    <p v-else>顧客はありません</p>
    <nav>
    <ul class="pagination flex" v-if="isCustomersExists">
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

  const customers = ref()
  const pageLinks = ref()
  const dayjs = inject('dayjs')
  let isCustomersExists = ref(false)

  // 全ての顧客情報を取得
  const getAllCustomers = async (q) => {
    if(q == undefined){
      q = ''
    }
    await axios.get('/api/customers/' + q)
          .then(res => {
            customers.value = res.data.customers.data
            pageLinks.value = res.data.customers.links
            console.log(pageLinks.value)
          })
          .catch(e => {
            console.log(e.response.data.message)
          })
  }

  // 顧客が一人以上存在しているかチェック
  const checkIsCustomersExists = () => {
    if(customers._value.length > 1){
      return true
    }
  }

  onMounted(async () => {
    await getAllCustomers()
    isCustomersExists.value = await checkIsCustomersExists()
  })

  // ページャークリックで商品データを再取得
  const clickPage = (url) => {
    let res = new URL(url)
    getAllCustomers(res.search)
  }

  return {
    getAllCustomers,
    checkIsCustomersExists,
    isCustomersExists,
    customers,
    pageLinks,
    dayjs,
    clickPage
  }
}
  }
</script>

<template>
  <table class="detail-table" v-if="isPurchaseExists">
    <caption>購入情報詳細</caption>
<tr>
<td class="heading">商品名</td>
<td>
  {{ item.name }}
</td>
</tr>
<tr>
<td class="heading">購入者名</td>
<td>
  {{ customer.name }}
</td>
</tr>
<tr>
<td class="heading">購入数</td>
<td>
  {{ purchase.quantity }}
</td>
</tr>
<tr>
<td class="heading">総購入額</td>
<td>
  {{ getPurchaseAmount(purchase.quantity, item.price).toLocaleString() }}
</td>
</tr>
<tr>
<td class="heading">購入日時</td>
<td>
  {{ dayjs(purchase.purchase_datetime).format('YYYY年MM月DD日 H時m分s秒') }}
</td>
</tr>
<tr>
<td colspan="2">
  <div class="flex">
    <RouterLink :to="{ name: 'purchase-edit', params: { id : purchase.id } }" class="detail-table__btn edit">編集</RouterLink>
    <!-- <button class="detail-table__btn destroy" @click="destroypurchase">削除</button> -->
    <RouterLink :to="{ name: 'purchase-index' }" class="detail-table__btn back">戻る</RouterLink>
  </div>
</td>
</tr>
  </table>
<p v-else>購買情報はありません</p>
</template>

<script>
  import { ref, onMounted, inject } from 'vue'
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router'

  export default{
    setup(){
      const purchase = ref([])
      const customer = ref([])
      const item = ref([])
      const route = useRoute()
      const router = useRouter()
      const paramsId = route.params.id
      const dayjs = inject('dayjs')
      let isPurchaseExists = ref(false)

      // 購買の詳細情報を取得
      const getPurchase = async () => {
        await axios.get('/api/purchases/purchase/' + paramsId)
              .then(res => {
                console.log(res.data)
                purchase.value = res.data.purchase
                customer.value = res.data.customer
                item.value = res.data.item
              })
              .catch(e => {
                console.log(e.response.data.message)
              })
      }

      // 購買情報を削除
      const destroyPurchase = async () => {
        if(confirm('本当に削除して宜しいですか？この操作は元に戻せません。')){
          await axios.delete('/api/purchases/purchase/' + paramsId + '/destroy')
          .then( res => {
            router.push({ name: 'purchase-index' })
          })
          .catch( e => {
              console.log(e.response.data.message)
          })
        }
      }

  // 商品が存在しているかチェック
  const checkIsPurchaseExists = () => {
    if(purchase.value){
      return true
    }
  }

  // 総購入額を算出
  const getPurchaseAmount = (quantity, price) => {
    return quantity * price
  }

    onMounted(async () => {
      await getPurchase()
      isPurchaseExists.value = checkIsPurchaseExists()
    })

    return {
      purchase,
      customer,
      item,
      isPurchaseExists,
      destroyPurchase,
      dayjs,
      getPurchaseAmount
    }
    }
  }
</script>

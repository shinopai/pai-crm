<template>
<div class="form-wrap">
  <h2 class="form__heading">「{{ item.name }}」新規購買情報登録</h2>
  <dl class="form__def">
    <dt>値段:</dt>
    <dd>{{ item.price }}</dd>
  </dl>
  <dl class="form__def">
    <dt>総購入額:</dt>
    <dd>{{ getPurchaseAmount }}</dd>
  </dl>
  <form action="" class="form" novalidate>
    <div class="form__item">
      <label class="form__label" for="quantity">購入数</label><br>
      <input type="number" name="quantity" id="quantity" class="form__input--number" v-model="quantity" min="1" max="10">
        <p class="err-msg" v-if="isQuantityErrorExists">
          {{ errors['quantity'][0] }}
        </p>
    </div>
    <div class="form__item">
      <label class="form__label" for="purchase_datetime">購入日時</label><br>
      <input type="datetime-local" name="purchase_datetime" id="purchase_datetime" class="form__input--text" v-model="purchaseDateTime">
        <p class="err-msg" v-if="isPurchaseDateTimeErrorExists">
          {{ errors['purchase_datetime'][0] }}
        </p>
    </div>
    <div class="form__item">
      <label class="form__label" for="customer_id">購入顧客</label><br>
      <select v-model="customerId" id="customer_id" class="form__select">
        <option v-for="customer in customers" :value="customer.id" :key="customer">{{ customer.name }}</option>
    </select>
        <p class="err-msg" v-if="isCustomerIdErrorExists">
          {{ errors['customer_id'][0] }}
        </p>
    </div>
    <div class="form__item">
      <input type="button" value="登録" class="form__input--button" @click="storePurchase">
    </div>
    <RouterLink :to="{ name: 'purchase-index' }" class="form__link">戻る</RouterLink>
  </form>
</div>
</template>

<script>
  import { ref, onMounted, computed } from 'vue'
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router'

  export default{
  setup(){
    let quantity = ref(1)
    let purchaseDateTime = ref()
    let customerId = ref()
    let errors = ref([])
    let isQuantityErrorExists = ref(false)
    let isPurchaseDateTimeErrorExists = ref(false)
    let isCustomerIdErrorExists = ref(false)
    let customers = ref([])
    let item = ref()
    const route = useRoute()
    const router = useRouter()
    const paramsId = route.params.item_id

  // 全顧客情報を取得(idと名前のみ)
  const getAllCustomers = async () => {
    await axios.get('/api/customers/partial/')
          .then( res => {
              console.log(res.data.customers)
              customers.value = res.data.customers
            })
            .catch( err => {
              console.log(err.message)
            })
  }

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

  // 購入情報を新規登録
  const storePurchase = async () => {
    await axios.post('/api/purchases/store/', {
      quantity: quantity.value,
      purchase_datetime: purchaseDateTime.value,
      customer_id: customerId.value,
      item_id: Number(paramsId)
    })
          .then(res => {
            router.push({ name: 'purchase-index' })
          })
          .catch(e => {
            console.log(e.response.data)
            errors.value = e.response.data.errors
            isQuantityErrorExists.value = false
            isPurchaseDateTimeErrorExists.value = false
            isCustomerIdErrorExists.value = false
              // 購入数関連のエラーの存在チェック
              if(errors.value.quantity){
                  isQuantityErrorExists.value = true
              }
              // 購入日時関連のエラーの存在チェック
                if(errors.value.purchase_datetime){
                  isPurchaseDateTimeErrorExists.value = true
              }
              // 購入顧客ID関連のエラーの存在チェック
                if(errors.value.customer_id){
                  isCustomerIdErrorExists.value = true
              }
          })
  }

  getAllCustomers()
  getItem()

  // 総購入額を算出
  const getPurchaseAmount = computed(() => {
    return item.value.price * quantity.value
  })

  // onMounted(() => {
  // })

  return {
    quantity,
    purchaseDateTime,
    customerId,
    errors,
    isQuantityErrorExists,
    isPurchaseDateTimeErrorExists,
    isCustomerIdErrorExists,
    storePurchase,
    customers,
    getAllCustomers,
    getItem,
    item,
    getPurchaseAmount
  }
}
  }

</script>

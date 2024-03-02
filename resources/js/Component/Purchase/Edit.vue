<template>
<div class="form-wrap" v-if="isPurchaseExists">
  <h2 class="form__heading">「{{ item.name }}」購買情報編集</h2>
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
      <dl>
        <dt>購入者</dt>
        <dd>{{ customer.name }}</dd>
      </dl>
    </div>
    <div class="form__item">
      <input type="button" value="更新" class="form__input--button" @click="updatePurchase">
    </div>
    <RouterLink :to="{ name: 'purchase-show', params: { id : purchase.id } }" class="form__link">戻る</RouterLink>
  </form>
</div>
<p v-else>購買情報がありません</p>
</template>

<script>
  import { ref, onMounted, computed } from 'vue'
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router'

  export default{
    setup(){
      const purchase = ref([])
      const customer = ref([])
      const customers = ref([])
      const item = ref([])
      const route = useRoute()
      const router = useRouter()
      const paramsId = route.params.id
      const customerId = ref()
      let isPurchaseExists = ref(false)
      let errors = ref([])
      let isQuantityErrorExists = ref(false)
      let isPurchaseDateTimeErrorExists = ref(false)
      let quantity = ref()
      let purchaseDateTime = ref()

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

      // 購買情報を更新
      const updatePurchase = async () => {
        await axios.patch('/api/purchases/purchase/' + paramsId + '/update', {
          quantity: quantity.value,
          purchase_datetime: purchaseDateTime.value,
          customer_id: customer.value.id,
          item_id: item.value.id
        })
        .then( res => {
          router.push({ name: 'purchase-show', params: { id: paramsId } })
        })
        .catch( e => {
          errors.value = e.response.data.errors
          isQuantityErrorExists.value = false
          isPurchaseDateTimeErrorExists.value = false
            // 購入数関連のエラーの存在チェック
            if(errors.value.quantity){
                isQuantityErrorExists.value = true
            }
            // 購入日時関連のエラーの存在チェック
            if(errors.value.purchase_datetime){
              isPurchaseDateTimeErrorExists.value = true
          }
        })
      }

  // 商品が存在しているかチェック
  const checkIsPurchaseExists = () => {
    if(purchase.value){
      return true
    }
  }

  // 全顧客情報を取得(idと名前のみ)
  const getAllCustomers = async () => {
    await axios.get('/api/customers/partial/')
          .then( res => {
              customers.value = res.data.customers
            })
            .catch( err => {
              console.log(err.message)
            })
  }

  // 総購入額を算出
  const getPurchaseAmount = computed(() => {
    return item.value.price * quantity.value
  })

  onMounted(async () => {
    await getPurchase()
    await getAllCustomers()
    isPurchaseExists.value = checkIsPurchaseExists()
    quantity.value = purchase.value.quantity
    purchaseDateTime.value = purchase.value.purchase_datetime
    customerId.value = customer.value.id
  })

    return {
      purchase,
      customer,
      customers,
      item,
      quantity,
      customerId,
      purchaseDateTime,
      isPurchaseExists,
      getPurchaseAmount,
      getAllCustomers,
      errors,
      updatePurchase,
      isQuantityErrorExists,
      isPurchaseDateTimeErrorExists
    }
    }
  }
</script>

<template>
<div class="form-wrap">
  <h2 class="form__heading">新規顧客登録</h2>
  <form action="" class="form" novalidate>
    <div class="form__item">
      <input type="text" name="name" placeholder="顧客名" class="form__input--text" v-model="name">
      <p class="err-msg" v-if="isNameErrorExists">
        {{ errors['name'][0] }}
      </p>
    </div>
    <div class="form__item">
      <input type="text" name="tel" placeholder="電話番号" class="form__input--text" v-model="tel">
        <p class="err-msg" v-if="isTelErrorExists">
          {{ errors['tel'][0] }}
        </p>
    </div>
    <div class="form__item">
      <input type="text" name="email" placeholder="メールアドレス" class="form__input--text" v-model="email">
        <p class="err-msg" v-if="isEmailErrorExists">
          {{ errors['email'][0] }}
        </p>
    </div>
    <div class="form__item">
      <input type="text" name="postcode" placeholder="郵便番号" class="form__input--text" v-model="postcode">
        <p class="err-msg" v-if="isPostcodeErrorExists">
          {{ errors['postcode'][0] }}
        </p>
    </div>
    <div class="form__item">
      <input type="text" name="address" placeholder="住所" class="form__input--text" v-model="address">
        <p class="err-msg" v-if="isAddressErrorExists">
          {{ errors['address'][0] }}
        </p>
    </div>
    <div class="form__item">
      <input type="date" name="birthday" placeholder="生年月日" class="form__input--text" v-model="birthday" max="">
        <p class="err-msg" v-if="isBirthdayErrorExists">
          {{ errors['birthday'][0] }}
        </p>
    </div>
    <div class="form__item">
      <p class="form__label">性別</p>
      <input type="radio" name="gender" id="gender_male" class="form__input--radio" value="男性" v-model="gender" checked><label for="gender_male" class="form__label">男性</label>
      <input type="radio" name="gender" id="gender_female" class="form__input--radio" value="女性" v-model="gender"><label for="gender_female" class="form__label">女性</label>
        <p class="err-msg" v-if="isGenderErrorExists">
          {{ errors['gender'][0] }}
        </p>
    </div>
    <div class="form__item">
      <textarea name="memo" class="form__textarea" cols="30" rows="10" placeholder="メモ" v-model="memo"></textarea>
        <p class="err-msg" v-if="isMemoErrorExists">
          {{ errors['memo'][0] }}
        </p>
    </div>
    <div class="form__item">
      <input type="button" value="登録" class="form__input--button" @click="storeCustomer">
    </div>
    <RouterLink :to="{ name: 'customer-index' }" class="form__link">戻る</RouterLink>
  </form>
</div>
</template>

<script>
  import { ref } from 'vue'
  import axios from 'axios';
  import { useRouter } from 'vue-router'

  export default{
  setup(){
    let name = ref()
    let tel = ref()
    let email = ref()
    let postcode = ref()
    let address = ref()
    let birthday = ref()
    let gender = ref()
    let memo = ref()
    let errors = ref([])
    let isNameErrorExists = ref(false)
    let isTelErrorExists = ref(false)
    let isEmailErrorExists = ref(false)
    let isPostcodeErrorExists = ref(false)
    let isAddressErrorExists = ref(false)
    let isBirthdayErrorExists = ref(false)
    let isGenderErrorExists = ref(false)
    let isMemoErrorExists = ref(false)
    const router = useRouter()

  // 性別の初期値設定
    gender.value = '男性';

  // 顧客を新規登録
  const storeCustomer = async () => {
    await axios.post('/api/customers/store', {
      name: name.value,
      tel: tel.value,
      email: email.value,
      postcode: postcode.value,
      address: address.value,
      birthday: birthday.value,
      gender: gender.value,
      memo: memo.value
    })
          .then(res => {
            router.push({ name: 'customer-index' })
          })
          .catch(e => {
            errors.value = e.response.data.errors
            isNameErrorExists.value = false
            isTelErrorExists.value = false
            isEmailErrorExists.value = false
            isPostcodeErrorExists.value = false
            isAddressErrorExists.value = false
            isBirthdayErrorExists.value = false
            isGenderErrorExists.value = false
            isMemoErrorExists.value = false
              // 顧客名関連のエラーの存在チェック
              if(errors.value.name){
                  isNameErrorExists.value = true
              }
              // 電話番号関連のエラーの存在チェック
                if(errors.value.tel){
                  isTelErrorExists.value = true
              }
              // メールアドレス関連のエラーの存在チェック
                if(errors.value.email){
                  isEmailErrorExists.value = true
              }
              // 郵便番号関連のエラーの存在チェック
                if(errors.value.postcode){
                  isPostcodeErrorExists.value = true
              }
              // 住所関連のエラーの存在チェック
                if(errors.value.address){
                  isAddressErrorExists.value = true
              }
              // 生年月日関連のエラーの存在チェック
                if(errors.value.birthday){
                  isBirthdayErrorExists.value = true
              }
              // 性別関連のエラーの存在チェック
                if(errors.value.gender){
                  isGenderErrorExists.value = true
              }
              // メモ関連のエラーの存在チェック
                if(errors.value.memo){
                  isMemoErrorExists.value = true
              }
          })
  }
  return {
    name,
    tel,
    email,
    postcode,
    address,
    birthday,
    gender,
    memo,
    errors,
    isNameErrorExists,
    isTelErrorExists,
    isEmailErrorExists,
    isPostcodeErrorExists,
    isAddressErrorExists,
    isBirthdayErrorExists,
    isGenderErrorExists,
    isMemoErrorExists,
    storeCustomer
  }
}
  }

  $(function(){

// input[type=”date”]のminとmaxを現在日時取得して指定
// min (現在の3日後)
var minD = new Date();// 現在日時取得
minD.setDate(minD.getDate() + 3);// 現在日時の日数+3して上書き
var minYear = minD.getFullYear();// 上書きしたので、年月日それぞれ取得
var minMonth = minD.getMonth() + 1;
if(minMonth < 10){// 2桁にしないといけないので 10未満なら頭に0を追加
var minMonth = '0' + minMonth;
}
var minDate = minD.getDate();
if(minDate < 10){// 2桁にしないといけないので 10未満なら頭に0を追加
var minDate = '0' + minDate;
}
var min = minYear + '-' + minMonth + '-' + minDate;// yyyy-mm-ddになるように
$('input[type=”date”]').attr('min', min);
// max (現在の30日後)
var maxD = new Date();// 現在日時取得
maxD.setDate(maxD.getDate() + 30);// 現在日時の日数+30して上書き
var maxYear = maxD.getFullYear();// 上書きしたので、年月日それぞれ取得
var maxMonth = maxD.getMonth() + 1;
if(maxMonth < 10){// 2桁にしないといけないので 10未満なら頭に0を追加
var maxMonth = '0' + maxMonth;
}
var maxDate = maxD.getDate();
if(maxDate < 10){// 2桁にしないといけないので 10未満なら頭に0を追加
var maxDate = '0' + maxDate;
}
var max = maxYear + '-' + maxMonth + '-' + maxDate;//yyyy-mm-ddになるように
$('input[type=”date”]').attr('max', max);
});
</script>

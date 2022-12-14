// change address in payment page
const payment_update_user_address = document.querySelector('.payment__info__update__submit');
const update_user_address_form = document.querySelector('.payment__info__update__form');
let isUpdateAddress = true;
payment_update_user_address.addEventListener('click', () => {
  if(!isUpdateAddress){
    insert_user_address_form.style.display = 'none';
    update_user_address_form.style.display = 'none';
  } else {
    insert_user_address_form.style.display = 'none';
    update_user_address_form.style.display = 'block';
    update_user_address_form.style.animation = 'opacityShowingUp 0.2s ease-in-out';
    isInsertAddress = true;
  }
  isUpdateAddress = !isUpdateAddress;
});

const payment_insert_user_address = document.querySelector('.payment__info__insert__submit');
const insert_user_address_form = document.querySelector('.payment__info__insert__form');
let isInsertAddress = true;
payment_insert_user_address.addEventListener('click', () => {
  if(!isInsertAddress){
    update_user_address_form.style.display = "none";
  insert_user_address_form.style.display = "none";
  } else {
    update_user_address_form.style.display = "none";
    insert_user_address_form.style.display = "block";
    insert_user_address_form.style.animation = 'opacityShowingUp 0.2s ease-in-out';
    isUpdateAddress = true;
}
  isInsertAddress = !isInsertAddress;
});

// get value for payment method
let valueOfRadioSelectedWillBeSend = document.getElementById('payment_method_checked');

let setSelected = function(payment_id){
  let payment_method = document.getElementById(`payment_id--${payment_id}`);
  payment_method.checked = true;
  valueOfRadioSelectedWillBeSend.value = payment_method.value;
}


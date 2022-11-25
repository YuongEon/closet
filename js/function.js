// change value of product buy quantity
let product_buy_quantity = document.querySelector(".product__quantity");
const product_addition_quantity = document.querySelector(".product__addition__quantity");
const product_subtraction_quantity = document.querySelector(".product__subtraction__quantity");

let product_buy_quantity_value = Number(product_buy_quantity.value);

product_addition_quantity.addEventListener('click', () => {
  product_buy_quantity.value = product_buy_quantity_value += 1;
})

product_subtraction_quantity.addEventListener('click', () => {
  if(product_buy_quantity.value <= 1){
    product_buy_quantity.value = 1;
  } else {
    product_buy_quantity.value = product_buy_quantity_value -= 1;
  }
})

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
}
  isInsertAddress = !isInsertAddress;
});
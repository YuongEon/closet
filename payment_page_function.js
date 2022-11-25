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
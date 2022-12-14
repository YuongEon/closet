const payment_update_user_address = document.querySelector('.payment__info__user--change--btn.update');
const update_user_address_form = document.querySelector('.payment__info__user--change__form');
let isUpdateAddress = true;
payment_update_user_address.addEventListener('click', () => {
  if(!isUpdateAddress){
    insert_user_address_form.style.display = 'none';
    update_user_address_form.style.display = 'none';
    payment_update_user_address.style.backgroundColor = 'var(--background-color-light)';
    payment_update_user_address.style.color = 'var(--main-color)';
  } else {
    insert_user_address_form.style.display = 'none';
    update_user_address_form.style.display = 'flex';
    payment_update_user_address.style.backgroundColor = 'var(--main-color)';
    payment_update_user_address.style.color = 'var(--background-color-light)';
    update_user_address_form.style.animation = 'opacityShowingUp 0.4s ease-in-out';
       // btn
       payment_insert_user_address.style.backgroundColor = 'var(--background-color-light)';
       payment_insert_user_address.style.color = 'var(--main-color)';
    isInsertAddress = true;
  }
  isUpdateAddress = !isUpdateAddress;
});

const payment_insert_user_address = document.querySelector('.payment__info__user--change--btn.insert');
const insert_user_address_form = document.querySelector('.payment__info__user--insert__form');
let isInsertAddress = true;
payment_insert_user_address.addEventListener('click', () => {
  if(!isInsertAddress){
    update_user_address_form.style.display = "none";
    insert_user_address_form.style.display = "none";
    payment_insert_user_address.style.backgroundColor = 'var(--background-color-light)';
    payment_insert_user_address.style.color = 'var(--main-color)';
  } else {
    update_user_address_form.style.display = "none";
    insert_user_address_form.style.display = "flex";
    payment_insert_user_address.style.backgroundColor = 'var(--main-color)';
    payment_insert_user_address.style.color = 'var(--background-color-light)';
    insert_user_address_form.style.animation = 'opacityShowingUp 0.4s ease-in-out';
    // btn
    payment_update_user_address.style.backgroundColor = 'var(--background-color-light)';
    payment_update_user_address.style.color = 'var(--main-color)';
    isUpdateAddress = true;
}
  isInsertAddress = !isInsertAddress;
});



// change data
  // fullName
let fullName = document.getElementById('fullName');
let fullNameDataUpdate = document.getElementById('fullNameDataUpdate');
let fullNameDataInsert = document.getElementById('fullNameDataInsert');

fullNameDataUpdate.addEventListener('input', () => {
  fullName.innerHTML = fullNameDataUpdate.value;
})
fullNameDataInsert.addEventListener('input', () => {
  fullName.innerHTML = fullNameDataInsert.value;
})
  // email
let email = document.getElementById('email');
let emailDataUpdate = document.getElementById('emailDataUpdate');
let emailDataInsert = document.getElementById('emailDataInsert');
  
emailDataUpdate.addEventListener('input', () => {
  email.innerHTML = emailDataUpdate.value;  
})
emailDataInsert.addEventListener('input', () => {
  email.innerHTML = emailDataInsert.value;  
})
  // phone
let phone = document.getElementById('phone');
let phoneDataUpdate = document.getElementById('phoneDataUpdate');
let phoneDataInsert = document.getElementById('phoneDataInsert');
  
phoneDataUpdate.addEventListener('input', () => {
  phone.innerHTML = phoneDataUpdate.value;  
})
phoneDataInsert.addEventListener('input', () => {
  phone.innerHTML = phoneDataInsert.value;  
})
  // address 0 
  let address0 = document.getElementById('address0');
  let address0DataUpdate = document.getElementById('address0DataUpdate');
  let address0DataInsert = document.getElementById('address0DataInsert');
    
  address0DataUpdate.addEventListener('input', () => {
    address0.innerHTML = address0DataUpdate.value;  
  })
  address0DataInsert.addEventListener('input', () => {
    address0.innerHTML = address0DataInsert.value;  
  })
  // address 1
  let address1 = document.getElementById('address1');
  let address1DataUpdate = document.getElementById('address1DataUpdate');
  let address1DataInsert = document.getElementById('address1DataInsert');
    
  address1DataUpdate.addEventListener('input', () => {
    address1.innerHTML = address1DataUpdate.value;  
  })
  address1DataInsert.addEventListener('input', () => {
    address1.innerHTML = address1DataInsert.value;  
  })
  // address 2
  let address2 = document.getElementById('address2');
  let address2DataUpdate = document.getElementById('address2DataUpdate');
  let address2DataInsert = document.getElementById('address2DataInsert');
    
  address2DataUpdate.addEventListener('input', () => {
    address2.innerHTML = address2DataUpdate.value;  
  })
  address2DataInsert.addEventListener('input', () => {
    address2.innerHTML = address2DataInsert.value;  
  })
  // address 3
  let address3 = document.getElementById('address3');
  let address3DataUpdate = document.getElementById('address3DataUpdate');
  let address3DataInsert = document.getElementById('address3DataInsert');
    
  address3DataUpdate.addEventListener('input', () => {
    address3.innerHTML = address3DataUpdate.value;  
  })
  address3DataInsert.addEventListener('input', () => {
    address3.innerHTML = address3DataInsert.value;  
  })


  // payment_method
  let valueOfRadioSelectedWillBeSend = document.getElementById('payment_method--checked');

  let paymentSelected = function(payment_id){
    let payment_method = document.getElementById(`payment_method--${payment_id}`);
    payment_method.checked = true;
    valueOfRadioSelectedWillBeSend.value = payment_method.value;
  }

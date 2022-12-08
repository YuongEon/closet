// change value of product buy quantity
let product_buy_quantity = document.querySelector(".product__quantity");
const product_addition_quantity = document.querySelector(".product__addition__quantity");
const product_subtraction_quantity = document.querySelector(".product__subtraction__quantity");

let total_quantity_product = document.querySelector(".product__total__quantity--value").textContent;

let product_buy_quantity_value = Number(product_buy_quantity.value);
let total_quantity_product_value = Number(total_quantity_product);

product_addition_quantity.addEventListener('click', () => {
  if(product_buy_quantity.value >=  total_quantity_product_value){
    product_buy_quantity.value = total_quantity_product_value;
  } else {  
    product_buy_quantity.value = product_buy_quantity_value += 1;
  }
})

product_subtraction_quantity.addEventListener('click', () => {
  if(product_buy_quantity.value <= 1){
    product_buy_quantity.value = 1;
  } else {
    product_buy_quantity.value = product_buy_quantity_value -= 1;
  }
})

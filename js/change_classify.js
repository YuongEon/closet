function changeClassifyColor(colorValue){
  let colorSelectRadio = document.getElementById(`color-${colorValue}`);
  colorSelectRadio.checked = true;
  if(colorSelectRadio.checked){
    let colorSelectedData = document.getElementById("colorSelected");
    colorSelectedData.innerHTML = colorValue;
  }
}
import {moneyFormater} from "./components.js";

let moneyItems = document.getElementsByClassName('money');
for (let item of moneyItems) {
    let price = item.innerHTML;
    item.innerHTML = moneyFormater(price);
}
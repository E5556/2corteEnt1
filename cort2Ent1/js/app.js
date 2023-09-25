let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})
closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})

let products = [
    {
        id: 1,
        name: 'Comida Thai',
        image: '1.PNG',
        price: 12000
    },
    {
        id: 2,
        name: 'Alitas Picantes',
        image: '2.PNG',
        price: 12000
    },
    {
        id: 3,
        name: 'Salmon Asado',
        image: '3.PNG',
        price: 22000
    },
    {
        id: 4,
        name: 'Crema Ahuyama',
        image: '4.PNG',
        price: 12300
    },
    {
        id: 5,
        name: 'Ensalada Cesar',
        image: '5.PNG',
        price: 32000
    },
    
    {
        id: 6,
        name: 'Pizza Napolitana',
        image: '6.PNG',
        price: 12000
    },
    {
        id: 7,
        name: 'Raviolis',
        image: '7.PNG',
        price: 32000
    },
    {
        id: 8,
        name: 'Calamares al Ajillo',
        image: '8.PNG',
        price: 60000
    },
    {
        id: 9,
        name: 'Pan Queso al Ajillo',
        image: '9.PNG',
        price: 25000
    },
    {
        id: 10,
        name: 'Pasta Marinera',
        image: '10.PNG',
        price: 30000

    },
];
let listCards  = [];
function initApp(){
    products.forEach((value, key) =>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="image/${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>`;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key){
    if(listCards[key] == null){
        // copy product form list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key)=>{
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="image/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
                listCard.appendChild(newDiv);
        }
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}
function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}


















//////////////////////////////////////////////////////////////////////////////////



closeShopping.addEventListener('click', () => {
    body.classList.remove('active');
    
    // Enviar datos al servidor
    saveOrderToDatabase(listCards);
});

function saveOrderToDatabase(orderData) {
    fetch('php/guardar_pedido.php', {
        method: 'POST',
        body: JSON.stringify(orderData),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Respuesta del servidor:', data);
        // Puedes hacer algo con la respuesta si es necesario
    })
    
}
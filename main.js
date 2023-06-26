// Selectors
const search = document.getElementById('search');
const searchBTN = document.getElementById('search-btn');
// Category container
const cat = document.getElementsByClassName('cat')[0];
// Products container
const prodsContainer = document.getElementsByClassName('prods-container')[0];
// The welcome banner
const welcomeCont = document.getElementsByClassName('welcome-cont')[0];
// Results container
const results = document.getElementById('results');
const categoryName = document.getElementById('category-name');
// The static products seen on page load
const staticProds = document.getElementsByClassName('static-prods')[0];
// Close button for the "add item" form
const addPopupCloseBtn = document.getElementsByClassName('close')[0];
// Add item container
const addPopupCont = document.getElementsByClassName('form-cont')[0];
// Button to add categories/products
const addBtn = document.getElementById('add-btn');
// FOr form messages
const msgPlaceholder = document.getElementById('msg-placeholder');
// Product img label
const prodImgLabel = document.getElementById('prodImgLabel');

// FOrm 
const formCatName = document.getElementById('catName')
const formProdName = document.getElementById('prodName')
const formProdImg = document.getElementById('prodImg')
const prodPrice = document.getElementById('prodPrice')
const formSubmitForm = document.getElementById('submit-form')
// The selected filepath of the product image
let prodImg = '';


// Messages
let msg = '';

// Adding the new item
const addItem = ()=>{
    // set the values needed for the data we sent in the request
    const data = {
        catName: formCatName.value,
        product: {'name': formProdName.value,
        'img': prodImg, 
        'price': prodPrice.value},
    }
    
    // Check to see if all fields are filled
    // If so, send the ajax request
    // otherwise set a message to display to the user so they know what's wrong
    if(formCatName.value && formProdName.value && prodImg
        && prodPrice.value
        ){
            // Adding a new category with products or updating the existing category
            // with the added product
            AddNewCategoryOrProduct(data.catName, data.product)
        }else{
            msg = 'Fill all fields!';
            msgPlaceholder.textContent = msg;
            msgPlaceholder.style.color = 'red';
        }
}

// The button to add the items
// This will add the item with the info provided
formSubmitForm.addEventListener('click', (e)=>{
    e.preventDefault();
    addItem();
})

// When adding a product image
formProdImg.addEventListener('change', (e)=>{
    // get the image name
    const srcName = e.target.files[0].name;
    if(srcName){
        prodImgLabel.textContent = 'You selected (' + srcName + ')';
        prodImgLabel.style.color = '#000';
        // Set the product image to send via ajax request
        prodImg = srcName;
    }
})

// List of categories
let categories = [
    'Mens',
    'Ladies',
    'Kids',
    'Cellphones'
];

// Selected category
var selectedCategories = [];

// Toggles between showing and not showing the "add item form"
const toggleDisplayAddItemForm = () =>{
    addPopupCont.classList.toggle('removeForm')
} 

// Toggling the display of add item form
addBtn.addEventListener('click', (e)=>{
    toggleDisplayAddItemForm();
})
addPopupCloseBtn.addEventListener('click', (e)=>{
    toggleDisplayAddItemForm();
})

// Getting data from php using AJAX
function getProductsInCategory(cat, prod = null) {
    $.ajax({
    url: 'template.php',
    type: 'POST',
    data: { function_name: 'getProductsInCategory', category: cat },
    success: function(response) {
    // Process the response from the server
    var arrayOfObjects = JSON.parse(response);

    // Create UI elements (For the product to display)
    const createEL = (object)=>{
         // Create and style elements
        const prod = document.createElement('div');
        prod.classList.add('prod');
        prod.style.margin = '10px';
        const img = document.createElement('img');
        const h4 = document.createElement('h4');
        const h5 = document.createElement('h5');

        // Add data to the elements
        img.src = object.img;
        h4.innerHTML = object.name;
        h5.innerHTML = 'R' + object.price;
    
        // Display the elements on the ui
        prod.appendChild(img);
        prod.appendChild(h4);
        prod.appendChild(h5);
        prodsContainer.appendChild(prod);
    }

    //   Empty out the products container to add the new results of products
    prodsContainer.innerHTML = '';


    // If a product is searched for in the selected category
    if(prod){
        let object = arrayOfObjects.find(i => i.name.includes(prod))
        createEL(object)
    }else{
        // Display the products
        for (var i = 0; i < arrayOfObjects.length; i++) {
            let object = arrayOfObjects[i];
            createEL(object)
        }
    }
    },
    error: function(xhr, status, error) {
    // Handle any errors that occur during the AJAX request
    console.error(error);
    }
    });
}

// Getting data from php using AJAX
function doesProductExistInCategory(cat, prod) {
    $.ajax({
    url: 'template.php',
    type: 'POST',
    data: { function_name: 'doesProductExistInCategory', category: cat, product: prod },
    success: function(response) {
        // Check if the searched product is available in the selected category
        if(response.includes('true') && selectedCategories.length >= 1){
           getProductsInCategory(selectedCategories[0], prod)
        }

        //   Empty out the products container to add the new results of products
        prodsContainer.innerHTML = '';
    },
    error: function(xhr, status, error) {
    // Handle any errors that occur during the AJAX request
    console.error(error);
    }
    });
}

// Getting data from php using AJAX
// Adding a new category with products or updating the existing category
// with the added product
function AddNewCategoryOrProduct(category, prod) {
    $.ajax({
    url: 'template.php',
    type: 'POST',
    data: { function_name: 'AddNewCategoryOrProduct', category: category, product: prod },
    success: function(response) {
        // if the added was added successfully, alert the user by updating
        // the message
        if(response.includes('true')){
            msg = 'New item added!'
            msgPlaceholder.textContent = msg;
            msgPlaceholder.style.color = 'green';
            // Updating the categories array by adding the provided category
            // in the form
            categories.push(category);

            // Create a new element containing category as text content
            categoryElements(category);
        }
    },
    error: function(xhr, status, error) {
    // Handle any errors that occur during the AJAX request
    console.error(error);
    }
    });
}

// Getting data from php using AJAX
// Get the dynamic categories
function getCategories() {
    $.ajax({
    url: 'template.php',
    type: 'POST',
    // Data to be used in PHP
    data: { function_name: 'getCategories'},
    success: function(response) {
        console.log('Res:', JSON.parse(response));
        const res = JSON.parse(response)

        // Looping through all categories found to display them
        res.forEach((i)=>{
            if(categories[i] !== i){
                // Creating the category elements to display
                categoryElements(i);
            }
        });
    },
    error: function(xhr, status, error) {
    // Handle any errors that occur during the AJAX request
    console.error(error);
    }
    });
};
getCategories();

function categoryElements(category){
    // Create a new element containing category as text content
    const h3 = document.createElement('h3');
    h3.classList.add('name');
    h3.setAttribute('id', 'category-name')
    h3.textContent = category;

    // When clicking a category
    h3.addEventListener('click', (e)=>{
        getProductsInCategory(e.target.textContent);
        selectedCategories[0] = e.target.textContent;

        // Remove the "selected" class from all category elements
        for(let y =0; y < cat.children.length; y++){
            cat.children[y].classList.remove('selected')
        }

        // Add the "selected" class to a selected category
        // to dinstinguish it from others
        e.target.classList.add('selected')

        results.style.color = '#777';
        results.innerHTML = `Results for ${e.target.textContent}`;
        welcomeCont.style.display = 'none';
        staticProds.style.display = 'none';
    })

    cat.appendChild(h3);
}


// Search By Category
searchBTN.addEventListener('click', (e)=>{
    // Value from the search textbox
    const val = search.value;
    // Make sure there's something in the textbox
    if(val.trim()){
        // If a category is selected, get the results of the search
        if(selectedCategories.length >= 1){
            results.style.color = '#777';
            doesProductExistInCategory(selectedCategories[0], val)
            results.innerHTML = `Results for "${val}" in ${selectedCategories[0]}`;
            welcomeCont.style.display = 'none';
            staticProds.style.display = 'none';
        }
        // If no category is selected, tell the user to select one
        else{
            results.style.color = 'red';
            results.innerHTML = `Select a category first`;
            welcomeCont.style.display = 'none';
            staticProds.style.display = 'none';
        }
    }
})
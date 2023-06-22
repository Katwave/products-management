// Selectors
const search = document.getElementById('search');
const searchBTN = document.getElementById('search-btn');
const cat = document.getElementsByClassName('cat')[0];
const prodsContainer = document.getElementsByClassName('prods-container')[0];
const welcomeCont = document.getElementsByClassName('welcome-cont')[0];
const results = document.getElementById('results');
const categoryName = document.getElementById('category-name');
const staticProds = document.getElementsByClassName('static-prods')[0];

// List of categories
const categories = [
    'Mens',
    'Ladies',
    'Kids',
    'Women',
    'Accesories',
    'Health',
    'Computers',
    'Cellphones',
]
// Selected category
var selectedCategories = [];

// Getting data from php using AJAX
function getProductsInCategory(cat, prod = null) {
    $.ajax({
    url: 'template.php',
    type: 'POST',
    data: { function_name: 'getProductsInCategory', category: cat },
    success: function(response) {
    // Process the response from the server
    var arrayOfObjects = JSON.parse(response);

    // Create UI elements
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

// Search By Category
searchBTN.addEventListener('click', (e)=>{
    const val = search.value;
    if(val.trim()){
        if(selectedCategories.length >= 1){
            results.style.color = '#777';
            doesProductExistInCategory(selectedCategories[0], val)
            results.innerHTML = `Results for "${val}" in ${selectedCategories[0]}`;
            welcomeCont.style.display = 'none';
            staticProds.style.display = 'none';
        }else{
            results.style.color = 'red';
            results.innerHTML = `Select a category first`;
            welcomeCont.style.display = 'none';
            staticProds.style.display = 'none';
        }
    }
})

// Display the categories
categories.forEach((i)=>{
    // Create a new element containing category as text content
    const h3 = document.createElement('h3');
    h3.classList.add('name');
    h3.setAttribute('id', 'category-name')
    h3.textContent = i;

    // When clicking a category
    h3.addEventListener('click', (e)=>{
        getProductsInCategory(e.target.textContent);
        selectedCategories[0] = e.target.textContent;

        for(let y =0; y < cat.children.length; y++){
            cat.children[y].classList.remove('selected')
        }

        e.target.classList.add('selected')

        results.style.color = '#777';
        results.innerHTML = `Results for ${e.target.textContent}`;
        welcomeCont.style.display = 'none';
        staticProds.style.display = 'none';
    })

    cat.appendChild(h3);
})
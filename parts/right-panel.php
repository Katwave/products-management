<div class="right-panel">
    <!-- Searching for products in a category -->
    <div class="search">
        <input type="text" placeholder="Search product" id="search"/>
        <p id="search-btn"><i class="fa-solid fa-arrow-right"></i></p>
    </div>
    <div class="results">
        <!-- Results based on search -->
        <h3 id="results"></h3>
        <div class="prods-container"></div>

        <div class="welcome-cont">
            <img src="./img/banner.jpg" alt="woman">
        </div>

        <!-- Static products -->
        <div class="static-prods">
            <h3>New Products</h3>
            <div class="prods">
                <div class="prod">
                    <img src="./img/kids-pants.jpg" alt="product">
                    <h4>Kids Pants</h4>
                    <h5>R399.00</h5>
                </div>
                <div class="prod">
                    <img src="./img/kids-shoes.jpg" alt="product">
                    <h4>Kids Shoes</h4>
                    <h5>R799.00</h5>
                </div>
                <div class="prod">
                    <img src="./img/kids-shoes-2.jpg" alt="product">
                    <h4>Kids Sneakers</h4>
                    <h5>R599.00</h5>
                </div>
                <div class="prod">
                    <img src="./img/kids-toy-car.jpg" alt="product">
                    <h4>Kids Toy Taxi</h4>
                    <h5>R399.00</h5>
                </div>
                <div class="prod">
                    <img src="./img/kids-toy-car-2.jpg" alt="product">
                    <h4>Kids Toy Car</h4>
                    <h5>R599.00</h5>
                </div>
                <div class="prod">
                    <img src="./img/men-red-shirt.jpg" alt="product">
                    <h4>Men Red Shirt</h4>
                    <h5>R129.00</h5>
                </div>
                <div class="prod">
                    <img src="./img/men-red-tshirt.jpg" alt="product">
                    <h4>Men Red T-Shirt</h4>
                    <h5>R109.00</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Form for adding new items  -->
    <div class="form-cont removeForm">
        <form>
            <div class="close">X</div>
            <p id="msg-placeholder"></p>
            <input type="text" placeholder="Category Name" id="catName">
            <input type="text" placeholder="Product Name" id="prodName">
            <label for="prodImg" id="prodImgLabel">Upload Product Image <i class="fa-solid fa-upload"></i></label>
            <input type="file" id="prodImg">
            <input type="number" placeholder="Product Price" id="prodPrice">
            <button id="submit-form">Add</button>
        </form>
    </div>

    <button id="add-btn">+</button>
</div>
<?php
    
    /**
     * Feel free to change any code.
     *
     * Please complete the following assessment.
     *
     * In the file below you will see an Object that has categories and products inside it.
     *
     * There are two functions we would like implemented:
     * getProductsInCategory() - This function needs to return a product inside a category that we can specify.
     * doesProductExistInCategory() - This function needs to let us know if a product exists in a category that we chose.
     *
     * Hints:
     * Please make sure that the Object is extendable and other products and categories can be added and the functions will work.
     * Big-O notation.
     * Using DRY and SOLID principles.
     * You can ask for help or more information at anytime.
     * You can use any resources you like.
     * The frontend is important.
     *
     * Bonus points:
     * - PHP Unit Testing.
     * - Frontend Display/Layout/Template to process data.
     * - Git repository to track the code changes.
     *
     * You will be evaluated on the following:
     * - Code structure, readability, understandably, maintainability and layout.
     * - Code standards used.
     * - Completion of the objective.
     * - Performance of the completed structure.
     * - Frontend Display/Layout/Template to process data using Javascript and CSS.
     */
    
    class Product {
        public string $name;
        public string $img;
        public string $price;
        
        public function __construct(string $name, string $img, string $price) {
            $this->name = $name;
            $this->img = $img;
            $this->price = $price;
        }
    }
    
    class Category {
        public string $name;
        public array $products;
        
        public function __construct(string $name, array $products) {
            $this->name     = $name;
            $this->products = $products;
        }
    }

    // Interface for demonstrating extendability of the data
    interface DataManipulation{
        function addData($catName, $prod);
    }

    // The class consisting of data to use
    class MainData implements DataManipulation{
        public array $mainData;
        public function __construct() {
            $this->mainData = [];
        }

        // For adding new data
        // O(n)
        function addData($catName, $prod){
            // Check if the category name has been passed in
            if(isset($catName) && isset($catName)){
                // Loop through the existing data and check if the passed in category
                // already exists in the data
                foreach($this->mainData as $cat){
                    // if the category exists, then add the passed in product to that category
                    if($cat->name === $catName){
                        $cat->products[] = new Product($prod['name'], $prod['img'], $prod['price']);
                        return true;
                    }
                }

                // If its a new category then add a new category then create a new product with
                // the passed in product info
                $this->mainData[] = new Category($catName, [new Product($prod['name'], $prod['img'], $prod['price'])]);
                return true;
            }else{
                return false;
            }
        }
    }

    // Adding some test data

    $testData = new MainData();
    $testData->addData('Mens', ['name'=> 'Red Hoodie', 'img' => './img/men-red-shirt.jpg', 'price' => '559.00']);
    $testData->addData('Mens', ['name'=> 'Red T-Shirt', 'img' => './img/men-red-tshirt.jpg', 'price' => '199.00']);
    $testData->addData('Ladies', ['name'=> 'Green Shirt', 'img' => './img/women-green-shirt.jpg', 'price' => '129.00']);
    $testData->addData('Kids', ['name'=> 'Sneakers', 'img' => './img/kids-shoes-2.jpg', 'price' => '677.00']);
    $testData->addData('Kids', ['name'=> 'Sneakers', 'img' => './img/kids-toy-car.jpg', 'price' => '399.00']);
    $testData->addData('Cellphones', ['name'=> 'Brown Phone Case', 'img' => './img/phone-case.jpg', 'price' => '189.00']);
    $testData->addData('Cellphones', ['name'=> 'Blue Phone Case', 'img' => './img/phone-case-2.jpg', 'price' => '169.00']);
        
    /**
     * Return a product inside a category.
     *
     * @param string $category
     *
     * @return array
     */

    //  For accessing products in a specific category
    // O(n)
    function getProductsInCategory(string $category): array {
        // Implement me
        // Globalise the data variable to use it in the function
        global $testData;
        // Initialise results
        $res = [];

        // Loop through the array of objects (Categories)
        foreach ($testData->mainData as $cat) {
            // Check if the 'name' (Category name) property of the current object is equal to the
            // passed in category
            if ($cat->name === $category) {
                // Set the results array to the products of the found category
                $res = $cat->products;
            }
        }
        return $res;
    }
    
    // Check if product exists in the given category
    // O(n)
    function doesProductExistInCategory(string $category, string $product): bool {
        // Implement me

        // Globalise the data variable to use in the funtion
        global $testData;

        // looping through the data to go through all categories
        foreach ($testData->mainData as $cat) { // O(n)
            // Check to see if the category name is the same as the passed in category
            if ($cat->name === $category) { // O(1)
                // Returns a list of all product names
                $productNames = array_column($cat->products, 'name'); // O(n)
                // Checks to see if the passed product exists in the above
                // array of productNames (if so returns true, else false)
                return in_array($product, $productNames); // O(n)
            }
        }
        
        return false;
    }

    // Get all categories
    // O(n)
    function getCategories(){
         // Globalise the data variable to use in the funtion
        global $testData;

        // Get all categories
        $catNames = array_column($testData->mainData, 'name');
        
        return $catNames;
    }

    // Data to send over AJAX requests
    // Check if 'function_name' is in the request
    if (isset($_POST['function_name'])) {
        // Assign the function_name in the request to a variable
        $functionName = $_POST['function_name'];
      
        // Check if the function_name value in the request
        // is set to the string "getProductsInCategory" or "doesProductExistInCategory"
        // in order to build the right logic
        if ($functionName === 'getProductsInCategory') {
            $category = isset($_POST['category']) ? $_POST['category'] : ''; // Get the category parameter
            
            // calling the getProductsInCategory and passing the category set in the request
            $result = getProductsInCategory($category);

            // Sending Json encoded string to use in the JS file
            echo json_encode($result);
        }
        // Check to see if a product exists in a category
        else if($functionName === 'doesProductExistInCategory') {
            $category = isset($_POST['category']) ? $_POST['category'] : ''; // Get the category parameter
            $product = isset($_POST['product']) ? $_POST['product'] : ''; // Get the product parameter
            
            // Same logic as the above if statement
            // with addition to a product which is set in the request
            // as a string
            $result = doesProductExistInCategory($category, $product);
            echo json_encode($result);
        }
        // Get all categories created
        else if($functionName === 'getCategories') {            
            $result = getCategories();
            echo json_encode($result);
        }
        // Adding new items
        else if($functionName === 'AddNewCategoryOrProduct') {   
            $catName = isset($_POST['catName']) ? $_POST['catName'] : ''; // Get the category parameter
            $product = isset($_POST['product']) ? $_POST['product'] : ''; // Get the product parameter
         
            // Adding new category or product
            $result = $testData->addData($catName, $product);
            echo json_encode($result);
        }
      }

?>

<?php
// Console logging (To see objects/arrays in browser)
function console_log($output, $hasScriptTags = true) {
    $code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($hasScriptTags) {
        $code = '<script>' . $code . '</script>';
    }
    echo $code;
}
?>
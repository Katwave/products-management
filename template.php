<?php
    
    /**
     * Feel free to change any code.
     *
     * Please complete the following assessment.
     *
     * In the file below you will see an Object $data that has categories and products inside it.
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
        
        public function __construct(string $name) {
            $this->name = $name;
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
    
    $data = [
        new Category('Mens', [new Product('Blue Shirt'), new Product('Red T-Shirt')]),
        new Category('Ladies', [new Product('Red Shirt'), new Product('Pink T-Shirt')]),
        new Category('Kids', [new Product('Sneakers'), new Product('Toy car')]),
    ];
    
    /**
     * Return a product inside a category.
     *
     * @param string $category
     *
     * @return array
     */
    function getProductsInCategory(string $category): array {
        // Implement me
        // Globalise thw data variable to use it in the function
        global $data;
        // Initialise results
        $res = [];

        // Loop through the array of objects
        foreach ($data as $cat) {
            // Check if the 'name' (Category name) property of the current object is equal to the search value
            if ($cat->name === $category) {
                // Set the results array to the products of the found category
                $res = $cat->products;
            }
        }
        return $res;
    }
    
    function doesProductExistInCategory(string $category, string $product): bool {
        // Implement me
        global $data;
        foreach ($data as $cat) {
            if ($cat->name === $category) {
                // Returns a list of all product names
                $productNames = array_column($cat->products, 'name');
                // Checks to see if the passed product exists in the above
                // array of productNames (if so returns true, else false)
                return in_array($product, $productNames);
            }
        }
        
        return false;
    }

?>

<!-- Console logging (To see objects/arrays in browser) -->
<?php
function console_log($output, $hasScriptTags = true) {
    $code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($hasScriptTags) {
        $code = '<script>' . $code . '</script>';
    }
    echo $code;
}
?>
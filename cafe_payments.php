<?php

//TEST CASES
//======================================================
//TEST CASE 1: Invalid computer usage
//Input: -1 hour
//Expected:
//An error message indicating that usage time
//must be greater than zero.
//Result: PASS if the invalid input is rejected.

//TEST CASE 3: Valid black-and-white printing
//Input: 10 pages, style 1
//Expected:
//10 * 150 = 1,500 UGX
//Result: PASS if the customer pays 1,500 UGX.

//TEST CASE 4: Valid coloured printing
//Input: 10 pages, style 2
//Expected:
//Initial amount: 8,000 UGX
//Discount: 1,600 UGX
//Customer pays: 6,400 UGX
//Result: PASS if the customer pays 6,400 UGX.

//TEST CASE 5: Invalid printing page count
//Input: 0 pages, style 1
//Expected:
//An error message indicating that the page count
//and/or printing style is invalid.
//Result: PASS if the invalid input is rejected.

//TEST CASE 6: Boundary test for printing
//Input: 5,000 pages, style 1
//Expected:
//5,000 * 150 = 750,000 UGX
//Result: PASS if the system accepts the maximum
//permitted page count and calculates the bill correctly.
//======================================================




// Computer usage rates and discount.
const COMPUTER_USE_HOURLY_RATE= 1000;
const COMPUTER_USE_DISCOUNT = 0.10;  // 10%


//This function calculates the computer usage bill based on time used.
function computer_bill(float $total_time):int{
    $final_amount = null;

    // Reject zero or negative usage time.
    if ($total_time <=0) {
        echo "time must be greater than 1";
    }else{
        $total_amount = $total_time * COMPUTER_USE_HOURLY_RATE;
        $total_discount = $total_amount * COMPUTER_USE_DISCOUNT;
        $final_amount = $total_amount - $total_discount;

        // Format amounts with thousands separators.
        $formated_total_amount = number_format($total_amount);
        $formated_total_discount = number_format($total_discount);
        $formated_final_amount = number_format($final_amount);
        echo "Initial amount:  {$formated_total_amount} UGX  Discount: {$formated_total_discount} Cutomer pays: {$formated_final_amount} UGX \n";
    }
    return $final_amount;
}



// Printing rates, discount, and available styles.
const PER_PAGE_COST_BW = 150;
const PER_PAGE_COST_COLOR = 800;
const PRINT_DISCOUNT_COLOR = 0.2;  // 20%
const PRINT_STYLES = ["black and white", "colored"];

//This function calculates the total amount of money the customer pays for printing either black and white or in color.
function printing_bill(int $pages, int $style): ?int {

    // Validate the page count and selected printing style
    if(($pages <=0 || $pages > 5000)  || ($style <= 0 || $style > count(PRINT_STYLES))){
        echo "please enter a valid number of pages and choose a valid style";
        return null;
    }

    $total = null;

    switch ($style){
        case 1:
            $total = $pages * PER_PAGE_COST_BW;
            break;
        case 2:
            // Apply the discount to coloured printing.
            $initial_total = $pages * PER_PAGE_COST_COLOR;
            $total = $initial_total - ($initial_total * PRINT_DISCOUNT_COLOR);
            break;
    }

    // Format and display the final bill.
    $formated_total = number_format($total);
    echo "Cutomer pays: {$formated_total} UGX\n";
    return $total;

}



// Available billing services.
const SERVICES = ["Computer use", "Printing"];

while(True) {
    echo "============================================================== \n";
    echo "NEW BILL \n";
    echo "============================================================== \n";

    foreach (SERVICES as $index => $service){
        $service_number = $index+1;
        echo "{$service_number}. {$service} \n";
    }

    $selected_service = readline("What would you like to bill? ");

    // Accept numeric choices or the exit command.
    if(!is_numeric($selected_service) && $selected_service !== "exit"){
        echo "Please enter a valid choice. \n\n";
        continue;
    }

    // Exit the application when requested.
    if($selected_service === "exit"){
        echo "Good bye";
        return;
    }else if($selected_service <=0 || $selected_service >2){
        echo "Enter a correct choice \n\n";
    }else{
        // Route the request to the selected billing servicee
        switch ($selected_service) {
            case 1:
                $time_used = readline("Enter the total time: ");
                computer_bill($time_used);
                break;
            case 2:
                $no_pages = readline("Enter the total number of pages: ");
                foreach (PRINT_STYLES as $index => $style) {
                    $style_number = $index + 1;
                    echo "{$style_number}. {$style} \n";
                }
                $print_style = readline("Choose a print style ");
                printing_bill($no_pages, $print_style);
                break;
        }
        // Separate billing sessions visually.
        echo "\n\n";
    }

}

?>
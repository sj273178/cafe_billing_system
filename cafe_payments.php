<?php

    const COMPUTER_USE_HOURLY_RATE= 1000;
    const COMPUTER_USE_DISCOUNT = 0.10;  // 10%


    //This function calculates the total amount of money based on the time the user used the computer.
    function computer_bill(float $total_time):int{
       $final_amount = null;
       // First check whether time is greater than 0
       if ($total_time <=0) {
           echo "time must be greater than 1";
       }else{
           $total_amount = $total_time * COMPUTER_USE_HOURLY_RATE;
           $total_discount = $total_amount * COMPUTER_USE_DISCOUNT;
           $final_amount = $total_amount - $total_discount;
           $formated_total_amount = number_format($total_amount);
           $formated_total_discount = number_format($total_discount);
           $formated_final_amount = number_format($final_amount);
           echo "Initial amount:  {$formated_total_amount} UGX  Dicount: {$formated_total_discount} Cutomer pays: {$formated_final_amount} UGX \n";
       }
       return $final_amount;
   }




   const PER_PAGE_COST_BW = 150;
   const PER_PAGE_COST_COLOR = 800;
   const PRINT_DISCOUNT_COLOR = 0.2;  // 20%
   const PRINT_STYLES = ["black and white", "colored"];

//This function calculates the total amount of money the customer pays for printing either black and white or in color.
   function printing_bill(int $pages, int $color): ?int {
       if(($pages <=0 || $pages >5000)  || ($color <=0 || $color > count(PRINT_STYLES))){
           echo "please enter a valid number of pages and choose a valid style";
           return null;
       }

       $total = null;
       switch ($color){
           case 1:
               $total = $pages * PER_PAGE_COST_BW;
               break;
           case 2:
               $initial_total = $pages * PER_PAGE_COST_COLOR;
               $total = $initial_total - ($initial_total * PRINT_DISCOUNT_COLOR);
               break;
       }

            $formated_total = number_format($total);
           echo "Cutomer pays: {$formated_total} UGX\n";
           return $total;

   }



   const SERVICES = ["Computer use", "Printing"];

    while(True) {
        echo "============================================================== \n";
        echo "NEW BILL \n";
        echo "============================================================== \n";

        foreach (SERVICES as $index => $service){
            $service_number = $index+1;
            echo "{$service_number}. {$service} \n";
        }
        $selected_service = readline("What would you like to bill?");
        if($selected_service === "exit"){
            echo "Good bye";
            return;
        }else if($selected_service <=0 || $selected_service >2){
            echo "Enter a correct choice \n\n";
        }else{
            switch ($selected_service) {
                case 1:
                    $time_used = readline("Enter the total time:");
                    computer_bill($time_used);
                    break;
                case 2:
                    $no_pages = readline("Enter the total number of pages");
                    foreach (PRINT_STYLES as $index => $style) {
                        $style_number = $index + 1;
                        echo "{$style_number}. {$style} \n";
                    }
                    $print_style = readline("Choose a print style ");
                    printing_bill($no_pages, $print_style);
                    break;
            }
        }


    }



?>








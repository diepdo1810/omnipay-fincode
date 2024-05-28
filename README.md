# Credit card payment process through the Fincode system (PHP SDK) 

<img src="https://fincode.egoism.jp/wp-content/uploads/2022/05/paymentd_card_js.png?_gl=1*1oqgy7w*_ga*MjQxOTI4NTg2LjE3MTUzMTY0OTE.*_ga_8Y6Q0J470G*MTcxNjg2Nzc0OS4yNS4xLjE3MTY4NzIyNjguNjAuMC4w">


## Overview
1. Customers send payment information:
- Customers access the merchant's website or application and proceed with the payment process.
- Customers enter payment-related information such as products/services, payment amount, etc.
 
2. Affiliate partners generate payment URLs via Fincode's API:
- Merchant uses Fincode's API to generate a payment URL.
- Fincode returns a payment URL to the merchant.

3. Merchant sends payment URL to customer:
- Merchant forwards the payment URL from Fincode to the customer.
- Customers click the URL to redirect to Fincode's payment page.

4. Merchant sends payment URL to customer:

- On Fincode's payment page, customers enter their credit or debit card information (card number, expiration date, CVV, etc.).

5. Merchant sends payment URL to customer:

- Fincode sends an authorization request to the card company to check the card's validity and ability to pay.
- The card company checks the card's information and payment ability.

6. Merchant sends payment URL to customer:

- The card company returns the result of the authorization process (success or failure) to Fincode.

7. Merchant sends payment URL to customer:

- Fincode sends notification of authorization results (success or failure) to the merchant.
- Merchant receives notification and takes next steps based on the results.

8. Merchant sends payment URL to customer:

- Merchant displays payment result notification to customers on its website or application.
- If payment is successful, the customer receives payment confirmation and can continue with the purchased service/product.
- If payment fails, the customer will receive an error message and can try again or use another payment method.

## TEST
- vendor/bin/phpunit tests/Feature/FincodeTest.php

## THANK YOU
- Thank you for reading this document. If you have any questions, please contact us. And contribute to the development of this project.

## CONTACT
- Email: diepchiaser@gmail.com
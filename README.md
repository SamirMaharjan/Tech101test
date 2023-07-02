#php version 7.4
#laravel version 8
#Starter Guide.
 1 Create a database named tech101 or change database at .env file accodingly.
 2 open the project in terminal and hit php artisan migrate
 3 once database is migrated, password for login is password and for email we can pick any one from db

What You asked for:
1 A reward point system that gives point to user on completion of a sales_order
    - First login
    - add products to cart
    - you can edit cart items on my cart
    - Once finalized, place your order by cliking make purchase
    - now you can check for your order status at my order page
    - you can cancel or complete the order
    - once you complete the order, your reward points will appear in dropdown of the profile name at nav bar

2 SINGLE query to retrieve the total order and sales amount of all the orders. Your output should display           Number_Of_Order, Total_Sales_Amount
Ans: 
    SELECT COUNT(Orders.Order_ID) AS Number_Of_Order, SUM(IF(Orders.Sales_Type = 'Normal', Orders_Products.Normal_Price, Orders_Products.Promotion_Price)) AS Total_Sales_Amount
    FROM Orders
    JOIN Orders_Products ON Orders.Order_ID = Orders_Products.Order_ID;

3 Sorry but I was not able to understand the question.

4 You have been tasked with building an API endpoint in Laravel that retrieves a list of products. The endpoint should support pagination, filtering by category, and sorting by price. How would you design and implement this API endpoint? Explain the steps you would take and discuss the considerations you would keep in mind during the development process.
Ans :
    1 http://127.0.0.1:8000/api/get-items
    2 http://127.0.0.1:8000/api/get-items/filter
        for the filter we have set content-type at application/x-www-form-urlencoded
        and in body send two parameter or any: category_id and sort(1 for desc and others for asc) 

5 Determine the number of words in each sentence where the word is a sequence of letters, ('a-z', 'A-Z'). Words may contain one or more of these (.) - period, (,) - comma, (?) - question mark, (!) - exclamation point. Separation of words will be by one or more white spaces. Two words can be joined into one by hyphen while the other punctuation marks should be stripped.

Ans: We can got Count word page to test that functionality.
    function code is placed inside HomeController


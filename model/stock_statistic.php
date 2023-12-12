<?php

function getTotalAmountToday()
{
    try {
        $sql = "SELECT 
                    IFNULL(SUM(total_amount), 0) AS total_amount_today
                FROM 
                    transactions
                WHERE 
                    DATE(transaction_date) = CURDATE()
                    AND transaction_type_id = 2
                    AND status_id = 1;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getCountTypeTransaction()
{
    try {
        $sql = "SELECT 
                    COUNT(*) AS transaction_count
                FROM 
                    transactions
                GROUP BY 
                    transaction_type_id;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function get5BestSellingProduct()
{
    try {
        $sql = "SELECT 
                    p.id,
                    p.name,
                    p.price,
                    SUM(t.total_amount) AS total_sales
                FROM 
                    transactions t
                JOIN 
                    products p ON t.product_id = p.id
                WHERE 
                    t.transaction_type_id = 1
                GROUP BY 
                    p.id, p.name
                ORDER BY 
                    total_sales DESC
                LIMIT 5;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getTotalRevenue()
{
    try {
        $sql = "SELECT 
                    SUM(total_amount) AS total_revenue
                FROM 
                    transactions
                WHERE 
                    transaction_type_id = 2 AND status_id = 1;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getTotalLoss()
{
    try {
        $sql = "SELECT 
                    SUM(total_amount) AS total_loss
                FROM 
                    transactions
                WHERE 
                    transaction_type_id = 1 AND status_id = 1;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getAllProduct()
{
    try {
        $sql = "SELECT COUNT(*) AS total_products FROM products;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getQuantityTransaction()
{
    try {
        $sql = "SELECT 
                    SUM(CASE WHEN status_id = 1 THEN 1 ELSE 0 END) AS successful_transactions,
                    SUM(CASE WHEN status_id IN (2, 3) THEN 1 ELSE 0 END) AS failed_or_cancelled_transactions,
                    COUNT(*) AS total_transactions
                FROM transactions;";
        return pdo_query_one($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getCompareProductsByMonth()
{
    try {
        $sql = "SELECT 
                    products.name AS product_name,
                    COUNT(transactions.id) AS total_transactions,
                    SUM(transactions.quantity_changed) AS total_quantity_sold,
                    SUM(transactions.total_amount) AS total_sales,
                    AVG(products.price) AS average_price
                FROM 
                    transactions
                JOIN 
                    products ON transactions.product_id = products.id
                WHERE 
                    transactions.status_id = 1
                    AND MONTH(transactions.transaction_date) = MONTH(CURDATE())
                GROUP BY 
                    products.name
                LIMIT 7;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function get5UserActivityStatistics()
{
    try {
        $sql = "SELECT 
                    accounts.id AS user_id,
                    accounts.fullname,
                    COUNT(transactions.id) AS total_transactions,
                    SUM(transactions.total_amount) AS total_revenue,
                    COUNT(DISTINCT products.id) AS total_managed_products
                FROM accounts
                LEFT JOIN transactions ON accounts.id = transactions.account_id
                LEFT JOIN products ON transactions.product_id = products.id
                GROUP BY accounts.id, accounts.fullname LIMIT 5;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getNumberSellerActive()
{
    try {
        $sql = "SELECT COUNT(DISTINCT id) AS active_users
                FROM accounts
                WHERE status = 'Đang làm việc' AND position_id = 1;";
        return pdo_query_one($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getNumberShipmentsInTransit()
{
    try {
        $sql = "SELECT COUNT(*) AS total_shipments_in_transit
                FROM batches
                JOIN batch_statuses ON batches.status_id = batch_statuses.id
                WHERE batch_statuses.id = 3;";
        return pdo_query_one($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

?>
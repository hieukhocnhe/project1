<?php
$permissions = [
    'Staff' => [
        'dashboard',
        'suppliers',
        'storageAreas',
        'storageAreaDetail',
        'batches',
        'batcheDetail',
        'addBatche',
        'editBatche',
        'products',
        'productDetail',
        'addProduct',
        'editProduct',
        'transactions',
        'productTransactions',
        'transactionDetail',
        'addTransaction',
        'editTransaction',
        'inventory',
        'inventories',
        'profile',
        'change_password_submit'
    ],
    'Manager' => [
        'dashboard',
        'accounts',
        'addAccount',
        'editAccount',
        'suppliers',
        'addSupplier',
        'editSupplier',
        'delSupplier',
        'storageAreas',
        'storageAreaDetail',
        'addStorageArea',
        'editStorageArea',
        'delStorageArea',
        'batches',
        'batcheDetail',
        'addBatche',
        'editBatche',
        'products',
        'productDetail',
        'addProduct',
        'editProduct',
        'transactions',
        'productTransactions',
        'transactionDetail',
        'addTransaction',
        'editTransaction',
        'inventory',
        'inventories',
        'profile',
        'change_password_submit'
    ]
];

function getPermissionForUser($user_id)
{
    global $permissions;
    $position = getPositionByUserId($user_id)['position_name'];
    return $permissions[$position];

}

function hasPermission($user_id, $action)
{
    if (in_array($action, getPermissionForUser($user_id))) {
        return true;
    } else {
        return false;
    }
}

?>
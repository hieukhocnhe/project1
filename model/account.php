<?php
function hashPassword($password)
{
    try {
        return password_hash($password, PASSWORD_DEFAULT);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
;

function verifyPassword($password, $hashedPassword)
{
    try {
        return password_verify($password, $hashedPassword);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getAllAccounts()
{
    try {
        $sql = "SELECT a.id AS id, a.username AS username, a.fullname AS fullname, a.avatar AS avatar,
        a.email AS email, a.address AS address, a.tel AS tel, a.bio AS bio, a.status AS status,
        a.position_id AS position_id, p.position_name AS position_name
        FROM accounts a INNER JOIN positions p ON a.position_id = p.id ORDER BY a.id ASC;";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getAccountById($id)
{
    try {
        $sql = "SELECT * FROM
        accounts
        WHERE
        id = $id;";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


function getAccountByUsername($username)
{
    try {
        $sql = "SELECT * FROM
        accounts
        WHERE
        username = '$username';";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function login($username, $password)
{
    try {
        $user = getAccountByUsername($username);
        if ($user) {
            if (verifyPassword($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function signup($email, $username, $password)
{
    try {
        $hashedPassword = hashPassword($password);
        $sql = "INSERT INTO
        accounts (email, username, password)
        VALUES
        ('$email', '$username', '$hashedPassword');";
        pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function changePassword($id, $old_password, $new_password)
{
    try {
        $user = getAccountById($id);
        if ($user) {
            if (verifyPassword($old_password, $user["password"])) {
                $hashedPassword = hashPassword($new_password);
                $sql = "UPDATE accounts
                        SET password = '$hashedPassword'
                        WHERE id = $id";
                pdo_execute($sql);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


function insertAccount($username, $password, $fullname, $avatar, $email, $address, $tel, $bio, $position_id)
{
    try {
        $sql = "INSERT INTO accounts (username, password, fullname, avatar, email, address, tel, bio, position_id) 
            VALUES ('$username', '$password', '$fullname', '$avatar', '$email', '$address', '$tel', '$bio', '$position_id');";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function editAccount($id, $username, $fullname, $avatar, $email, $tel, $address, $bio, $status_text, $position_id)
{
    try {
        $sql = "UPDATE accounts
        SET
        username = '$username',
        fullname = '$fullname',
        avatar = '$avatar',
        email = '$email',
        address = '$address',
        tel = '$tel',
        bio = '$bio',
        status = '$status_text',
        position_id = '$position_id'
        WHERE id = $id;";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getPositions()
{
    try {
        $sql = "SELECT * FROM positions";
        return pdo_query($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
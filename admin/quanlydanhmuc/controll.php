<?php
include("../../config/config.php");

if (isset($_POST['btnAdd'])) {
    $tenDanhmuc = $_POST['tenDanhmuc'];

    if (!empty($tenDanhmuc)) {
        try {
            $sql_add = "INSERT INTO tbl_categories (name) VALUES (:name)";
            $stmt = $pdo->prepare($sql_add);
            $stmt->bindParam(':name', $tenDanhmuc, PDO::PARAM_STR);
            if ($stmt->execute()) {
                header('Location:../../index.php?action=quanlydanhmuc&query=them');
                exit();
            } else {
                echo "Lỗi: Không thể thêm vào cơ sở dữ liệu!";
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo "Vui lòng nhập tên danh mục!";
    }
} elseif (isset($_POST['btnEdit'])) {
    $tenDanhmuc = $_POST['suaDanhmuc'];
    if (!empty($tenDanhmuc)) {
        try {
            $sql_update = "UPDATE tbl_categories SET name = :name WHERE id_category = :id";
            $stmt = $pdo->prepare($sql_update);
            $stmt->bindParam(':name', $tenDanhmuc, PDO::PARAM_STR);
            $stmt->bindParam(':id', $_GET['idDanhmuc'], PDO::PARAM_INT);
            if ($stmt->execute()) {
                header('Location:../../index.php?action=quanlydanhmuc&query=them');
                exit();
            } else {
                echo "Lỗi: Không thể cập nhật cơ sở dữ liệu!";
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo "Vui lòng nhập tên danh mục!";
    }
} else {
    $id = $_GET['idDanhmuc'];
    try {
        $sql_delete = "DELETE FROM tbl_categories WHERE id_category = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            header('Location:../../index.php?action=quanlydanhmuc&query=them');
            exit();
        } else {
            echo "Lỗi: Không thể xóa danh mục!";
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

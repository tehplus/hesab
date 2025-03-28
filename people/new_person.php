<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کالای جدید - <?php echo SITE_NAME; ?></title>
    
    <!-- فونت‌ها و استایل‌ها -->
    <link href="../assets/css/fontiran.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/products.css">
</head>
<body>
    <!-- نوار ناوبری -->
    <?php include '../includes/navbar.php'; ?>
    
    <!-- محتوای صفحه -->
    <div class="container mt-5">
        <h1 class="mb-4">کالای جدید</h1>
        <!-- فرم ایجاد کالای جدید -->
        <form action="new_product_action.php" method="post">
            <!-- فرم ورود اطلاعات کالا -->
            <div class="mb-3">
                <label for="productName" class="form-label">نام کالا</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">دسته‌بندی</label>
                <select class="form-select" id="productCategory" name="productCategory" required>
                    <option value="category1">دسته‌بندی 1</option>
                    <option value="category2">دسته‌بندی 2</option>
                    <!-- گزینه‌های دیگر -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ایجاد</button>
        </form>
    </div>

    <!-- اسکریپت‌ها -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/products.js"></script>
</body>
</html>
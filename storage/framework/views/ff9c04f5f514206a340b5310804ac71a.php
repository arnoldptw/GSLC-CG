<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Converter</title>
</head>
<body>
    <h1>Upload Gambar</h1>
    <form action="<?php echo e(route('process')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="file" name="image" required>
        <select name="filter" required>
            <option value="grayscale">Grayscale</option>
            <option value="blur">Blur</option>
        </select>
        <button type="submit">Proses</button>
    </form>
</body>
</html>
<?php /**PATH C:\Users\arnol\OneDrive\Documents\GSLC CompGraph\project\resources\views/upload.blade.php ENDPATH**/ ?>
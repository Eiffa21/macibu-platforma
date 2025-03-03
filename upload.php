
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Material</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Upload Material</h2>
    <form action="upload_process.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" name="category" id="category" class="form-control">
      </div>
      <div class="mb-3">
        <label for="material_file" class="form-label">Choose File</label>
        <input type="file" name="material_file" id="material_file" class="form-control" required>
      </div>
      <button type="submit" name="upload" class="btn btn-primary">Upload</button>
    </form>
  </div>
</body>
</html>

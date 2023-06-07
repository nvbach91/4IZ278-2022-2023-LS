<?php include 'elements/header.php' ?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Edit Post</h2>
      <div class="alert-message error">
        <p>This is an error message</p>
      </div>
      <form action="" enctype="multipart/form-data">
        <input type="text" placeholder="Title">
        <select >
          <option value="1">Category 1</option>
        </select>        
        <textarea rows="10" placeholder="Body"></textarea>
        <div class="form-control inline">
          <input type="checkbox" id="is_featured" checked>
          <label for="is_featured">Featured</label>
        </div>
        <div class="form-control">
          <label for="thumbnail">Add Thumbnail</label>
          <input type="file" if="thumbnail">
        </div>
        <button type="submit" class="button">Update</button>      
      </form>
    </div>
  </section>
<?php include '../elements/footer.php' ?>
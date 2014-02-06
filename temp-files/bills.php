<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Upload Date</th>
            <th>Bill name</th>
            <th>Bill Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>cell is row 0, column 0</td>
            <td>cell is row 0, column 1</td>
            <td>cell is row 0, column 2</td>
          </tr>
          <tr>
            <td>cell is row 1, column 0</td>
            <td>cell is row 1, column 1</td>
            <td>cell is row 1, column 2</td>
          </tr>
          <tr>
            <td>cell is row 2, column 0</td>
            <td>cell is row 2, column 1</td>
            <td>cell is row 2, column 2</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="">
	<h4>Upload new bill</h4>
	<hr>
      <form class="form-horizontal">
        <fieldset>
          <!-- Button -->
          <div class="form-group">
            <label class="col-md-2 col-md-pull-1 control-label" for="btn-upload">Upload bill</label>
            <div class="col-md-4 col-md-pull-1">
              <input id="filebutton" name="filebutton" class="input-file btn" type="file">
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-1 control-label" for="billName">Bill name</label>
            <div class="col-md-4">
              <input id="billName" name="billName" type="text" placeholder="Enter bill name" class="form-control input-md" required="">
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-1 control-label" for="billDate">Bill Date</label>
            <div class="col-md-4">
              <input id="billDate" name="billDate" type="text" placeholder="Enter bill date" class="form-control input-md" required="">
            </div>
          </div>
		  <!-- Button -->
          <div class="form-group">
            <div class="col-md-4 col-md-push-1">
              <button id="btn-upload" name="btn-upload" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

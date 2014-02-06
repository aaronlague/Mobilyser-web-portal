<?php
include 'protected/models/contacts.php';
$contactsModel = new ContactsModel();
?>
<div class="container" style="padding-left:30px;">
  <div class="row">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th colspan="2"> Contact List </th>
          <th colspan="1" style="text-align:right;"> <?php echo $contactsModel->getContacts($_SESSION['account_num'], 'y', $connect); ?> Contacts </th>
        </tr>
      </thead>
      <thead>
        <tr>
          <th>Phone Number</th>
          <th>Contact Name</th>
          <th>Caller Tag</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $contactsModel->getContacts($_SESSION['account_num'], 'n', $connect); ?>
      </tbody>
    </table>
  </div>
</div>

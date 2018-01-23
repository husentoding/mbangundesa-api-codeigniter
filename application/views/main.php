<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php echo form_open_multipart('mitra/save'); ?>
    <table class="table">
      <tr>
        <td>Image</td>
        <td><?php echo form_upload('pic'); ?></td>
      </tr>
      <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"') ?></td>
      </tr>

    </table>
  </body>
</html>

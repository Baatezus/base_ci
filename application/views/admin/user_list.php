<h1>User list</h1>
<table class="striped">
  <thead>
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Administrator</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($users as $user) { ?>
    <tr>
      <td><?= $user->id ?></td>
      <td><?= $user->email ?></td>
      <td><?= ($user->admin === '1')? 'Yes' : 'No' ?></td>
    </tr>
      <?php } ?>
  </tbody>
</table>
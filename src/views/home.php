<h1 class="text-center"><?php echo $view['header'];?></h1>
<a href="logout">Logout</a>

<h2>My contacts</h2>

<table id="userlist" class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First name</th>
        <th scope="col">Surname</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $i = 1;
    foreach ($view['users'] as $user) { ?>
        <tr data-userId="<?= $user->id?>">
            <th><a href="contact/<?= $user->id?>"><?= $i?></a></th>
            <th class="firstname" data-property="firstname">
                <span><?= $user->firstname?></span>
                <input class="hidden" type="text">
            </th>
            <th class="lastname" data-property="lastname">
                <span><?= $user->lastname?></span>
                <input class="hidden" type="text">
            </th>
            <th class="email" data-property="email">
                <span><?= $user->email?></span>
                <input class="hidden" type="text">
            </th>
            <th class="phone" data-property="phone">
                <span><?= $user->phone?></span>
                <input class="hidden" type="text">
            </th>
        </tr>
    <?php
    $i++;
    } ?>

    </tbody>

</table>
<form id="add_form" action="#" class="hidden">
    <label for="form_name">Name *</label>
    <input id="form_name" type="text" name="name" class="form-control"
           placeholder="Please enter firstname *" required="required"
           data-error="Firstname is required.">
    <div class="help-block with-errors"></div>
    <label for="form_name">Surname *</label>
    <input id="form_name" type="text" name="surname" class="form-control"
           placeholder="Please enter surname *" required="required"
           data-error="Firstname is required.">
    <div class="help-block with-errors"></div>
    <label for="form_email">Email *</label>
    <input id="form_email" type="email" name="email" class="form-control"
           placeholder="Please enter email *" required="required"
           data-error="Valid email is required.">
    <div class="help-block with-errors"></div>
    <label for="form_phone">Phone</label>
    <input id="form_phone" type="tel" name="phone" class="form-control"
           placeholder="Please enter phone">
    <div class="help-block with-errors"></div>
    <div class="col-md-12">
        <input type="submit" class="btn btn-success btn-send" value="Add contact">
    </div>
</form>
<a id="add_contact" href="#" data-iterator="<?= $i?>">Add contact</a>
<?php
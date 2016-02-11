<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php print $prestamo->id_persona; ?></title>
    </head>
    <body>
        <h1><?php print $prestamo->codigo; ?></h1>
        <div>
            <span class="label">Phone:</span>
            <?php print $contact->phone; ?>
        </div>
        <div>
            <span class="label">Email:</span>
            <?php print $contact->email; ?>
        </div>
        <div>
            <span class="label">Address:</span>
            <?php print $contact->address; ?>
        </div>
    </body>
</html>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url('/css/style.css'); ?>">

    <title><?= $title; ?></title>
</head>

<body>
    <div class="container mt-5 col-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                LOGIN
            </div>
            <div class="card-body">
                <!-- <form action="<?= base_url('login'); ?>" method="POST"> -->
                <?php if (session()->getFlashdata('message')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <div class="alert alert-danger" role="alert" id="alert">
                </div>

                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">
                        Email
                    </label>
                    <input type="text" name="member_username" class="form-control" id="inputUsername" placeholder="Masukkan Username..." value="<?= old('member_username'); ?>">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">
                        Password
                    </label>
                    <input type="password" name="member_password" class="form-control" id="inputPassword" placeholder="Masukkan Password...">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Login" name="login" id="login" class="btn btn-primary">
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <script>
        $(document).ready(function() {
            $('#alert').hide();

            $("#login").click(function() {
                $.ajax({
                    url: "<?= base_url('login/ajax'); ?>",
                    type: "POST",
                    data: {
                        email: $('#inputUsername').val(),
                        password: $('#inputPassword').val()
                    },
                    dataType: "json",
                    success: function(result) {
                        $('#alert').html('');
                        $('#alert').hide();
                        if (result.access_token) {
                            top.location.href = "<?= base_url('/'); ?>";
                        } else {
                            $('#alert').html(result.message);
                            $('#alert').show();
                            //alert(result.message);
                        }
                    },
                });
            });

        });
    </script>
</body>

</html>